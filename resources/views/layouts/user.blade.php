<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ URL::to('/') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/public/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/css/animate.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/css/style.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/css/plugins/fileinput/fileinput.min.css" media="all" rel="stylesheet">
    <!-- Scripts -->
    <script>
    /*    window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>*/
    </script>
</head>
    <body style="padding: 0 !important">
      <!-- Wrapper-->
        <div id="wrapper">

            <!-- Navigation -->
            @include('layouts.navigation')

            <!-- Page wraper -->
            <div id="page-wrapper" class="gray-bg">

                <!-- Page wrapper -->
                @include('layouts.topnavbar')

                <!-- Main view  -->
                @yield('content')

                <!-- Footer -->
                @include('layouts.footer')

            </div>
            <!-- End page wrapper-->

        </div>
        <!-- End wrapper-->
    <my-app>
    </my-app>
    </body>
    <!-- Mainly scripts -->
    <script src="{{ URL::to('/') }}/js/jquery-2.1.1.js"></script>
    <script src="{{ URL::to('/') }}/js/bootstrap.min.js"></script>
    <script src="{{ URL::to('/') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="{{ URL::to('/') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- File Input -->
    <script src="{{ URL::to('/') }}/js/plugins/fileinput/fileinput.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ URL::to('/') }}/js/inspinia.js"></script>
    <script src="{{ URL::to('/') }}/js/plugins/pace/pace.min.js"></script>

    <!-- Bootbox -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>

    <script type="text/javascript">
    $(document).on('ready', function() {
        // Set token for ajax call
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
         });

        // Initialize file upload
        $(".input-4").fileinput({showCaption: false, 
            uploadUrl: baseUrl+"/userphoto", // server upload action
            uploadAsync: true,
            allowedFileExtensions: ["jpg", "png", "gif"]
         });
    });
    $(".img-delete").on("click", function(){
        var link = $("input[name='link']").val();
        var id = $(this).attr('value');
        var tr = $(this).closest("li");
        if(link == 'video') {
            var url = baseUrl+"/delete-video/"+id
        } else if(link == 'photo') {
            var url = baseUrl+"/photos/deletePhoto/"+id
        }
        bootbox.confirm({
                message: "Are you sure you want to permanently delete this image?",
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
                      url: url,
                      context: document.body
                    }).done(function() {
                      bootbox.alert("Photo deleted.");
                    });
                }
            }
        });
    });
    $(".filter").on("click", function(){
        $(this).closest('form').submit();
    });
    
    </script>
</html>