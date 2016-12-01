<?php 
/**
 * User Controller
 *
 * @copyright  2016 SparkSupport
 * @author     Ajith
 * @date     08-11-16
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
?>
@extends('layouts.admin')
@section('title', 'Main page')

@section('content')
<?php
$json = file_get_contents('http://104.196.194.7:8086/livestreams');
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Live Stream Ingest</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>
                <a>Streaming Video</a>
            </li>
            <li class="active">
                <strong>Live Stream Ingest</strong>
            </li>
        </ol>                    
    </div>
    <!-- <div class="col-lg-2">
        <div class="title-action">
            <select class="selectpicker" data-live-search="true" id="channel_name">
            <option value="CNC3">CNC3</option>
            <option value="WTWG">WTWG</option>
            </select>
        </div>
    </div> -->
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
                                <figure>
                                <div id="player"></div>
                            </figure>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                <div class="col-lg-6">
                                    <div class="padding-15">
                                        <strong>Media ID:</strong> {{$station[0]->id}}     
                                    </div>                              
                                </div>
                                <div class="col-lg-6">
                                    <div class="padding-15">
                                        <?php 
                                            if (strpos($json, $station[0]->station_instance) !== false) {
                                                echo '<strong>Online:</strong></i><i class="fa fa-circle online"></i>';
                                            } else {
                                                echo '<strong>Offline:</strong><i class="fa fa-circle offline"></i>';
                                            }
                                        ?>
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
                                            <input type="hidden" id="streamid" value="{{$station[0]->id}}"></input>
                                               <form method="get" class="form-horizontal">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <label class="control-label">Title</label>
                                    <span type="text" class="form-control inline_edit_stream" id = "meta_title" value="">{{$station[0]->meta_title}}</span>
                                    </div>
                                </div>
                               <div class="form-group">
                                    <div class="col-sm-12">
                                    <label class="control-label">Description</label>
                                        <textarea rows="4" class="form-control inline_edit_stream" id = "description">{{$station[0]->description}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <label class="control-label">Copyright</label>
                                    <span type="text" class="form-control inline_edit_stream" id = "copyright" value="">{{$station[0]->copyright}}</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <label class="control-label">Author</label>
                                    <span type="text" class="form-control inline_edit_stream" id = "author" value="">{{$station[0]->author}}</span>
                                    </div>
                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Poster Image</a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                 <label class="control-label">Select File</label>
                                            <input id="input-7" name="input7[]" type="file" class="file-loading">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Output URL's</a>
                                            </h4>
                                        </div>
                                        <div id="collapseThree" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <form method="get" class="form-horizontal">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <label class="control-label">Apple (iOS)</label>
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
                                    <label class="control-label">MPEG DASH</label>
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
                                            <input type="text" class="form-control" value='<div id="myElement"><script>var playerInstance = jwplayer("myElement");	playerInstance.setup({image: "",sources: [{	file: "http://104.196.194.7:1935/live/{{$station[0]->station_instance}}/playlist.m3u8"}], autostart: "true",	androidhls: "true",	"width": "100%", abouttext: "Metamorphosis", aboutlink: "http://www.metamorphosis.tv", aspectratio: "16:9"	});</script></div>'><span class="input-group-btn"> 
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
<script>
	var playerInstance = jwplayer("player");
	playerInstance.setup({
		image: "",
		sources: [{
				file: "http://104.196.194.7:1935/live/{{$station[0]->station_instance}}/playlist.m3u8"
}
],
		autostart: "true",
		androidhls: "true",
		"width": "100%",
		abouttext: "Metamorphosis",
		aboutlink: "http://www.metamorphosis.tv",
		aspectratio: "16:9"
	});

$(document).on('ready', function() {
    $("#input-7").fileinput({
        showCaption: false, 
        uploadUrl: baseUrl+"/streamLogo/{{$station[0]->id}}",
        autoReplace: true,
        overwriteInitial: true,
        showUploadedThumbs: false,
        maxFileCount: 1,
        initialPreview: [
            "<img style='width:200px' src='{{$station[0]->station_logo}}'>",
        ],
        initialPreviewShowDelete: false,
        showRemove: false,
        showClose: false,
        layoutTemplates: {actionDelete: ''}, // disable thumbnail deletion
        allowedFileExtensions: ["jpg", "png", "gif"]                                
    });
});
</script>
@endsection
