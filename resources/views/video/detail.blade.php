<?php 
/**
 * User Controller
 *
 * @copyright  2016 SparkSupport
 * @author     Ajith
 * @date 	   14-10-16
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
?>
@extends('layouts.video')
@section('title', 'Main page')

@section('content')
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
                                        <strong>Duration:</strong> {{ $video[0]['detail']['duration'] }}
                                    </div>                                  
                                </div>
                            </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                                    <input type="text" class="form-control" value="{{ $video[0]['detail']['meta_title'] }}">
                                    </div>
                                </div>
                               <div class="form-group">
                                    <div class="col-sm-12">
                                    <label class="control-label">Description</label>
                                        <textarea rows="4" class="form-control">{{ $video[0]['detail']['meta_description']}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <label class="control-label">Long Description</label>
                                        <textarea rows="8" class="form-control">{{ $video[0]['detail']['description']
}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <label class="control-label">Copyright</label>
                                    <input type="text" class="form-control" value="{{ $video[0]['detail']['copy_right']
}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <label class="control-label">Author</label>
                                    <input type="text" class="form-control" value="{{ $video[0]['detail']['author'] }}">
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
                                            <input type="text" class="form-control" value=""><span class="input-group-btn"> 
                                    <button class="btn btn-primary" type="button"><i class="fa fa-copy"></i> Copy</button>
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
    <?php 
    $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $video[0]['video']);
    $video_path = explode('public', $video[0]['video']); 
    $img_path   = explode('public', $withoutExt);
    ?>                
    <!-- Video player plugins -->
    <script src="https://content.jwplatform.com/libraries/vz0f8yKj.js"></script>
    <script>jwplayer.key="ABCdeFG123456SeVenABCdeFG123456SeVen==";</script>
    <script>
        jwplayer("player").setup({
            "file": '{{ url('/') }}/public{{$video_path[1]}}',
            "image": '{{ url('/') }}/public{{$img_path[1]}}_600.jpg',
            "height": 378,
            "width": 663,
            "advertising": {
                "client": "vast",
                "schedule": {
                  "preroll":{
                    "tag": "http://tester.advertserve.com/servlet/vast2/media?mid=234&pid=0&random=__random-number__",
                    "offset": "pre"
                  }
                }
            }
        });
    </script>                
@endsection