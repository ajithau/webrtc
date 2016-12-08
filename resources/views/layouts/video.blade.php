<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ URL::to('/') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/public/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <link href="{{ URL::to('/') }}/css/plugins/fileinput/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('/') }}/css/animate.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/css/style.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

    <!-- Data Tables -->
    <link href="{{ URL::to('/') }}/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
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

    </body>
    <!-- Mainly scripts -->
    <script src="{{ URL::to('/') }}/js/jquery-2.1.1.js"></script>
    <script src="{{ URL::to('/') }}/js/bootstrap.min.js"></script>
    <script src="{{ URL::to('/') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="{{ URL::to('/') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ URL::to('/') }}/js/inspinia.js"></script>
    <script src="{{ URL::to('/') }}/js/plugins/pace/pace.min.js"></script>

    <!-- Pluupload -->
    <script type="text/javascript" src="{{ URL::to('/') }}/js/plupload.min.js"></script>

    <!-- Data Tables -->
    <script src="{{ URL::to('/') }}/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="{{ URL::to('/') }}/js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="{{ URL::to('/') }}/js/plugins/dataTables/dataTables.responsive.js"></script>
    <script src="{{ URL::to('/') }}/js/plugins/dataTables/dataTables.tableTools.min.js"></script>

    <!-- X-editable -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    
    <!-- Chosen -->
    <script src="{{ URL::to('/') }}/js/plugins/chosen/chosen.jquery.js"></script>
    
    <!-- File Input -->
    <script src="{{ URL::to('/') }}/js/plugins/fileinput/fileinput.min.js"></script>
    
    <!-- Select Picker -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>

    <!-- iCheck -->
    <script src="{{ URL::to('/') }}/js/plugins/iCheck/icheck.min.js"></script>

    <!-- Bootbox -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
    
    <!-- Validate -->
    <script src="{{ URL::to('/') }}/js/plugins/validate/jquery.validate.min.js"></script>
    <script src="{{ URL::to('/') }}/js/plugins/validate/jquery-validate.bootstrap-tooltip.min.js"></script>

    <!-- Custom js  -->
    <script src="{{ URL::to('/') }}/js/custom-video.js"></script>
</html>
