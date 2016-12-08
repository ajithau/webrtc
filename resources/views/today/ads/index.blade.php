<?php 
/**
 * User Controller
 *
 * @copyright  2016 SparkSupport
 * @author     Ajith
 * @date 	   26-10-16
 * @contact    ajitharakkal@gmail.com
 */
?>
@extends('layouts.ad')
@section('title', 'Main page')

@section('content')
<?php
    // echo "<pre>";
    // print_r($ads);
?>
           <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-12">
                    <h2>Advertising</h2>                                 
                </div>            
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                    <div class="col-lg-6">
                        <!-- START: Accordion -->
                        <div class="panel-group accordion-panel-colour" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
         <i class="fa fa-empire"></i> Ad Providers
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        
        <table class="table table-striped table-bordered table-hover ad-provider"  id="example" >
        <thead>
        <tr>
            <th>Ad Provider</th>
            <th>VAST Tag</th>
            <th class="last-cl"></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($providers as $provider)
        <tr class="gradeX">
            <td class="ad">{{ $provider['provider_name'] }}</td>
            <td class="vast">{{ $provider['vast_tag'] }}</td>
            <td>
                <div class="text-center">
                    <button class="btn btn-xs btn-primary deleteProvider" type="button"  value="{{ $provider['id'] }}" >
                        <i class="fa fa-times" id="{{ $provider['id'] }}"></i>
                    </button>
                </div>
            </td>
        </tr>
        @endforeach
        </tbody>
        </table>
		<button type="button" id="addRow" class="btn btn-w-m btn-primary pull-right">Add New Provider</button>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          <i class="fa fa-desktop"></i> Video(s) with Advertising
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
        <table class="table table-striped table-bordered table-hover videos-with-advertising" >
            <thead>
            <tr>
                <th>Title</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($ads as $ad_video)
            <?php
                $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $ad_video->video);
                $img = explode('public', $withoutExt);
            ?>
            <tr class="gradeX">
                <td>                        	
                    <a href="#">
                		<img width="25px" src="{{ url('/') }}/public{{ $img[1] }}_130.jpg" alt="">&nbsp;
                        {{ $ad_video->library }}
                    	</a>
                	</td>
                <td><div class="text-center"><button class="btn btn-xs btn-primary delete-ad" value="{{ $ad_video->id }}" type="button"><i class="fa fa-times"></i></button></div></td>
                <td><div class="text-center"><button class="btn btn-xs btn-primary" type="button" data-toggle="modal" data-target="#embedCodeModal"><i class="fa fa-code"></i></button></div></td>		
            </tr>  
            <!-- START: Embed Code Modal -->
            <div class="modal" id="embedCodeModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content animated fadeIn">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>   
                            <h4 class="modal-title">Embed Code</h4>                                            
                        </div>
                        <div class="modal-body">
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
                            <input type="text" class="form-control" id="embeded" value='<script type="text/javascript">var playerInstance = jwplayer("player");playerInstance.setup({image: "http://ddwc.metamorphosis.tv/poster/ddwc.png",sources: [{ file: "{{ url("/") }}/public " }], autostart: "true",androidhls: "true",abouttext: "Metamorphosis",aboutlink: "http://www.metamorphosis.tv",aspectratio: "16:9",height: 378,width: 663,advertising: {client: "vast",
                                            schedule: {
                                                postroll:{
                                                    tag: "http://demo.tremorvideo.com/proddev/vast/vast2RegularLinear.xml",
                                                    offset: "post"
                                                }}}});</script>'><span class="input-group-btn"> 
                    <button class="btn btn-primary" type="button"><i class="fa fa-copy"></i> Copy</button>
                      </span></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>                    
            <!-- END: Embed Code Modal -->                    
            @endforeach                  
            </tbody>
            </table>
      </div>
    </div>
  </div>
  </div>
