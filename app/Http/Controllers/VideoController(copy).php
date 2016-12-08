<?php
/**
 * @package    User Controller
 *
 * @copyright  2016 metamorphosis.tv
 * @author     Ajith, sparksupport.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use App\Video;
use App\UserVideo;
use App\Video_detail;
use App\Jobs\VideoConvert;
use DB;

ini_set("upload_max_filesize", -1);
ini_set("post_max_size", -1);
//restore memory
ini_set("memory_limit", -1);

class VideoController extends Controller
{
    
    /**
     * Show the Videos list.
     *
     * @param  int
     * @return Response
     */

    public function show()
    {
        $video = new Video;
        $details = DB::table('videos')
                ->select('videos.id', 'videos.video','videos.updated_at', 'videos.created_at', 'video_details.title', 'video_details.duration', 'users.name')
                ->join('video_details', 'videos.id', '=', 'video_details.video_id')
                ->join('users', 'videos.user_id', '=', 'users.id')
                ->get();

        return view('video/index', array('video' => $details));
    }

    /**
     * Create User submitted videos
     *
     * @param  int
     * @return Response
     */

    public function upload(Request $request)
    {
        // Get Current user id
        $user = Auth::User();     
        $userid = $user->name;
        $url = $request->file_name; 
        # code...
        if($url!=null) {
            foreach ($request->file_name as $file) {
                $video = new UserVideo;
                $video->user = $userid;
                // $video->video   = $request->video;
                $video->url   = $file;
                $video->country = $request->country;
                $video->story = $request->story;
                // Insert data;
                $video->save();
            }
        }
        return view('video/upload');
    }

    /**
     * Show the Videos list.
     *
     * @param  int
     * @return Response
     */

    public function VideoList()
    {
        $video = new Video;
        $details = $video->with('detail', 'user')->orderBy('created_at', 'desc')->get();
        return view('video/user_uploaded', array('video' => $details));
    }  


    /**
     * Upload Video.
     *
     * @param  int
     * @return Response
     */

    public function uploadVideo()
    {

        // Make sure file is not cached (as it happens for example on iOS devices)
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        /* 
        // Support CORS
        header("Access-Control-Allow-Origin: *");
        // other CORS headers if any...
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            exit; // finish preflight CORS requests here
        }
        */

        // 5 minutes execution time
        @set_time_limit(5 * 60);

        // Uncomment this one to fake upload time
        // usleep(5000);

        // Settings

        $targetDir = base_path() . DIRECTORY_SEPARATOR . "public/portal/". date("Ymd");
        //$targetDir = "/usr/local/WowzaStreamingEngine/content/videos/". date("Ymd");
        //$targetDir = 'uploads';
        $cleanupTargetDir = true; // Remove old files
        $maxFileAge = 5 * 3600; // Temp file age in seconds

        // Create target dir
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Get a file name
        if (isset($_REQUEST["name"])) {
            $fileName = $_REQUEST["name"];
        } elseif (!empty($_FILES)) {
            $fileName = $_FILES["file"]["name"];
        } else {
            $fileName = uniqid("file_");
        }

        $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
        // Chunking might be enabled
        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;

        // Remove old temp files    
        if ($cleanupTargetDir) {
            if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
            }

            while (($file = readdir($dir)) !== false) {
                $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

                // If temp file is current file proceed to the next
                if ($tmpfilePath == "{$filePath}.part") {
                    continue;
                }

                // Remove temp file if it is older than the max age and is not the current file
                if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
                    @unlink($tmpfilePath);
                }
            }
            closedir($dir);
        }   
        // Open temp file
        if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
        }

        if (!empty($_FILES)) {
            if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
            }

            // Read binary input stream and append it to temp file
            if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        } else {    
            if (!$in = @fopen("php://input", "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        }

        while ($buff = fread($in, 4096)) {
            fwrite($out, $buff);
        }

        @fclose($out);
        @fclose($in);

        // Check if file has been uploaded
        if (!$chunks || $chunk == $chunks - 1) {
            // Create unique
            $temp = explode(".", $filePath);
            $newfilename = reset($temp).'_'.round(microtime(true)) . '.' . end($temp);
            $newfilename = str_replace(array('(',')',' '), '',$newfilename);
            // Strip the temp .part suffix off 
            rename("{$filePath}.part", $newfilename);
        }
        echo json_encode('{"jsonrpc" : "2.0", "result" : "'.$newfilename.'", "id" : "id"}');
        /*if(isset($newfilename)) {
            return $newfilename;
        } else {*/
            // Return Success JSON-RPC response
            dispatch(new VideoConvert($targetDir, $newfilename));
            die('{"jsonrpc" : "2.0", "result" : "'.$newfilename.'", "id" : "id"}');
        //}
    }


    /**
     * Create Video from video library upload
     *
     * @param  int
     * @return Response
     */

    public function createVideo(Request $request)
    {
        // Get Current user id
        $user = Auth::User();     
        $userid = $user->id;
        $file = $request->file_name; 
        # code...
        if($file!=null) {
            $video = new Video;
            $video->user_id = $userid;
            $video->video   = $file;
            $time = exec("ffmpeg -i ".$file." 2>&1 | grep Duration | cut -d ' ' -f 4 | sed s/,//");

            $video->library = $request->title;
            // Insert data;
            $video->save();
            // Adding video details
            $detail = new Video_detail;
            $detail->author            = $request->author;
            $detail->copy_right        = $request->copyright;
            $detail->description       = $request->full_description;
            $detail->meta_description  = $request->description;
            $detail->meta_title        = $request->meta_title;
            $detail->title             = $request->title;
            $detail->duration          = $time;
            // Insert data;
            $video->detail()->save($detail);
        }
        return redirect('videos');
    }

    /**
     * Update Video
     *
     * @param  int
     * @return Response
     */

    public function updateVideo(Request $request)
    {
        $video[$request->field] = $request->value;
        // Insert data;
        DB::table('video_details')->where('id', $request->videoid)->update($video);
    }

    /**
     * Get Video detail
     *
     * @param  int
     * @return Response
     */

    public function detail($videoid)
    {
        $videoid = $videoid;
        $video = new Video;
        $details = $video->with('detail', 'user')
                        ->where('videos.id', $videoid)
                        ->get();

        return view('video/detail', array('video' => $details));
    }

    /**
     * List user videos
     *
     * @param  filter if any
     * @return Response
     */

    public function userVideos(Request $request)
    {
        if($request->filter) {
           $filter = $request->filter;
            // Insert data;
           $video = DB::table('user_videos')->where('user', 'LIKE', '%'.$request->filter.'%')->orWhere('story', 'LIKE', '%'.$request->filter.'%')->orWhere('created_at', 'LIKE', '%'.$request->filter.'%')->paginate(12); 
        } else {
            $video = UserVideo::paginate(12);
        }
        return view('video/uservideo', array('videos' => $video));
    }


    /*
    *  Delete videos uploaded by user.
    *
    */

    public function deleteuserVideo($videoid)
    {
        $video = UserVideo::find($videoid);    
        $video->delete();    
    }   

    /*
    *  Delte video library videos.
    *
    */

    public function deleteLib(Request $request)
    {
        foreach ($request->id as $id) {
            $video = Video::find($id);    
            $video->delete();    
        }
        return redirect('videos');
    } 

    /**
     * User Upload Video.
     *
     * @param  int
     * @return Response
     */

    public function uploadUserVideo()
    {

        // Make sure file is not cached (as it happens for example on iOS devices)
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        // 5 minutes execution time
        @set_time_limit(5 * 60);

        // Uncomment this one to fake upload time
        // usleep(5000);

        // Settings
        $targetDir = base_path() . DIRECTORY_SEPARATOR . 'public/user-videos';
        //$targetDir = 'uploads';
        $cleanupTargetDir = true; // Remove old files
        $maxFileAge = 5 * 3600; // Temp file age in seconds


        // Create target dir
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Get a file name
        if (isset($_REQUEST["name"])) {
            $fileName = $_REQUEST["name"];
        } elseif (!empty($_FILES)) {
            $fileName = $_FILES["file"]["name"];
        } else {
            $fileName = uniqid("file_");
        }

        $filePath = $targetDir . DIRECTORY_SEPARATOR . $fileName;
        // Chunking might be enabled
        $chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
        $chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;


        // Remove old temp files    
        if ($cleanupTargetDir) {
            if (!is_dir($targetDir) || !$dir = opendir($targetDir)) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
            }

            while (($file = readdir($dir)) !== false) {
                $tmpfilePath = $targetDir . DIRECTORY_SEPARATOR . $file;

                // If temp file is current file proceed to the next
                if ($tmpfilePath == "{$filePath}.part") {
                    continue;
                }

                // Remove temp file if it is older than the max age and is not the current file
                if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge)) {
                    @unlink($tmpfilePath);
                }
            }
            closedir($dir);
        }   
        // Open temp file
        if (!$out = @fopen("{$filePath}.part", $chunks ? "ab" : "wb")) {
            die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
        }

        if (!empty($_FILES)) {
            if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"])) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
            }

            // Read binary input stream and append it to temp file
            if (!$in = @fopen($_FILES["file"]["tmp_name"], "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        } else {    
            if (!$in = @fopen("php://input", "rb")) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
            }
        }

        while ($buff = fread($in, 4096)) {
            fwrite($out, $buff);
        }

        @fclose($out);
        @fclose($in);

        // Check if file has been uploaded
        if (!$chunks || $chunk == $chunks - 1) {
            // Create unique
            $temp = explode(".", $filePath);
            $newfilename = reset($temp).'_'.round(microtime(true)) . '.' . end($temp);
            $newfilename = str_replace(array('(',')',' '), '',$newfilename);
            // Strip the temp .part suffix off 
            rename("{$filePath}.part", $newfilename);
        }

        // CreateThumbnail
        $filename = pathinfo($newfilename, PATHINFO_FILENAME);
        $thumbnail = $targetDir.'/'.$filename.'_600.jpg';
        shell_exec("ffmpeg -i ".$newfilename." -vf scale=663:378 -deinterlace -an -ss 1 -t 00:00:01 -r 1 -y -vcodec mjpeg -f mjpeg ".$thumbnail." 2>&1");
        $thumbnail1 = $targetDir.'/'.$filename.'_130.jpg';
        shell_exec("ffmpeg -i ".$newfilename." -vf scale=130:80 -deinterlace -an -ss 1 -t 00:00:01 -r 1 -y -vcodec mjpeg -f mjpeg ".$thumbnail1." 2>&1");
        $thumbnail2 = $targetDir.'/'.$filename.'_290.jpg';
        shell_exec("ffmpeg -i ".$newfilename." -vf scale=295:220 -deinterlace -an -ss 1 -t 00:00:01 -r 1 -y -vcodec mjpeg -f mjpeg ".$thumbnail2." 2>&1");

        $bitrate = $targetDir.'/'.$filename.'_240.mp4';
        shell_exec("ffmpeg -i ".$newfilename." -s 426x240 -c:a copy ".$bitrate."> /dev/null &");
        $bitrate = $targetDir.'/'.$filename.'_360.mp4';
        shell_exec("ffmpeg -i ".$newfilename." -s 640x360 -c:a copy ".$bitrate."> /dev/null &");
        $bitrate = $targetDir.'/'.$filename.'_480.mp4';
        shell_exec("ffmpeg -i ".$newfilename." -s 854x480 -c:a copy ".$bitrate."> /dev/null &");
        $bitrate = $targetDir.'/'.$filename.'_720.mp4';
        shell_exec("ffmpeg -i ".$newfilename." -s 1280x720 -c:a copy ".$bitrate."> /dev/null &");
        $bitrate = $targetDir.'/'.$filename.'_1080.mp4';
        shell_exec("ffmpeg -i ".$newfilename." -s 1920x1080 -c:a copy ".$bitrate."> /dev/null &");

        /*if(isset($newfilename)) {
            return $newfilename;
        } else {*/
            // Return Success JSON-RPC response
            die('{"jsonrpc" : "2.0", "result" : "'.$newfilename.'", "id" : "id"}');
        //}
    } 

    public function createthumbnail($opts) {
        $params = [
            'library'     => 'ffmpeg', // the ffmpeg command - full path if needs be
            'input'       => null,     // input video file - specified as command line parameter
            'output'      => __DIR__,  // The output directory
            'timespan'    => 10,       // seconds between each thumbnail
            'thumbWidth'  => 120,      // thumbnail width
            'spriteWidth' => 10,       // number of thumbnails per row in sprite sheet
            'videotypes'  => array('video/mp4')
        ];

        // process input parameters
        if (isset($opts['library'])) {
            $params['library'] = $opts['library'];
        }
        $params['input'] = escapeshellarg($opts['input']);
        if (isset($opts['output'])) {
            $params['output'] = realpath($opts['output']);
        }
        if (isset($opts['timespan']) && (int)$opts['timespan']) {
            $params['timespan'] = $opts['timespan'];
        }
        if (isset($opts['width']) && (int)$opts['width']) {
            $params['thumbWidth'] = $opts['width'];
        }

        if (isset($opts['videotypes']) && is_array($opts['videotypes'])) {
            $params['videotypes'] = $opts['videotypes'];
        }

        $commands = [
            'details' => $params['library'] . ' -i %s 2>&1',
            'poster'  => $params['library'] . ' -ss %d -i %s -y -vframes 1 "%s/%s-poster.jpg" 2>&1',
            'thumbs'  => $params['library'] . ' -ss %0.04f -i %s -y -an -sn -vsync 0 -q:v 5 -threads 1 '
                . '-vf scale=%d:-1,select="not(mod(n\\,%d))" "%s/thumbnails/%s-%%04d.jpg" 2>&1'
        ];

        $details = shell_exec(sprintf($commands['details'], $params['input']));
        // determine some values we need
        $time = $fps = [];
        preg_match('/Duration: ((\d+):(\d+):(\d+))\.\d+, start: ([^,]*)/is', $details, $time);
        preg_match('/\b(\d+(?:\.\d+)?) fps\b/', $details, $fps);

        $duration = ($time[2] * 3600) + ($time[3] * 60) + $time[4];
        $start = $time[5];
        $fps = $fps[1];
        $total = round($duration/$opts['timespan']);
        
        $vtt = "WEBVTT\n\n";
        for ($rx = $ry = $s = $f = 0; $f < $total; $f++) {
            $t1 = sprintf('%02d:%02d:%02d.000', ($s / 3600), ($s / 60 % 60), $s % 60);
            $s += $params['timespan'];
            $t2 = sprintf('%02d:%02d:%02d.000', ($s / 3600), ($s / 60 % 60), $s % 60);
            $thumbnail = $opts['output'].'/'.$opts['vttname'].$f.'.jpg';
        shell_exec("ffmpeg -i ".$opts['input']." -vf scale=130:80 -deinterlace -an -ss ".$t1." -r 1 -y -vcodec mjpeg -f mjpeg ".$thumbnail." 2>&1");
            $vtt .= "{$t1} --> {$t2}\n" . $opts['vttname'].$f.'.jpg'."\n\n";

        }
        $vtt .= "\n\n";
        $fp = fopen($opts['output']."/".$opts['vttname'].".vtt","wb");
        fwrite($fp,$vtt);
        fclose($fp);

    }


    /**
     * Check url & Content-Type (eg. 'video/mp4')
     *
     */
    public function checkurl($url, $videotypes) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $data = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
        curl_close($ch);

        return ($data !== false && $httpcode === 200 && in_array($contentType, $videotypes));
    }
}
