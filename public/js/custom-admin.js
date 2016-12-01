
    // Set token for ajax call
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
     });

    // Initialising select picker
    $('.countries').selectpicker({
        style: 'btn-white',
        width: '100%'
    });
    $('.notifications').selectpicker({
        style: 'btn-white'
    });
    $('.access').selectpicker({
        style: 'btn-white'
    });
    $('.time-zone').selectpicker({
        style: 'btn-white'
    });
    $('.edit-countries').selectpicker({
        style: 'btn-white',
        width: '100%'
    });
    $('.edit-notifications').selectpicker({
        style: 'btn-white'
    });
    $('.edit-access').selectpicker({
        style: 'btn-white'
    });
    $('.edit-time-zone').selectpicker({
        style: 'btn-white'
    });

    // Validation admin user form
    $('.admin-user').validate({
      rules: {
            email: {email:true, required: true},
            mobile: {number:true, minlength: 10,  required: true},
        },
        messages: {
            mobile: {
                required: "This field is required.",
                mobile: "Please enter a valid mobile number"
            }
        }
    });

    $(document).on('ready', function() {
        // Initialize file upload
        $(".input-4").fileinput({showCaption: false, 
            uploadUrl: baseUrl+"videoLogo", // server upload action
            uploadAsync: true,
            allowedFileExtensions: ["jpg", "png", "gif"]
         });
        $(".input-5").fileinput({showCaption: false, 
            uploadUrl: baseUrl+"audioLogo", // server upload action
            uploadAsync: true
        });
        $(".input-6").fileinput({showCaption: false, uploadAsync: true});
        $(".input-7").fileinput({showCaption: false, uploadAsync: true});
    
        // Dealete Admin user ajax call
        $(".deleteUser").on("click", function(){
            var userid = $(this).attr('value');
            var tr = $(this).closest("tr");
            bootbox.confirm({
                    message: "Are you sure you want to permanently delete this user?",
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
                        tr.remove();
                        $.ajax({
                          url: baseUrl+"/users/delete/"+userid,
                          context: document.body
                        }).done(function() {
                          bootbox.alert("User deleted.");
                        });
                    }
                }
            });
        });

        // Delete Company 
        $(".deleteCompany").on("click", function(){
            var companyid = $(this).attr('value');
            var tr = $(this).closest("tr");
            var company = $(this).closest("tr").find('.companyname').text();
            console.log(company);
            bootbox.confirm({
                    message: "Are you sure you want to permanently delete <span class='company_confirm'>"+company+"</span>?",
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
                        tr.remove();
                        $(this).closest("tr").remove();
                        $.ajax({
                          url: baseUrl+"/users/deleteCompany/"+companyid,
                          context: document.body
                        }).done(function(data) {
                          bootbox.alert(data+" deleted");
                        });
                    }
                }
            });
        });    
    
        // Add Company ajax call
        $("#add-company").click(function () { 
            $(this).closest('form').validate({
              rules: {
                    email: {email:true, required: true},
                   // mobile: {number:true, minlength: 10,  required: true},
                },
                messages: {
                }
            });
            if($(this).closest('form').valid() == true ) { 
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var formData = {
                    'company_name'    : $(this).closest('form').find('input[name=company_name]').val(),
                    'address'         : $(this).closest('form').find('input[name=address]').val(),
                    'address1'        : $(this).closest('form').find('input[name=address1]').val(),
                    'zipcode'         : $(this).closest('form').find('input[name=zipcode]').val(),
                    'email'           : $(this).closest('form').find('input[name=email]').val(),
                    'website'         : $(this).closest('form').find('input[name=website]').val(),
                    'twitter'         : $(this).closest('form').find('input[name=twitter]').val(),
                    'mobile'          : $(this).closest('form').find('input[name=mobile]').val(),
                    'phone'           : $(this).closest('form').find('input[name=phone]').val(),
                    'fax'             : $(this).closest('form').find('input[name=fax]').val(),
                    'country'         : $(this).closest('form').find('select[name=country]').val()
                };
                // process the form
                $.ajax({
                    type        : "POST", 
                    data        : formData,
                    url         : baseUrl+"/users/createCompany",
                }).done(function(data) {
                    bootbox.alert("Company Details Added"); 
                    $('.company_id').val(data);
                });
            }
        });

        // Update company details
        $(".add-company").click(function () { 
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
            var formData = {
                'company_name'    : $(this).closest('form').find('input[name=company_name]').val(),
                'address'         : $(this).closest('form').find('input[name=address]').val(),
                'address1'        : $(this).closest('form').find('input[name=address1]').val(),
                'zipcode'         : $(this).closest('form').find('input[name=zipcode]').val(),
                'email'           : $(this).closest('form').find('input[name=email]').val(),
                'website'         : $(this).closest('form').find('input[name=website]').val(),
                'twitter'         : $(this).closest('form').find('input[name=twitter]').val(),
                'mobile'          : $(this).closest('form').find('input[name=mobile]').val(),
                'phone'           : $(this).closest('form').find('input[name=phone]').val(),
                'fax'             : $(this).closest('form').find('input[name=fax]').val(),
                'country'         : $(this).closest('form').find('select[name=country]').val(),            
                'company_id'      : $(this).closest('.modal').find('input[name=company_id]').val()
            };
            // process the form
            $.ajax({
                type        : "POST", 
                data        : formData,
                url         : baseUrl+"/users/updateCompany",
            }).done(function(data) {
                bootbox.alert("Company Details Added"); 
                $('#company_id').val(data);
            });
        });

        //  Add or update users in company details.
        $(".usr-btn").click(function () { 
            $(this).closest('form').validate({
              rules: {
                    email: {email:true, required: true},
                    mobile: {number:true, minlength: 10,  required: true},
                },
                messages: {
                    mobile: {
                        required: "This field is required.",
                        mobile: "Please enter a valid mobile number"
                    }
                }
            });
            if($(this).closest('form').valid() == true ) { 
                  $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                  });
                    var formData = {
                        'userid'        : $(this).attr('value'),
                        'company_id'    : $(this).closest('.modal').find('input[name=company_id]').val(), 
                        'first_name'    : $(this).closest('form').find('input[name=first_name]').val(),
                        'last_name'     : $(this).closest('form').find('input[name=last_name]').val(),
                        'name'          : $(this).closest('form').find('input[name=name]').val(),
                        'email'         : $(this).closest('form').find('input[name=email]').val(),
                        'password'      : $(this).closest('form').find('input[name=password]').val(),
                        'mobile'        : $(this).closest('form').find('input[name=mobile]').val(),
                        'access'        : $(this).closest('form').find('select[name=access]').val(),
                        'user_type'     : $(this).closest('form').find('select[name=user_type]').val(),
                        'notifications' : $(this).closest('form').find('select[name=notifications]').val()
                    };
                    // process the form
                    $.ajax({
                        type        : "POST", 
                        data        : formData,
                        url         : baseUrl+"/users/createCustomer",
                    }).done(function(data) {
                        if(data == "email") {
                            bootbox.alert("email already exist"); 
                        } else {
                            bootbox.alert("User Added"); 
                        }
                    });
            }
        });  

        // Add or update company timezone
        $(".timezone").click(function () { 
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          if($(this).closest('.modal').find('input[name=company_id]').val()=='') {
            bootbox.alert('Add company details');
            return false;
          }
            var formData = {
                'company_id'    : $(this).closest('.modal').find('input[name=company_id]').val(), 
                'timezone'      : $(this).closest('.modal').find('select[name=timezone]').val(),
            };
            // process the form
            $.ajax({
                type        : "POST", 
                data        : formData,
                url         : baseUrl+"/users/updateTimezone",
            }).done(function(data) {
                bootbox.alert("Timezone Added"); 
                // $('#company_id').val(data);
            });
        }); 

        /* Replicate Add user functionality */
        $(".btn-outline").click(function () {
            var cloned = $(this).closest( "#new-user" ).clone(true).find("input:text").val("").end();
            var cloned = cloned.find(".usr-btn").attr("value","").end();
            var append_user =  $(this).closest( ".collapse" );
            cloned.find('#selects').html('<div class="col-sm-6"><div class="form-group"><label>Access</label><select name="access" id="access" class="form-control selectpicker access" multiple title="Please select"><option value="User Management">User Management</option><option value="Video Library">Video Library</option><option value="Advertising">Advertising</option><option value="Switcher">Switcher</option><optgroup label="User Submitted"><option value="Video">Video</option><option value="Photos">Photos</option></optgroup></select></div></div><div class="col-sm-6"><div class="form-group"><label>Notifications</label><select name="notifications" id="notifications" class="form-control selectpicker notifications" multiple title="Please select"><option value="email">Email</option><option value="sms">SMS</option></select></div></div>');
            cloned.find('select').selectpicker({
                style: 'btn-white'
            });
            cloned.appendTo(append_user);

        });

        /* Replicate Product details */
        $('.video-station').click(function () { 
            var clone_video = $(this).closest( "#video-station" ).clone(true).find("input:text").val("").end();
            clone_video.find('.col-sm-4').html('<label class="control-label">Select Logo</label><input id="input-4" name="video_input4[]" type="file" class="file-loading input-4">');
            clone_video.find(".input-4").fileinput({showCaption: false, 
                uploadUrl: baseUrl+"videoLogo", // server upload action
                uploadAsync: true,
                allowedFileExtensions: ["jpg", "png", "gif"]
             });
            var append_video =  $(this).closest( "#video-station" );
            clone_video.insertAfter(append_video);
        });
        $('.audio-station').click(function () { 
            var clone_audio = $(this).closest( "#audio-station" ).clone(true).find("input:text").val("").end();
            clone_audio.find('.col-sm-4').html('<label class="control-label">Select Logo</label><input id="input-5" name="video_input5[]" type="file" class="file-loading input-5">');
            clone_audio.find(".input-5").fileinput({showCaption: false, 
                uploadUrl: baseUrl+"/audioLogo", // server upload action
                uploadAsync: true,
                allowedFileExtensions: ["jpg", "png", "gif"]
             });        
            var append_audio =  $(this).closest( "#audio-station" );
            clone_audio.insertAfter(append_audio);
        });

        // Remove staions
        $(".minus").click(function () {
            $(this).closest(".row").remove();
        });

        $("input[name='video']").change(function(){
            $value = $(this).val();
            if($value == 0) {
                $(this).closest('.collapse').find('.video-station').css("display", "block");
            } else {
                $(this).closest('.collapse').find('.video-station').css("display", "none");
            }
        });    
        $("input[name='radio']").change(function(){
            $value = $(this).val();
            if($value == 0) {
                $(this).closest('.collapse').find('.audio-station').css("display", "block");
            } else {
                $(this).closest('.collapse').find('.audio-station').css("display", "none");
            }
        });

    // Save product details
    $(".product").submit(function(e) {
        if($(this).closest('.modal').find('input[name=company_id]').val()=='') {
            bootbox.alert('Add company details');
            return false;
        }
        var data = $(this).closest('form').serialize();
        var companyId = $(this).closest('.modal').find('input[name=company_id]').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type        : "POST", 
            data        : data,
            url         : baseUrl+"/products/create",
        }).done(function(data) {
            bootbox.alert("Products Added"); 
        });
        e.preventDefault(); // avoid to execute the actual submit of the form.
    });

    $('#channel_name').selectpicker({
        style: 'btn-primary'
    });

    //  Inline Edit admin user details
    $.fn.editable.defaults.mode = 'inline';
    $('.inline_edit').editable({
        name: 'inline',
        title: 'inline',
        success: function(response, newValue) {
            var userid = $(this).closest( "tr" ).find('#user').attr('value');
            var field = this.id;
            var formData = {
                'userid'   : userid,
                'field'    : field,
                'value'    : newValue
            };  
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }); 
            $.ajax({
                type        : "POST", 
                data        : formData,
                url         : baseUrl+"/users/updateAdminInline",
                success: function(data){
                    //  retrun data.
                }
            });
        }
    });

    // Inline edit product details
    $('.inline_edit_stream').editable({
        name: 'inline',
        title: 'inline',
        success: function(response, newValue) {
            var userid = $('#streamid').val();
            var field = this.id;
            var formData = {
                'streamid' : userid,
                'field'    : field,
                'value'    : newValue
            };  
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }); 
            $.ajax({
                type        : "POST", 
                data        : formData,
                url         : baseUrl+"/product/update",
                success: function(data){
                    //  retrun data.
                }
            });
        }
    });
});
