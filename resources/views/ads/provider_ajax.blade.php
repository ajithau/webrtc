<?php 
/**
 * User Controller
 *
 * @copyright  2016 SparkSupport
 * @author     Ajith
 * @date     26-10-16
 * @contact    ajitharakkal@gmail.com
 */
?>
  <div class="col-sm-12">
    <div class="form-group"  id="ad_provider1"><label class="col-sm-2 control-label">Ad Provider:</label>
         <div class="col-sm-8">
            <select class="select-ad-provider1" id="<?= $_REQUEST['time']; ?>" name="ad_provider[]">
                <option value=""></option>
                @foreach ($providers as $provider)
                <option value="{{ $provider['vast_tag'] }}">{{ $provider['provider_name'] }}</option>
                @endforeach
            </select>
         </div>
         <div class="col-sm-2"><button class="btn btn-primary btn-outline ad-provider-select1" type="button"><i class="fa fa-plus"></i></button></div>
         <div class="clearfix"></div>
    </div>
    <div id="ad_providers1"></div>
    </br>
    <div class="form-group adprovider" id="fall_ad_provider1"><label class="col-sm-2 control-label"></label>
          <div class="col-sm-8">
           <select class="select-fallback-ad-provider1" name="fall_provider[]">
                <option value=""></option>
                @foreach ($providers as $provider)
                <option value="{{ $provider['vast_tag'] }}">{{ $provider['provider_name'] }}</option>
                @endforeach
            </select>
         </div>
         <div class="col-sm-2">
            <div class="btn-group">
                <button class="btn btn-primary btn-outline  ad-fallback1" type="button"><i class="fa fa-plus"></i></button>
                <button class="btn btn-primary btn-outline ad-fallback-remove1" type="button"><i class="fa fa-minus"></i></button>
            </div>
        </div>
    </div>
    <div id="fall_ad_providers1"></div>
 </div>
<div class="clearfix"></div>
<script type="text/javascript">
$(document).ready(function() {
      $(".select-ad-provider1").select2({
      placeholder: "Select an Ad Provider",
          width: "100%",
          theme: "bootstrap",
      allowClear: true
      });

      $(".select-fallback-ad-provider1").select2({
      placeholder: "Select a Fallback Ad Provider",
          width: "100%",
          theme: "bootstrap",
      allowClear: true
      });

    /* Replicate ad provider */
    $(".ad-provider-select1").click(function () {
            $(this).closest('.col-sm-12').find('.adprovider').css('display', 'block');
        /*$(".select-ad-provider1").select2("destroy");
        $( "#ad_provider1" ).clone(true).appendTo( "#ad_providers1" );
        $(".select-ad-provider1").select2({
          placeholder: "Select an Ad Provider",
              width: "100%",
              theme: "bootstrap",
          allowClear: true
          });*/
    });
    /* Replicate fall back ad provider */
    $(".ad-fallback1").click(function () {
        $(".select-fallback-ad-provider1").select2("destroy");
        $( "#fall_ad_provider1" ).clone(true).appendTo( "#fall_ad_providers1" );
        $(".select-fallback-ad-provider1").select2({
          placeholder: "Select a Fallback Ad Provider",
              width: "100%",
              theme: "bootstrap",
          allowClear: true
          });
    });  

    /* Removes fall back ad provider */
    $(".ad-fallback-remove1").click(function () {
        $(this).closest("#fall_ad_provider1").remove();
    });   
    
    $(".ad-provider-select").click(function () {       
        $(this).closest('.ad-providers').find('.adprovider').css('display', 'block');
    });  
});
</script>

