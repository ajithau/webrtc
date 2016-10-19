<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use App\Video;
use App\Video_detail;

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
        return view('video/index');
    }
    /**
     * Upload Video.
     *
     * @param  int
     * @return Response
     */
    public function uploadVideo()
    {
        /**
         * upload.php
         *
         * Copyright 2013, Moxiecode Systems AB
         * Released under GPL License.
         *
         * License: http://www.plupload.com/license
         * Contributing: http://www.plupload.com/contributing
         */

        #!! IMPORTANT: 
        #!! this file is just an example, it doesn't incorporate any security checks and 
        #!! is not recommended to be used in production environment as it is. Be sure to 
        #!! revise it and customize to your needs.


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
        $targetDir = base_path() . DIRECTORY_SEPARATOR . "public/videos/". date("Ymd");
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
            // Strip the temp .part suffix off 
            rename("{$filePath}.part", $newfilename);
        }

        /*if(isset($newfilename)) {
            return $newfilename;
        } else {*/
            // Return Success JSON-RPC response
            die('{"jsonrpc" : "2.0", "result" : "'.$newfilename.'", "id" : "id"}');
        //}
    }    
    /**
     * Create Video
     *
     * @param  int
     * @return Response
     */
    public function createVideo(Request $request)
    {
        // print_r($_REQUEST);die();
        // Get Current user id
        $user = Auth::User();     
        $userid = $user->id;

        $video = new Video;
        $video->user_id = $userid;
        // $video->video   = $request->video;
        $video->video   = "Video url";
        // Insert data;
        $video->save();

        // Specifying the role of new user.
        $detail = new Video_detail;
        $detail->author            = $request->author;
        $detail->copy_right        = $request->copyright;
        $detail->description       = $request->full_description;
        $detail->meta_description  = $request->description;
        $detail->meta_title        = $request->meta_title;
        $detail->title             = $request->title;
        // Insert data;
        $video->detail()->save($detail);

        return view('video/index');
    }    
}
