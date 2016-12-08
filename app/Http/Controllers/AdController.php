<?php
/**
 * @package    Advertisement Controller
 *
 * @copyright  2016 metamorphosis.tv
 * @author     Ajith, sparksupport.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Video;
use App\Video_detail;
use App\Provider;
use App\Advertisement;
use Illuminate\Support\Facades\DB;

class AdController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * List advertisement.
     *
     * @param  int
     * @return Response
     */

    public function index()
    {
        $provider = new Provider;
        $video    = new Video;
        
        $details = $provider->select(array('id', 'provider_name', 'vast_tag'))->get();

        $ads = DB::table('advertisements')
                ->select('advertisements.*', 'videos.video', 'videos.library', 'ad_providers.*')
                ->join('ad_providers', 'ad_providers.advertisement_id','=', 'advertisements.id')
                ->join('videos', 'videos.id','=', 'advertisements.video_id')
                ->get();
        
        $videos = $video->select('videos.id', 'videos.video', 'video_details.title', 'video_details.duration')
                    ->join('video_details', 'videos.id', '=', 'video_details.video_id')
                    ->get();

        return view('ads/index', array('providers' => $details, 'ads' => $ads, 'videos' => $videos));
    }

    /**
     * Add ad provider.
     *
     * @param  null
     * @return id
     */

    public function adProvider()
    {
        if (isset($_REQUEST['vast'])) {
            $provider = new Provider;
            $provider->vast_tag = $_REQUEST['vast'];
            // Insert data.
            $provider->save();

            return $provider->id;

        } elseif (isset($_REQUEST['ad'])) {
            $provider = new Provider;
            $provider->provider_name = $_REQUEST['ad'];
            // Insert data.
            $provider->save();

            return $provider->id;

        }
    } 
        
    /**
     * Add ad provider.
     *
     * @param  null
     * @return id
     */

    public function updateProvider()
    {
        if (isset($_REQUEST['vast'])) {
            $id = $_REQUEST['id'];
            $provider['vast_tag'] = $_REQUEST['vast'];
            // Insert data;
            DB::table('providers')->where('id', $id)->update($provider);

            return $id;

        } elseif (isset($_REQUEST['ad'])) {
            $id = $_REQUEST['id'];
            $provider['provider_name'] = $_REQUEST['ad'];
            // Insert data;
            DB::table('providers')->where('id', $id)->update($provider);

            return $id;

        }
    }

    /**
     * Create a new Advertisement.
     *
     * @param  array  $request
     * @return null
     */

    protected function addAdvertisement(Request $request)
    {   

        $ads = new Advertisement;
        $ads->ad_source = $request->ad_source;
        if($request->ad_source == 1) {
            $adtype             = $request->ad_type_library;
            $ads->ad_video      = serialize($request->ad_video);
            $ads->ad_type       = $adtype;
            $ads->video_id      = $request->selected_video[1];
        } else {
            $adtype             = $request->ad_type_tag;
            $ads->ad_type       = $adtype;
            $ads->video_id      = $request->selected_video[0];
        }
        $ads->ad_times      = serialize($request->ad_time);
        $ads->ad_companion  = $request->companion_ad;
        $ads->ad_autoplay   = $request->skip_ad;
        $ads->ad_divid      = $request->div_id;
        $ads->ad_width      = $request->div_height;
        $ads->ad_height     = $request->div_width;
        // Insert data.
        $ads->save();


        if($request->ad_source == 0) { 

            // Create xml file for advertisement.
            $targetDir = base_path() . DIRECTORY_SEPARATOR . "public/xml/ad". date("Ymdhis");
            if($adtype == 'preroll'){
                $adid = 'preroll';
                $time = 'start';
            }
            if($adtype == 'postroll'){
                $adid = 'postroll';
                $time = 'end';
            }
            if($adtype == 'google'){
                $adid = 'google';
            }
            if($adtype == 'scheduled'){
                $adid = 'scheduled';
            }
            if(($adtype == 'postroll')||($adtype == 'preroll')){
                $vtt ='<vmap:VMAP xmlns:vmap="http://www.iab.net/videosuite/vmap" version="1.0"><vmap:AdBreak timeOffset="'.$time.'" breakType="linear" breakId="'.$adid.'"><vmap:AdSource id="'.$adid.'-ad" allowMultipleAds="false" followRedirects="true"><AdTagURI templateType="vast3">';
                $vtt .= "<![CDATA[".$request->ad_provider[0]."]]>";
                $vtt .= "</AdTagURI></vmap:AdSource></vmap:AdBreak></vmap:VMAP>";
                $fp = fopen($targetDir.".xml","wb");
                fwrite($fp,$vtt);
                fclose($fp);
            }
            if($adtype == 'scheduled'){
                $vtt ='<vmap:VMAP xmlns:vmap="http://www.iab.net/videosuite/vmap" version="1.0">';
                foreach($request->ad_provider1 as $key => $adbreak) {
                    $vtt .= '"<vmap:AdBreak timeOffset="'.$key.'" breakType="linear"><vmap:AdSource id="overlay-1-ad" allowMultipleAds="false" followRedirects="true"><AdTagURI templateType="vast3">';
                    $vtt .= "<![CDATA[".$adbreak[0]."]]>";
                    $vtt .= "</AdTagURI></vmap:AdSource></vmap:AdBreak>";
                }
                $vtt .= "</vmap:VMAP>";
                $fp = fopen($targetDir.".xml","wb");
                fwrite($fp,$vtt);
                fclose($fp);
            }

            // Insert xml file to adproviders list.
            DB::table('ad_providers')->insert(
                ['advertisement_id' => $ads->id, 'provider_xml' => $targetDir.".xml", 'provider_type' => 'ad_provider' ]
            ); 
        }
        if($request->ad_source == 1) { 

            if($adtype == 'preroll'){
                $adid = 'preroll';
                $time = 'start';
            }
            if($adtype == 'postroll'){
                $adid = 'postroll';
                $time = 'end';
            }
            if($adtype == 'scheduled'){
                $adid = 'scheduled';
            }
            if(($adtype == 'postroll')||($adtype == 'preroll')){
                $videoUrl = DB::table('videos')
                    ->select('video')
                    ->where('id','=', $request->ad_video[0])
                    ->get();
                $videoUrl = explode("portal", $videoUrl[0]->video);
                // Create xml file for advertisement.
                $targetDir = base_path() . DIRECTORY_SEPARATOR . "public/xml/ad". date("Ymdhis");
                
                // Create xml for video library ad.
                $tvideoDir = base_path() . DIRECTORY_SEPARATOR . "public/xml/video". date("Ymdhis");
                $advideo_path = explode("public", $tvideoDir);
                $videoad   = '<VAST version="2.0"><Ad id="static"><InLine><AdSystem>Static VAST Template</AdSystem><AdTitle>Static VAST Tag</AdTitle><Impression>http://example.com/pixel.gif</Impression><Creatives><Creative><Linear><Duration>00:00:08</Duration><TrackingEvents><Tracking event="start">http://example.com/pixel.gif</Tracking><Tracking event="firstQuartile">http://example.com/pixel.gif</Tracking><Tracking event="midpoint">http://example.com/pixel.gif</Tracking><Tracking event="thirdQuartile">http://example.com/pixel.gif</Tracking><Tracking event="complete">http://example.com/pixel.gif</Tracking><Tracking event="pause">http://example.com/pixel.gif</Tracking><Tracking event="mute">http://example.com/pixel.gif</Tracking><Tracking event="fullscreen">http://example.com/pixel.gif</Tracking></TrackingEvents><VideoClicks><ClickThrough>http://www.jwplayer.com/</ClickThrough><ClickTracking>http://example.com/pixel.gif</ClickTracking></VideoClicks><MediaFiles><MediaFile type="video/mp4" bitrate="400" width="854" height="480">rtmp://104.196.194.7:1935/portal/_definst_/mp4:'.$videoUrl[1].'</MediaFile></MediaFiles></Linear></Creative></Creatives></InLine></Ad></VAST>';
                $vfp = fopen($tvideoDir.".xml","wb");
                fwrite($vfp,$videoad);
                fclose($vfp);

                $vtt ='<vmap:VMAP xmlns:vmap="http://www.iab.net/videosuite/vmap" version="1.0"><vmap:AdBreak timeOffset="'.$time.'" breakType="linear" breakId="'.$adid.'"><vmap:AdSource id="'.$adid.'-ad" allowMultipleAds="false" followRedirects="true"><AdTagURI templateType="vast3">';
                $vtt .= "<![CDATA[".url('/')."/public".$advideo_path[1].".xml]]>";
                $vtt .= "</AdTagURI></vmap:AdSource></vmap:AdBreak></vmap:VMAP>";
                $fp = fopen($targetDir.".xml","wb");
                fwrite($fp,$vtt);
                fclose($fp);
            }
            if($adtype == 'scheduled'){
                $vtt ='<vmap:VMAP xmlns:vmap="http://www.iab.net/videosuite/vmap" version="1.0">';
                foreach($request->ad_video1 as $key => $adbreak) {
                    $videoUrl = DB::table('videos')
                        ->select('video')
                        ->where('id','=', $adbreak)
                        ->get();
                    $videoUrl = explode("portal", $videoUrl[0]->video);
                    // Create xml file for advertisement.
                    $targetDir = base_path() . DIRECTORY_SEPARATOR . "public/xml/ad". date("Ymdhis");
                    
                    // Create xml for video library ad.
                    $tvideoDir = base_path() . DIRECTORY_SEPARATOR . "public/xml/video". date("Ymdhis");
                    $advideo_path = explode("public", $tvideoDir);
                    $videoad   = '<VAST version="2.0"><Ad id="static"><InLine><AdSystem>Static VAST Template</AdSystem><AdTitle>Static VAST Tag</AdTitle><Impression>http://example.com/pixel.gif</Impression><Creatives><Creative><Linear><Duration>00:00:08</Duration><TrackingEvents><Tracking event="start">http://example.com/pixel.gif</Tracking><Tracking event="firstQuartile">http://example.com/pixel.gif</Tracking><Tracking event="midpoint">http://example.com/pixel.gif</Tracking><Tracking event="thirdQuartile">http://example.com/pixel.gif</Tracking><Tracking event="complete">http://example.com/pixel.gif</Tracking><Tracking event="pause">http://example.com/pixel.gif</Tracking><Tracking event="mute">http://example.com/pixel.gif</Tracking><Tracking event="fullscreen">http://example.com/pixel.gif</Tracking></TrackingEvents><VideoClicks><ClickThrough>http://www.jwplayer.com/</ClickThrough><ClickTracking>http://example.com/pixel.gif</ClickTracking></VideoClicks><MediaFiles><MediaFile type="video/mp4" bitrate="400" width="854" height="480">rtmp://104.196.194.7:1935/portal/_definst_/mp4:'.$videoUrl[1].'</MediaFile></MediaFiles></Linear></Creative></Creatives></InLine></Ad></VAST>';
                    $vfp = fopen($tvideoDir.".xml","wb");
                    fwrite($vfp,$videoad);
                    fclose($vfp);

                    $vtt .= '"<vmap:AdBreak timeOffset="'.$key.'" breakType="linear"><vmap:AdSource id="overlay-1-ad" allowMultipleAds="false" followRedirects="true"><AdTagURI templateType="vast3">';
                    $vtt .= "<![CDATA[".url('/')."/public".$advideo_path[1].".xml]]>";
                    $vtt .= "</AdTagURI></vmap:AdSource></vmap:AdBreak>";
                }
                $vtt .= "</vmap:VMAP>";
                $fp = fopen($targetDir.".xml","wb");
                fwrite($fp,$vtt);
                fclose($fp);
            }

            // Insert xml file to adproviders list.
            DB::table('ad_providers')->insert(
                ['advertisement_id' => $ads->id, 'provider_xml' => $targetDir.".xml", 'provider_type' => 'ad_provider' ]
            ); 
        }
        return redirect()->back();
    }

    /**
     * Delete AdProvider
     *
     * @param  array  $id
     * @return null
     */

    public function deleteProvider($id)
    {
        $provider = Provider::find($id);
        $provider->delete();    
    }

    /**
     * Delete Advertisement
     *
     * @param  array  $id
     * @return null
     */

    public function deleteAd($id)
    {
        $provider = Advertisement::find($id);
        $provider->delete();    
    }

    /**
     * Get Video id
     *
     * @param  array  $id
     * @return null
     */ 

    public function getVideo()
    {
        return view('ads/video_ajax');
    }

    /**
     * Ajax provider
     *
     * @param  array  $id
     * @return null
     */   

    public function providerAjax()
    {
        $provider = new Provider;
        $details = $provider->select(array('id', 'provider_name', 'vast_tag'))->get();
        return view('ads/provider_ajax', array('providers' => $details));
    }

    /**
     * Ajax provider
     *
     * @param  array  $id
     * @return null
     */ 

    public function ads($id)
    {
        $ads = DB::table('advertisements')
                ->select('*')
                ->join('videos', 'videos.id', '=', 'advertisements.video_id')
                ->join('ad_providers', 'ad_providers.advertisement_id', '=', 'advertisements.id')
                ->where('advertisements.id', $id)
                ->get();

        return view('ads/ads', array( 'ads' => $ads));
    }
}
