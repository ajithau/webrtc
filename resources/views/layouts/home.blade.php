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
    <link href="http://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <link href="{{ URL::to('/') }}/css/plugins/chosen/chosen.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/css/plugins/footable/footable.core.css" rel="stylesheet">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" />
    <link href="{{ URL::to('/') }}/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('/') }}/css/plugins/fileinput/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://npmcdn.com/leaflet@0.7.7/dist/leaflet.css" />
    <link href="{{ URL::to('/') }}/css/animate.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/css/style.css" rel="stylesheet">
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
    <body>
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

    <!-- Custom and plugin javascript -->
    <script src="{{ URL::to('/') }}/js/inspinia.js"></script>
    <script src="{{ URL::to('/') }}/js/plugins/pace/pace.min.js"></script>

    <!-- iCheck -->
    <script src="{{ URL::to('/') }}/js/plugins/iCheck/icheck.min.js"></script>

    <!-- Morris -->
    <script src="{{ URL::to('/') }}/js/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="{{ URL::to('/') }}/js/plugins/morris/morris.js"></script>
   
    <!-- FooTable -->
    <script src="{{ URL::to('/') }}/js/plugins/footable/footable.all.min.js"></script>
    
    <!-- Leaflet Map -->
    <script src="https://npmcdn.com/leaflet@0.7.7/dist/leaflet.js"></script>
     
    <!-- Date range use moment.js same as full calendar plugin -->
    <script src="{{ URL::to('/') }}/js/plugins/fullcalendar/moment.min.js"></script>

    <!-- X-editable -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    
    <!-- Chosen -->
    <script src="{{ URL::to('/') }}/js/plugins/chosen/chosen.jquery.js"></script>
    
    <!-- File Input -->
    <script src="{{ URL::to('/') }}/js/plugins/fileinput/fileinput.min.js"></script>
    
    <!-- Select Picker -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>

    <!-- Load angular libraries
    Polyfill(s) for older browsers
    <script src="node_modules/core-js/client/shim.min.js"></script>
    <script src="node_modules/zone.js/dist/zone.js"></script>
    <script src="node_modules/reflect-metadata/Reflect.js"></script>
    <script src="node_modules/systemjs/dist/system.src.js"></script>
    2. Configure SystemJS
    <script src="systemjs.config.js"></script>    
    <script> 
          System.import('src').catch(function(err){ console.error(err); });
    </script>
    End of Scripts -->
<script>
    $('#countries').selectpicker({
        style: 'btn-white',
        width: '100%'
    });
    $('#notifications').selectpicker({
        style: 'btn-white'
    });
    $('#access').selectpicker({
        style: 'btn-white'
    });
    $('#time-zone').selectpicker({
        style: 'btn-white'
    });
    $('#edit-countries').selectpicker({
        style: 'btn-white',
        width: '100%'
    });
    $('#edit-notifications').selectpicker({
        style: 'btn-white'
    });
    $('#edit-access').selectpicker({
        style: 'btn-white'
    });
    $('#edit-time-zone').selectpicker({
        style: 'btn-white'
    });
    $(document).on('ready', function() {
        $("#input-4").fileinput({showCaption: false});
    })
    $(document).on('ready', function() {
        $("#input-5").fileinput({showCaption: false});
    });
    $(document).on('ready', function() {
        $("#input-6").fileinput({showCaption: false});
    })
    $(document).on('ready', function() {
        $("#input-7").fileinput({showCaption: false});
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
</script>
</html>
