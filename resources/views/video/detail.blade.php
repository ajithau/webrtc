<?php 
/**
 * User Controller
 *
 * @copyright  2016 SparkSupport
 * @author     Ajith
 * @date 	   14-10-16
 * @contact    ajitharakkal@gmail.com
 */
?>
@extends('layouts.video')
@section('title', 'Main page')

@section('content')
<?php 
    $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $video[0]['video']);
    $video_path = explode('portal', $video[0]['video']); 
    $img_path   = explode('public', $withoutExt);
    $smil_path  = str_replace('/portal/', '', $img_path[1])
?>  
    <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-12">
                <h2>Video Detail</h2>
            </div>               
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                    <div class="col-lg-12">                       
                             <div class="row">
                <div class="col-lg-8">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5><i class="fa fa-desktop"></i> Video Player</h5>                            
                        </div>
                        <div class="ibox-content no-padding">
                            <div class="row">
                                <div class="col-lg-12">
                                <div id="player"></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                <div class="col-lg-6">
                                    <div class="padding-15">
                                        <strong>Media ID:</strong> 12345678     
                                    </div>                              
                                </div>
                                <div class="col-lg-6">
                                    <div class="padding-15">
                                        <strong>Duration:</strong> {{ $video[0]['detail'][0]['duration'] }}
                                    </div>                                  
                                </div>
                            </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="videoid" value="{{ $video[0]['detail'][0]['id'] }}">
                <div class="col-lg-4">
                   <!-- START: Accordion -->
                   <div class="panel-body accordion-panel-colour no-padding">
                                <div class="panel-group" id="accordion">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h5 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Meta Data</a>
                                            </h5>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse">
                                            <div class="panel-body">
                                               <form method="get" class="form-horizontal">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <label class="control-label">Title</label>
                                    <span id="title" type="text" class="form-control inline_edit_text" value="">
                                    {{ $video[0]['detail'][0]['title'] }}
                                    </span>
                                    </div>
                                </div>
                               <div class="form-group">
                                    <div class="col-sm-12">
                                    <label class="control-label">Description</label>
                                        <textarea id="meta_description" rows="4" class="form-control inline_edit_textarea ">{{ $video[0]['detail'][0]['meta_description']}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <label class="control-label">Long Description</label>
                                        <textarea id="description" rows="8" class="form-control inline_edit_textarea">{{ $video[0]['detail'][0]['description']
}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <label class="control-label">Copyright</label>
                                    <span id="copy_right" type="text" class="form-control inline_edit_text" value=""> {{ $video[0]['detail'][0]['copy_right'] }} </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <label class="control-label">Author</label>
                                    <span id="author" type="text" class="form-control inline_edit_text" value="">{{ $video[0]['detail'][0]['author'] }}</span>
                                    </div>
                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false">Poster Image</a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                            <div class="panel-body">
                                                 <label class="control-label">Select File</label>
                                                 <img src="{{ url('/') }}/public{{$img_path[1]}}_290.jpg">
                                            </div>
                                        </div>
                                    </div>
<div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed" aria-expanded="false">Output URL's</a>
                                            </h4>
                                        </div>
                                        <div id="collapseThree" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                            <div class="panel-body">
                                                <form method="get" class="form-horizontal">
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                        <label class="control-label">Apple (iOS)</label>
                                                                     <div class="input-group">
                                                                     <select name="" id="" class="form-control">
                                                            <option value="http://104.196.194.7:1935/portal/_definst_/smil:{{$smil_path}}.smil/playlist.m3u8">Adaptive Bit Rate</option>
                                                            <option value="http://104.196.194.7:1935/portal/_definst_/mp4:{{$img_path[1]}}_1080.mp4/playlist.m3u8">1080p -HD</option>
                                                            <option value="http://104.196.194.7:1935/portal/_definst_/mp4:{{$img_path[1]}}_720.mp4/playlist.m3u8">720p - HD</option>
                                                            <option value="http://104.196.194.7:1935/portal/_definst_/mp4:{{$img_path[1]}}_480.mp4/playlist.m3u8">480p - SD</option>
                                                            <option value="http://104.196.194.7:1935/portal/_definst_/mp4:{{$img_path[1]}}_360.mp4/playlist.m3u8">360p - SD</option>
                                                            <option value="http://104.196.194.7:1935/portal/_definst_/mp4:{{$img_path[1]}}_240.mp4/playlist.m3u8">240p - SD</option>
                                                        </select> <span class="input-group-btn"> 
                                                        <button class="btn btn-primary copy" type="button"><i class="fa fa-copy"></i> Copy</button>
                                                          </span></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                        <label class="control-label">MPEG DASH</label>
                                                                     <div class="input-group">
                                                                     <select name="" id="" class="form-control">
                                                            <option value="http://104.196.194.7:1935/portal/_definst_/smil:{{$smil_path}}.smil/manifest.mpd">Adaptive Bit Rate</option>
                                                            <option value="http://104.196.194.7:1935/portal/_definst_/mp4:{{$img_path[1]}}_1080.mp4/manifest.mpd">1080p -HD</option>
                                                            <option value="http://104.196.194.7:1935/portal/_definst_/mp4:{{$img_path[1]}}_720.mp4/manifest.mpd">720p - HD</option>
                                                            <option value="http://104.196.194.7:1935/portal/_definst_/mp4:{{$img_path[1]}}_480.mp4/manifest.mpd">480p - SD</option>
                                                            <option value="http://104.196.194.7:1935/portal/_definst_/mp4:{{$img_path[1]}}_360.mp4/manifest.mpd">360p - SD</option>
                                                            <option value="http://104.196.194.7:1935/portal/_definst_/mp4:{{$img_path[1]}}_240.mp4/manifest.mpd">240p - SD</option>
                                                        </select> <span class="input-group-btn"> 
                                                        <button class="btn btn-primary copy" type="button"><i class="fa fa-copy"></i> Copy</button>
                                                          </span></div>
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <div class="col-sm-12">
                                                        <label class="control-label">MPEG DASH (VP9)</label>
                                                                     <div class="input-group">
                                                                     <select name="" id="" class="form-control">
                                                            <option value="">Adaptive Bit Rate</option>
                                                            <option value="">1080p -HD</option>
                                                            <option value="">720p - HD</option>
                                                            <option value="">480p - SD</option>
                                                            <option value="">360p - SD</option>
                                                            <option value="">240p - SD</option>
                                                        </select> <span class="input-group-btn"> 
                                                        <button class="btn btn-primary" type="button"><i class="fa fa-copy"></i> Copy</button>
                                                          </span></div>
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <div class="col-sm-12">
                                                        <label class="control-label">Smooth Stream</label>
                                                                     <div class="input-group">
                                                                     <select name="" id="" class="form-control">
                                                            <option value="http://104.196.194.7:1935/portal/_definst_/smil:{{$smil_path}}.smil/Manifest">Adaptive Bit Rate</option>
                                                            <option value="http://104.196.194.7:1935/portal/_definst_/mp4:{{$img_path[1]}}_1080.mp4/Manifest">1080p -HD</option>
                                                            <option value="http://104.196.194.7:1935/portal/_definst_/mp4:{{$img_path[1]}}_720.mp4/Manifest">720p - HD</option>
                                                            <option value="http://104.196.194.7:1935/portal/_definst_/mp4:{{$img_path[1]}}_480.mp4/Manifest">480p - SD</option>
                                                            <option value="http://104.196.194.7:1935/portal/_definst_/mp4:{{$img_path[1]}}_360.mp4/Manifest">360p - SD</option>
                                                            <option value="http://104.196.194.7:1935/portal/_definst_/mp4:{{$img_path[1]}}_240.mp4/Manifest">240p - SD</option>
                                                        </select> <span class="input-group-btn"> 
                                                        <button class="btn btn-primary copy" type="button"><i class="fa fa-copy"></i> Copy</button>
                                                          </span></div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">Player Embed Code</a>
                                            </h4>
                                        </div>
                                        <div id="collapseFour" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                     <div class="form-group">
                                    <div class="col-sm-12">
                                    <label class="control-label">Auto Play:</label>
                                               <div class="radio radio-green radio-inline">
                                            <input type="radio" id="inlineRadio1" value="option1" name="radioInline" checked="">
                                            <label for="inlineRadio1"> Yes </label>
                                        </div>
                                        <div class="radio radio-green radio-inline">
                                            <input type="radio" id="inlineRadio2" value="option2" name="radioInline">
                                            <label for="inlineRadio2"> No </label>
                                        </div>
                                            <div class="input-group">
                                            <input type="text" id="embeded" class="form-control" value='<div id="player" itemprop="video" itemscope itemtype="http://schema.org/VideoObject"><h2 itemprop="name">Video Name or Title</h2><meta itemprop="title" content="{{ $video[0]['detail'][0]['title'] }}" /><meta itemprop="duration" content="{{ $video[0]['detail'][0]['duration'] }}" /><meta itemprop="thumbnailUrl" content="{{ url('/') }}/public{{$img_path[1]}}_600.jpg" /><meta itemprop="contentUrl" content="{{ url('/') }}/public{{$video_path[1]}}" />
<meta itemprop="uploadDate" content="{{ $video[0]['detail'][0]['created_at'] }}" /><span itemprop="description">{{ $video[0]['detail'][0]['meta_description'] }}.</span><span itemprop="longdescription">{{ $video[0]['detail'][0]['description'] }}</span><meta itemprop="copyright" content="{{ $video[0]['detail'][0]['copy_right'] }}" /><meta itemprop="author" content="{{ $video[0]['detail'][0]['author'] }}" />
<script>var wowsa="http://104.196.194.7:1935/portal/_definst_/smil:";var playerInstance=jwplayer("player");playerInstance.setup({image:"{{ url('/') }}/public{{$img_path[1]}}_600.jpg",sources:[{file:wowsa+"{{$smil_path}}.smil/playlist.m3u8"}],tracks:[{file:"{{ url('/') }}/public{{$img_path[1]}}.vtt",kind:"thumbnails"}],autostart:"true",androidhls:"true",abouttext:"Metamorphosis",aboutlink:"http://www.metamorphosis.tv",aspectratio:"16:9",height:378,width:663});</script></div>'>
                                <span class="input-group-btn"> 
                                    <button class="btn btn-primary" id="copy" type="button"><i class="fa fa-copy"></i> Copy</button>
                                      </span></div>
                                    </div>
                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                   <!-- END: Accordion -->                                
                            </div>
                         </div>
                     </div>
                </div>
            </div>              
    <!-- Video player plugins -->
    <script src="http://content.jwplatform.com/libraries/D219T2Wf.js"></script>
    <!-- <script>jwplayer.key="ABCdeFG123456SeVenABCdeFG123456SeVen==";</script>-->
    <script type="text/javascript">
         var wowsa = 'http://104.196.194.7:1935/portal/_definst_/smil:';
         var playerInstance = jwplayer("player");
            playerInstance.setup({
            image: "{{ url('/') }}/public{{$img_path[1]}}_600.jpg", 
            sources: [{ 
            file: wowsa+"{{$smil_path}}.smil/playlist.m3u8"            
                }],  
            tracks: [{ 
                file: "{{ url('/') }}/public{{$img_path[1]}}.vtt", 
                kind: "thumbnails"
            }],
            autostart: "false",
            androidhls: "true",
            abouttext: "Metamorphosis",
            aboutlink: "http://www.metamorphosis.tv",
            aspectratio: "16:9",
            height: 378,
            width: 663
        }); 
    </script>           
@endsection
