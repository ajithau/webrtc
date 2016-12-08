<?php 
/**
 * User Controller
 *
 * @copyright  2016 SparkSupport
 * @author     Ajith
 * @date 	   08-11-16
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
?>
@extends('layouts.user')
@section('title', 'Main page')

@section('content')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">                                
                    <h5><i class="fa fa-list-alt"></i> Video Listing</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
						<div class="col-lg-9"></div>
                    	<div class="col-lg-3">
                            {!! Form::open(array('id' => 'filter', 'method' => 'get')) !!}
                    		 <div class="form-group">    
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Filter" name="filter">
                                    <div class="input-group-addon">
                                        <i class="fa fa-filter filter"></i>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                    	</div>
                    </div>
                        <ul class="list-inline">
                            @foreach ($videos as $video)
                            <?php $url = explode('/', $video->url);?>
                            <?php $image = explode('.', $url[7]);?>
                            <li>
                                <div class="thumbnail" >
                                    <img data-toggle="modal" data-target="#usc-video-{{$video->id}}" src="{{ url('/') }}/public/user-videos/{{ $image[0] }}.jpg" width="295" height="220" alt="">
                                    <div>
                                    <small class="text-info">Date Submitted</small><br>
                                    <span class="text-muted">{{ $video->created_at }}</span>
                                    </div>
                                    <div>
                                        <small class="text-info">Submitted By</small><br>
                                        <span class="text-muted">{{ $video->user }}</span>
                                    </div>
                                    <div>
                                        <small class="text-info">Country Submitted From</small><br>
                                        <span class="text-muted">{{ $video->country }}</span>
                                    </div>
                                    <div align="right">
                                        <div class="btn-group">
                                        <button class="btn btn-xs btn-primary btn-outline img-delete" type="button" value="{{ $video->id }}">Delete</button>
                                        <button class="btn btn-xs btn-primary" type="button"><a class="download" href="{{ url('/') }}/public/user-videos/{{ $url[7] }}" download>Download</a></button>
                                    </div>
                                    </div>
                                </div>
                            </li>
                            <!-- START: Modal -->
                    <div class="modal inmodal" id="usc-video-{{$video->id}}" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                     <span class="pull-left"><strong>&nbsp;</strong></span>
                                </div>
                                <div class="modal-body no-padding">
                                    <div id="player"></div>
                                    <div class="row">
                                    <div class="col-sm-12 padding-bottom-15">   
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td class="modal-img" nowrap><strong class="text-info pull-right">Date Submitted:</strong></td>
                                                <td>{{ $video->created_at }}</td>
                                            </tr>
                                            <tr>
                                                <td class="modal-img" nowrap><strong class="text-info pull-right">Submitted By:</strong></td>
                                                <td>{{ $video->user }}</td>
                                            </tr>
                                            <tr>
                                                <td class="modal-img" nowrap><strong class="text-info pull-right">Country Submitted From:</strong></td>
                                                <td>{{ $video->country }}</td>
                                            </tr>
                                            <tr>
                                                <td class="modal-img" nowrap><strong class="text-info pull-right">Story:</strong></td>
                                                <td>
                                                    <p>{{ $video->story }}</p>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                   </div>
                                </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="btn-group">
                                        <button class="btn btn-primary btn-outline img-delete" type="button" value="{{ $video->id }}">Delete</button>
                                        <button class="btn btn-primary" type="button"><a class="download" href="{{ url('/') }}/public/user-videos/{{ $url[7] }}" download>Download</a></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!-- END: Modal -->                
                </ul>              
                <input type="hidden" value="video" name="link"></input>                  
                <nav class="text-center">
                    <ul class="pagination">
                        @include('pagination.default', ['paginator' => $videos])
                    </ul>
                </nav>
                </div>
             </div>
        </div>            
	</div>
</div>
    <!-- Video player plugins -->
    <script src="http://content.jwplatform.com/libraries/D219T2Wf.js"></script>
    <!-- <script>jwplayer.key="ABCdeFG123456SeVenABCdeFG123456SeVen==";</script>-->
    @if(isset($image))
    <script type="text/javascript">
         var playerInstance = jwplayer("player");
            playerInstance.setup({
            image: "{{ url('/') }}/public/user-videos/{{ $image[0] }}.jpg", 
            sources: [{ 
            file: "{{ url('/') }}/public/user-videos/{{ $url[7] }}"            
                }],            
            autostart: "false",
            androidhls: "true",
            abouttext: "Metamorphosis",
            aboutlink: "http://www.metamorphosis.tv",
            aspectratio: "16:9",
            height: 500,
            width: 898,
                    advertising: {
                    client: 'vast',
                    schedule: {
                    postroll:{
                        tag: 'http://demo.tremorvideo.com/proddev/vast/vast2RegularLinear.xml',
                        offset: 'post'
                    }
                }
            }
        }); 
    </script>
    @endif
@endsection