<!-- END: Accordion -->		
    </div>
    
    <div class="col-lg-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">                                
                <h5><i class="fa fa-cog"></i> Advertising Details</h5>
            </div>
            <div class="ibox-content">
            {!! Form::open(array('url' => 'addAdvertisement', 'class' => 'form-horizontal')) !!}
                <div class="form-group"><label class="col-sm-2 control-label">Ad Source:</label>
					  <div class="col-sm-10">
                       <div class="radio radio-green radio-inline">
                            <input type="radio" id="ad-provider" value="0" name="ad_source">
                            <label for="ad-provider"> Ad Provider </label>
                        </div>
                        <div class="radio radio-green radio-inline">
                            <input type="radio" id="video" value="1" name="ad_source">
                            <label for="video"> Video Library</label>
                        </div>

                     </div>
                </div>
                <div class="hr-line-dashed"></div>

            <!-- Add Provider -->
            <div class="ad-providers">
                <div class="form-group"  id="ad_provider"><label class="col-sm-2 control-label">Ad Provider:</label>
					 <div class="col-sm-8">
                        <select class="select-ad-provider" name="ad_provider[]">
							<option value=""></option>
                            @foreach ($providers as $provider)
                            <option value="{{ $provider['id'] }}">{{ $provider['provider_name'] }}</option>
                            @endforeach
						</select>
                     </div>
                     <div class="col-sm-2"><button class="btn btn-primary btn-outline ad-provider-select" type="button"><i class="fa fa-plus"></i></button></div>
                </div>
                 <div id="ad_providers"></div>
                <div class="form-group" id="fall_ad_provider"><label class="col-sm-2 control-label"></label>
					  <div class="col-sm-8">
                       <select class="select-fallback-ad-provider" name="fall_provider[]">
							<option value=""></option>
                            @foreach ($providers as $provider)
                            <option value="{{ $provider['id'] }}">{{ $provider['provider_name'] }}</option>
                            @endforeach
						</select>
                     </div>
                     <div class="col-sm-2">
                     	<div class="btn-group">
                            <button class="btn btn-primary btn-outline  ad-fallback" type="button"><i class="fa fa-plus"></i></button>
                            <button class="btn btn-primary btn-outline ad-fallback-remove" type="button"><i class="fa fa-minus"></i></button>
                        </div>
					</div>
                </div>
                <div id="fall_ad_providers"></div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-sm-2 control-label">Video Library:</label>
                      <div class="col-sm-10">
                            <select class="select-videos">
                                <option value=""></option>
                                @foreach($videos as $value)
                                    <?php $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $value->video);
                                    $img = explode('public', $withoutExt); ?>
                                    <option data-subtitle="{{$value->duration}}" data-url="{{$value->video}}" value="{{$value->id}}" data-left="<img src='{{url('/')}}/public{{$img[1]}}_130.jpg'>">{{$value->title}}</option>;
                                @endforeach
                            </select>
                     </div>                                     
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-sm-2 control-label">Ad Type:</label>
                      <div class="col-sm-10">
                       <select name="ad_type" id="" class="form-control">
                        <option value=""></option>
                        <option value="scheduled">Scheduled Ad Breaks</option>
                       </select>
                     </div>
                </div>
                <div class="hr-line-dashed"></div>

                <div class="video-play">
                    <div class="form-group">
                    <div class="col-sm-12 text-info"><h3>Video Title</h3></div>
                     </div>
                         <div class="form-group"> 
                         <div class="col-sm-12 no-padding">
                         <div id="player">Loading the player...</div>
                         </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                </div>
                <div class="noui">
                    <div class="form-group">                                  
                        <div class="col-sm-11">
                        <!-- Slider --> 
                            <span class="noUi-connect" id="slider"></span>
                            <span id="field"></span>
                        </div>
                        <div class="col-sm-1"><button class="btn btn-primary" type="button" id="break"><i class="fa fa-plus ad_time"></i></button></div>
                    </div>
                    <div class="form-group ad_break">                                  

                    </div>
                    <div class="hr-line-dashed"></div>
                </div>

            
            </div>
            <!-- End Ad provider -->

            <!-- End Video Lib -->
            <div class="ad-video-lib">
                <div class="form-group"><label class="col-sm-2 control-label">Video Library:</label>
                      <div class="col-sm-10">
                            <select class="select-videos">
                                <option value=""></option>
                                @foreach($videos as $value)
                                    <?php $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $value->video);
                                    $img = explode('public', $withoutExt); ?>
                                    <option data-subtitle="{{$value->duration}}" data-url="{{$value->video}}" value="{{$value->id}}" data-left="<img src='{{url('/')}}/public{{$img[1]}}_130.jpg'>">{{$value->title}}</option>;
                                @endforeach
                            </select>
                     </div>                                     
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-sm-2 control-label">Ad Type:</label>
                      <div class="col-sm-10">
                       <select name="ad_type" id="" class="form-control">
                        <option value=""></option>
                        <option value="scheduled">Scheduled Ad Breaks</option>
                        <option value="preroll">Preroll</option>
                        <option value="postroll">Postroll</option>
                       </select>
                     </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-sm-2 control-label">Video:</label>
                      <div class="col-sm-10">
                        <select class="select-video" name="video_id">
                            <option value=""></option>
                            @foreach($videos as $value)
                                <?php $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $value->video);
                                $img = explode('public', $withoutExt); ?>
                                <option data-subtitle="{{$value->duration}}" data-url="{{$value->video}}" value="{{$value->id}}" data-left="<img src='{{url('/')}}/public{{$img[1]}}_130.jpg'>">{{$value->title}}</option>;
                            @endforeach
                        </select>
                     </div>
                </div>
                <div class="hr-line-dashed"></div>

                <div class="video-play">
                    <div class="form-group">
                    <div class="col-sm-12 text-info"><h3>Video Title</h3></div>
                     </div>
                         <div class="form-group"> 
                         <div class="col-sm-12 no-padding">
                         <div id="player">Loading the player...</div>
                         </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                </div>
                <div class="noui">
                    <div class="form-group">                                  
                        <div class="col-sm-11">
                        <!-- Slider --> 
                            <span class="noUi-connect" id="slider"></span>
                            <span id="field"></span>
                        </div>
                        <div class="col-sm-1"><button class="btn btn-primary" type="button" id="break"><i class="fa fa-plus ad_time"></i></button></div>
                    </div>
                    <div class="form-group ad_break">                                  

                    </div>
                    <div class="hr-line-dashed"></div>
                </div>
            </div>
            <!-- End Video Lib -->
            <div class="scheduled-ad">
                <div class="form-group"><label class="col-sm-2 control-label">Scheduled Ad Breaks:</label>
					  <div class="col-sm-10">
                       <div class="radio radio-green radio-inline">
                            <input type="radio" id="scheduled-ad-no" value="0" name="scheduled-ad-breaks" checked="">
                            <label for="scheduled-ad-no"> No </label>
                        </div>
                        <div class="radio radio-green radio-inline">
                            <input type="radio" id="scheduled-ad-yes" value="1" name="scheduled-ad-breaks">
                            <label for="scheduled-ad-yes"> Yes </label>
                        </div>
                     </div>
                </div>
                <div class="hr-line-dashed"></div>
            </div>
            <div class="companion-ad">
                <div class="form-group"><label class="col-sm-2 control-label">Companion Ad:</label>
					  <div class="col-sm-10">
                       <div class="radio radio-green radio-inline">
                            <input type="radio" id="companion-ad-no" value="0" name="companion_ad" checked="">
                            <label for="companion-ad-no"> No </label>
                        </div>
                        <div class="radio radio-green radio-inline">
                            <input type="radio" id="companion-ad-yes" value="1" name="companion_ad">
                            <label for="companion-ad-yes"> Yes </label>
                        </div>
                     </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="companion-details">
                    <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
    					 <div class="col-sm-4">
    					       <label for="div-id" class="control-label">DIV ID</label>
    							<input id="div-id" name="div_id" type="text" class="form-control">
                         </div>
                         <div class="col-sm-3">
                            <label for="height">Height</label>
							<div class="input-group">
                                <input type="number" id="height" name="div_height" class="form-control"> <span class="input-group-addon">px</span>
                            </div> 
                         </div>
                         <div class="col-sm-3">
                            <label for="height">Width</label>
							<div class="input-group">
                                <input type="number" id="width" name="div_width" class="form-control"> <span class="input-group-addon">px</span>
                            </div> 
                         </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                </div>
                <div class="form-group"><label class="col-sm-2 control-label">Ad Message (<span class="text-danger">Optional</span>):</label>
					  <div class="col-sm-10">
                       <input type="text" class="form-control">
                     </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-sm-2 control-label">Skip Ad:</label>
					  <div class="col-sm-10">
                       <div class="radio radio-green radio-inline">
                            <input type="radio" id="skip-no" value="0" name="skip_ad" checked="">
                            <label for="skip-no"> No </label>
                        </div>
                        <div class="radio radio-green radio-inline">
                            <input type="radio" id="skip-yes" value="1" name="skip_ad">
                            <label for="skip-yes"> Yes </label>
                        </div>
                     </div>
                </div>
                <div class="hr-line-dashed"></div>
            </div>
                <div class="form-group">
                <div class="col-sm-12">
                <button type="submit" class="btn btn-w-m btn-primary pull-right">Save</button>
					</div>
				 </div>
				</form>
            </div>
        </div>
        {!! Form::close() !!}
    </div>        
    </div>
    </div>
    <?php 
    // $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $video[0]['video']);
    // $video_path = explode('public', $video[0]['video']); 
    // $img_path   = explode('public', $withoutExt);
    ?>      
    <!-- JW PLayer -->
    <script src="http://content.jwplatform.com/libraries/D219T2Wf.js"></script>

    <script type="text/javascript">

    $(".select-videos").change(function(){
        $("#video-play").css('display', 'block');
        var selected = $(this).find('option:selected');
        var file = selected.data('url'); 
        file = file.split('/');
        $( document ).ready(function() {
            var playerInstance = jwplayer("player");
            playerInstance.setup({
                image: "http://ddwc.metamorphosis.tv/poster/ddwc.png", 
                sources: [{ 
                    file: baseUrl+'/public/videos/'+file[7]+'/'+file[8]
                }],    
            autostart: "false",
            androidhls: "true",
            abouttext: "Metamorphosis",
            aboutlink: "http://www.metamorphosis.tv",
            aspectratio: "16:9",
            height: "100%",
            width: "100%",
            });
        });
    });

  $( document ).ready(function() {

    var slider = document.getElementById('slider');

    noUiSlider.create(slider, {
      start: [ 0 ],
      range: {
        'min': [  0 ],
        'max': [ 634 ]
      }
    })
    var rangeSliderValueElement = document.getElementById('field');

    slider.noUiSlider.on('update', function( values, handle ) {
      rangeSliderValueElement.innerHTML = Math.round(values)+' Seconds';
      if(values[handle] != '0.00') {
        jwplayer("player").seek(values[handle])
      }
    });

  });
  </script>
@endsection