<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Styles -->
    <link href="<?php echo e(URL::to('/')); ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo e(URL::to('/')); ?>/public/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <link href="<?php echo e(URL::to('/')); ?>/css/plugins/chosen/chosen.css" rel="stylesheet">
    <link href="<?php echo e(URL::to('/')); ?>/css/plugins/footable/footable.core.css" rel="stylesheet">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" />
    <link href="<?php echo e(URL::to('/')); ?>/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" media="all" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(URL::to('/')); ?>/css/plugins/fileinput/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://npmcdn.com/leaflet@0.7.7/dist/leaflet.css" />
    <link href="<?php echo e(URL::to('/')); ?>/css/animate.css" rel="stylesheet">
    <link href="<?php echo e(URL::to('/')); ?>/css/style.css" rel="stylesheet">
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
            <?php echo $__env->make('layouts.navigation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <!-- Page wraper -->
            <div id="page-wrapper" class="gray-bg">

                <!-- Page wrapper -->
                <?php echo $__env->make('layouts.topnavbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <!-- Main view  -->
                <?php echo $__env->yieldContent('content'); ?>

                <!-- Footer -->
                <?php echo $__env->make('layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            </div>
            <!-- End page wrapper-->

        </div>
        <!-- End wrapper-->

    </body>
    <!-- Mainly scripts -->
    <script src="<?php echo e(URL::to('/')); ?>/js/jquery-2.1.1.js"></script>
    <script src="<?php echo e(URL::to('/')); ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo e(URL::to('/')); ?>/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo e(URL::to('/')); ?>/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo e(URL::to('/')); ?>/js/inspinia.js"></script>
    <script src="<?php echo e(URL::to('/')); ?>/js/plugins/pace/pace.min.js"></script>

    <!-- iCheck -->
    <script src="<?php echo e(URL::to('/')); ?>/js/plugins/iCheck/icheck.min.js"></script>

    <!-- Morris -->
    <script src="<?php echo e(URL::to('/')); ?>/js/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="<?php echo e(URL::to('/')); ?>/js/plugins/morris/morris.js"></script>
   
    <!-- FooTable -->
    <script src="<?php echo e(URL::to('/')); ?>/js/plugins/footable/footable.all.min.js"></script>
    
    <!-- Leaflet Map -->
    <script src="https://npmcdn.com/leaflet@0.7.7/dist/leaflet.js"></script>
     
    <!-- Date range use moment.js same as full calendar plugin -->
    <script src="<?php echo e(URL::to('/')); ?>/js/plugins/fullcalendar/moment.min.js"></script>

    <!-- X-editable -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    
     <!-- Chosen -->
    <script src="<?php echo e(URL::to('/')); ?>/js/plugins/chosen/chosen.jquery.js"></script>
    
     <!-- File Input -->
    <script src="<?php echo e(URL::to('/')); ?>/js/plugins/fileinput/fileinput.min.js"></script>
      <!-- Select Picker -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
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
</script>
</html>