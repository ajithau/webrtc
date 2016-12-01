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
<script type="text/javascript">
$(document).ready(function() {
    
    // Ad break slider
    var count = 1;
    var url = "provider-ajax";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#break").click(function () {
        var formData = {
            'time'    : slider.noUiSlider.get(),
        };  
        $.ajax({
            type        : "GET", 
            url         : url,
            data        : formData,
            success: function(data){
                $('#provider-ajax').html(data);
            }
        });  
        $(".ad_break").append('<div class="col-sm-3"><label for="" class="control-label">Break '+count+'</label><div class="input-group"><input type="number" class="form-control" min="0" name="ad_time[]" value="'+slider.noUiSlider.get()+'"><span class="input-group-btn"><button class="btn btn-primary ad_remove" type="button"><i class="fa fa-minus"></i></button></span></div></div>');
        count++;
        /* Removes fall break ads */
        $(".ad_remove").click(function () {
            $(this).closest(".col-sm-3").remove();
        });

    });  
});
</script>