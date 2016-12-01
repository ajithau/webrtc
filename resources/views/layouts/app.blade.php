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
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/xeditable.min.css" rel="stylesheet">
    <link href="public/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/css/plugins/select2/select2.min.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/css/plugins/select2/select2-bootstrap.min.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/css/animate.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/css/style.css" rel="stylesheet">
    <script src="{{ URL::to('/') }}/js/jquery-2.1.1.js"></script>
    <script src="{{ URL::to('/') }}/js/plugins/select2/select2.full.min.js"></script>
    <script src="{{ URL::to('/') }}/js/bootstrap.min.js"></script>
    <!-- image selector -->
    <script src="{{ URL::to('/') }}/js/fm.selectator.jquery.js"></script>
    <script>
      window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body class="gray-bg">
    @yield('content')
</body>
    <!-- Validate -->
    <script src="{{ URL::to('/') }}/js/plugins/validate/jquery.validate.min.js"></script>
    <script src="{{ URL::to('/') }}/js/plugins/validate/jquery-validate.bootstrap-tooltip.min.js"></script>
    <script>
        $('form').validate();
    </script>
</html>
