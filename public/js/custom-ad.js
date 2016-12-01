    $(document).ready(function() {
      // $('.ad-provider').DataTable();
      $('.videos-with-advertising').DataTable();

      $(".select-ad-provider").select2({
      placeholder: "Select an Ad Provider",
          width: "100%",
          theme: "bootstrap",
      allowClear: true
      });

      $(".select-fallback-ad-provider").select2({
      placeholder: "Select a Fallback Ad Provider",
          width: "100%",
          theme: "bootstrap",
      allowClear: true
      });
      $(".select-videos").selectator();
      $(".select-video").selectator();
      $(".modal-video").selectator();

      $(".form-horizontal").validate({
         rules: {  
             height: "required",                     
         }
      });

    $("input[name='ad_source']").change(function(){
        $value = $(this).val();
        $('.companion-ad').css("display", "block");
        $('.save-ad').css('display', 'block');        
        if($value == 0) {
            $('.modal-videos').removeAttr('id');
            $('.modal-provider').attr('id', 'adbreak');
            $('.ad-video-lib').css('display', 'none');
            $('.ad-providers').css('display', 'block');
        } else {
            $('.modal-provider').removeAttr('id');
            $('.modal-videos').attr('id', 'adbreak');
            $('.ad-providers').css('display', 'none');
            $('.ad-video-lib').css('display', 'block');
        }
        var url = baseUrl+'/ads/getVideo';
        $.ajax({
            type        : "GET", 
            url         : url,
            success: function(data){
                $('#video-ajax').html(data);

            }
        });

    });
    $(".ad-provider-select").click(function () {       
        $(this).closest('.ad-providers').find('.adprovider').css('display', 'block');
    });    
    $("input[name='companion_ad']").change(function(){
        $value = $(this).val();
        if($value == 0) {
            $('.companion-details').css("display", "none");
        } else {
            $('.companion-details').css("display", "block");
        }
    });
    $(".select-videos").change(function(){
        $('.video-play').css('display', 'block');
    });
  });
  $(document).ready(function() {

    /* Add new user to datatable*/ 
    var t = $('#example').DataTable({
        "order": [[ 2, "desc" ]]
    });
    var counter = 1;
 
    $('#addRow').on( 'click', function () {
        t.row.add( [
            '<a class="ad" >Ad Provider</a>' ,
            '<a class="vast" >VAST Tag</a>' ,
            '<div class="text-center"><button class="btn btn-xs btn-primary deleteProvider" type="button"><i class="fa fa-times" value="new" id="new'+counter+'"></i></button></div>' 
        ] ).draw(false);
 
        $(".deleteProvider").on("click", function(){
            var tr = $(this).parents('tr');
            t.row( tr ).remove().draw();
        });
        counter++;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        /* Edit detail onclick */
        $.fn.editable.defaults.mode = 'inline';
        $('#example .vast').editable({
            name: 'vast',
            title: 'vast',
            source: [
              {value: 0, text: 'Nothing'}
            ],
            success: function(response, newValue) {
                var id = $(this).closest( "tr" ).find('.fa-times').attr('id');
                var val = $(this).closest( "tr" ).find('.fa-times').attr('value');
                if(val == "new") {
                    var url = "adprovider";
                    var formData = {
                        'vast'    : newValue
                    };                    
                } else {
                    var url = "updateprovider";
                    var formData = {
                        'vast'    : newValue,
                        'id'    : id
                    };                    
                }
                $.ajax({
                    type        : "POST", 
                    data        : formData,
                    url         : url,
                    success: function(data){
                        $('#'+id).attr('value', data);
                        $('#'+id).attr('id', data);
                    }
                });
            }
        });
        $('#example .ad').editable({
            name: 'ad_provider',
            title: 'ad_provider',
            source: [
              {value: 0, text: 'Nothing'}
            ],
            success: function(response, newValue) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var id = $(this).closest( "tr" ).find('.fa-times').attr('id');
                var val = $(this).closest( "tr" ).find('.fa-times').attr('value');
                if(val == "new") {
                    var url = "adprovider";
                    var formData = {
                        'ad'    : newValue
                    };                    
                } else {
                    var url = "updateprovider";
                    var formData = {
                        'ad'    : newValue,
                        'id'    : id
                    };                    
                }
                $.ajax({
                    type        : "POST", 
                    data        : formData,
                    url         : url,
                    success: function(data){
                        $('#'+id).attr('value', data)
                        $('#'+id).attr('id', data);
                    }
                });
            }
        });
    } );

    /* Edit detail onclick */
    $.fn.editable.defaults.mode = 'inline';
    $('#example .vast').editable({
        name: 'vast',
        title: 'vast',
        source: [
          {value: 0, text: 'Nothing'}
        ],
        success: function(response, newValue) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var id = $(this).closest( "tr" ).find('.fa-times').attr('id');
            var url = "updateprovider";
            var formData = {
                'vast'    : newValue,
                'id'    : id
            };                    

            $.ajax({
                type        : "POST", 
                data        : formData,
                url         : url,
                success: function(data){
                    $('#'+id).attr('value', data);
                    $('#'+id).attr('id', data);
                }
            });
        }
    });
    $('#example .ad').editable({
        name: 'ad_provider',
        title: 'ad_provider',
        source: [
          {value: 0, text: 'Nothing'}
        ],
        success: function(response, newValue) {
            var id = $(this).closest( "tr" ).find('.fa-times').attr('id');
            var url = "updateprovider";
            var formData = {
                'ad'    : newValue,
                'id'    : id
            };                    
            $.ajax({
                type        : "POST", 
                data        : formData,
                url         : url,
                success: function(data){
                    $('#'+id).attr('value', data)
                    $('#'+id).attr('id', data);
                }
            });
        }
    });

    /* Replicate ad provider */
    /*$(".ad-provider-select").click(function () {
        $(".select-ad-provider").select2("destroy");
        $( "#ad_provider" ).clone(true).appendTo( "#ad_providers" );
        $(".select-ad-provider").select2({
          placeholder: "Select an Ad Provider",
              width: "100%",
              theme: "bootstrap",
          allowClear: true
          });
    });*/
    /* Replicate fall back ad provider */
    $(".ad-fallback").click(function () {
        $(".select-fallback-ad-provider").select2("destroy");
        $( "#fall_ad_provider" ).clone(true).appendTo( "#fall_ad_providers" );
        $(".select-fallback-ad-provider").select2({
          placeholder: "Select a Fallback Ad Provider",
              width: "100%",
              theme: "bootstrap",
          allowClear: true
          });
    });
  
    /* Removes fall back ad provider */
    $(".ad-fallback-remove").click(function () {
        $(this).closest("#fall_ad_provider").remove();
    });

    $('#ad-form').validate({
        rules: {
            ad_type: {required: true},
            ad_provider: {required: true},
            selected_video: {required: true},
            ad_video: {required: true}
        }
    });
    $('select[name="ad_type_tag"]').change(function() {
        if ($('select[name="selected_video"]').val() === "") {
            bootbox.alert('Select a video'); 
        }
    });

    var count = 1;
    var playerInstance = jwplayer("player");

    // Delete Provider   
    $(".deleteProvider").on("click", function(){
        var providerid = $(this).attr('value');
        var tr = $(this).parents('tr');
        bootbox.confirm({
                message: "Are you sure you want to delete this ad provider?",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-danger'
                    }
            },
            callback: function (result) {
                console.log('This was logged in the callback: ' + result);
                if(result){
                     $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    url = "ads/delete/"+providerid;
                    $.ajax({
                        type : "GET", 
                        url  : url,
                        success: function(data){
                        }
                    });
                    t.row( tr ).remove().draw();
                    bootbox.alert('Provider Deleted'); 
                }
            }
        });
    });
    // Delete advertisement videos   
    $(".delete-ad").on("click", function(){
        var providerid = $(this).attr('value');
        var tr = $(this).closest('tr');
        bootbox.confirm({
                message: "Are you sure you want to delete this Advertisement?",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-danger'
                    }
            },
            callback: function (result) {
                console.log('This was logged in the callback: ' + result);
                if(result){
                     $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    url = "ads/deleteAd/"+providerid;
                    $.ajax({
                        type : "GET", 
                        url  : url,
                        success: function(data){
                        }
                    });
                    t.row( tr ).remove().draw();
                    bootbox.alert('Advertisement Deleted'); 
                }
            }
        });
    });
    $("select[name='ad_type_tag']").change(function(){
        if($(this).val() == 'scheduled') {
            $('.noui').css("display", "block");
        } else {
            $('.noui').css("display", "none");
        }
    });
    $("select[name='ad_type_library']").change(function(){
        if($(this).val() == 'scheduled') {
            $('.noui').css("display", "block");
        } else {
            $('.noui').css("display", "none");
        }
    });
    $('.modal-select').click(function(){
        var modal_select = $(".modal-video").val();
        alert(modal_select);
        $(".ad_break .col-sm-3:last-child").append("<input type='hidden' value='"+modal_select+"' name='ad_video1[]'>");
        $( ".select-ad-provider1" ).each(function() {
            var provider = $(this).val();
            var time = $(this).attr('id');
            $(".ad_break .col-sm-3:last-child").append("<input type='hidden' value='"+provider+"' name='ad_provider1["+time+"][]'>");
        });
        $( ".select-fallback-ad-provider1" ).each(function() {
            var provider = $(this).val();
            var time = $(this).attr('id');
            $(".ad_break .col-sm-3:last-child").append("<input type='hidden' value='"+provider+"' name='fall_ad_provider1["+time+"][]'>");
        });
    });
    $('#modal-remove').click(function(){
        $(".ad_break .col-sm-3:last-child").remove();
    });

    // Copy embedded code.
    $(".copy").click(function(){
      var code = $(this).closest('.input-group').find("input[name=embedded]").get(0);
      code.select();
      document.execCommand('copy'); // or 'cut'
    });


});
