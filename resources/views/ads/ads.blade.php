<?php 
/**
 * User Controller
 *
 * @copyright  2016 SparkSupport
 * @author     Ajith
 * @date       22-11-16
 * @contact    ajitharakkal@gmail.com
 */

// Remove forward slashes.
$withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $ads[0]->video);
$advideo    = str_replace("\\", '', $ads[0]->video);
$video_path = explode('portal', $advideo);

// Actual video url.
$video_path = explode('"', $video_path[1]);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Advertising Player</title>
    <link href='http://fonts.googleapis.com/css?family=Just+Another+Hand' rel='stylesheet' type='text/css'> 
    <script src="http://content.jwplatform.com/libraries/D219T2Wf.js"></script> 
    <script   src="https://code.jquery.com/jquery-3.1.1.min.js"   integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="   crossorigin="anonymous"></script>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/grid.css" rel="stylesheet">
    <style type="text/css">
    body {
      background-color: #CCCCCC;
    }
    </style>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-lg-12">
        <div id="player">Loading the player...</div>
          <script type="text/javascript">

          // set base url.
          var baseUrl = document.location.origin;
          var video   = "{{$ads[0]->video}}";
          var file    = video.split('/'); // Split video url.
          var img     = file[8].split('.'); // Get video name.
          var xml     = "{{$ads[0]->provider_xml}}";
          var adxml   = xml.split('public');
          var skip    = "{{$ads[0]->ad_autoplay}}";
          if( skip == 1) {
            skip = 5;
          } else {
            skip = false;
          }
            var wowsa = 'rtmp://104.196.194.7:1935/portal/_definst_/mp4:';   
            console.log(wowsa+'/'+file[7]+'/'+file[8]);      
            var playerInstance = jwplayer("player");
            playerInstance.setup({
                image: baseUrl+'/public/portal/'+file[7]+'/'+img[0]+'_600.jpg',
                sources: [{
                    file: wowsa+'/'+file[7]+'/'+file[8]
                }],
                autostart: "false",
                androidhls: "true",
                // "width": "100%",
                abouttext: "Metamorphosis",
                aboutlink: "http://www.metamorphosis.tv",
                aspectratio: "16:9",
                advertising: {
                        client: 'vast',
                        skipoffset: skip,
                        schedule: '{{ url("/") }}/public'+adxml[1]
                }
            });
            console.log('{{ url("/") }}/public'+adxml[1]);
          </script>
        </div>
      </div>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
