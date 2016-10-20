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
    <link href="{{ URL::to('/') }}/css/plugins/fileinput/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
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

    </body>
    <!-- Mainly scripts -->
    <script src="{{ URL::to('/') }}/js/jquery-2.1.1.js"></script>
    <script src="{{ URL::to('/') }}/js/bootstrap.min.js"></script>
    <script src="{{ URL::to('/') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="{{ URL::to('/') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ URL::to('/') }}/js/inspinia.js"></script>
    <script src="{{ URL::to('/') }}/js/plugins/pace/pace.min.js"></script>

    <!-- File Input -->
    <script src="{{ URL::to('/') }}/js/plugins/fileinput/fileinput.min.js"></script>

    <!-- Pluupload -->
    <script type="text/javascript" src="{{ URL::to('/') }}/js/plupload.min.js"></script>

<script type="text/javascript">
// Custom example logic

var uploader = new plupload.Uploader({
    runtimes : 'html5,flash,silverlight,html4',
    browse_button : 'pickfiles', // you can pass an id...
    container: document.getElementById('container'), // ... or DOM Element itself
    url : 'upload',
    flash_swf_url : '../js/Moxie.swf',
    silverlight_xap_url : '../js/Moxie.xap',
    // add X-CSRF-TOKEN in headers attribute to fix this issue
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },    
    filters : {
        max_file_size : '1000mb',
        mime_types: [
            {title : "Video files", extensions : "mp3,mp4"},
        ]
    },

    init: {
        PostInit: function() {
            document.getElementById('filelist').innerHTML = '';

            document.getElementById('uploadfiles').onclick = function() {
                uploader.start();
                return false;
            };
        },

        FilesAdded: function(up, files) {
            plupload.each(files, function(file) {
                document.getElementById('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
            });
        },

        UploadProgress: function(up, file) {
            document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
        },

        Error: function(up, err) {
            document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
        }
    }
});

uploader.init();
uploader.bind('FileUploaded', function(up, file, info) {
  var obj = JSON.parse(info.response);
    $('#console').append('<input type="hidden" name="file_name[]" value="' + obj.result + '" />');
    //note obj.result.cleanFileName instead obj.cleanFileName
 });
</script>
</html>