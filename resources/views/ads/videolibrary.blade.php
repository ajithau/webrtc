<?php 
/**
 * User Controller
 *
 * @copyright  2016 SparkSupport
 * @author     Ajith
 * @date       26-10-16
 * @contact    ajitharakkal@gmail.com
 */
?>
    <!-- Video Lib -->
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
    </div>
    <!-- End Video Lib -->
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
            <div class="col-sm-1"><button class="btn btn-primary" type="button" data-toggle="modal" data-target="#adbreak" id="break"><i class="fa fa-plus ad_time"></i></button></div>
        </div>
        <div class="form-group ad_break">
        </div>
        <div class="hr-line-dashed"></div>
    </div>
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
        <!-- START: Modal -->
            <div class="modal inmodal" id="adbreak" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content animated fadeIn">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <span class="pull-left"><strong>Select video</strong> </span>
                        </div>
                        <div class="modal-body">
                            <div class="form-group"><label class="col-sm-2 control-label">Video:</label>
                                  <div class="col-sm-10">
                                    <select class="modal-video" name="video_id">
                                        <option value=""></option>
                                        @foreach($videos as $value)
                                            <?php $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $value->video);
                                            $img = explode('public', $withoutExt); ?>
                                            <option data-subtitle="{{$value->duration}}" data-url="{{$value->video}}" value="{{$value->id}}" data-left="<img src='{{url('/')}}/public{{$img[1]}}_130.jpg'>">{{$value->title}}</option>;
                                        @endforeach
                                    </select>
                                 </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        <!-- END: Modal -->
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
<script type="text/javascript">
    $(document).ready(function() {
        var slider = document.getElementById('slider');
        noUiSlider.create(slider, {
          start: [ 0 ],
          tooltips: [ true ],
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