<?php 
/**
 * User Controller
 *
 * @copyright  2016 SparkSupport
 * @author     Ajith
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
    // get Uri segment
    $controller = Request::segment(1); 
    $method = Request::segment(2); 
?>
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">{{ Auth::user()->name}}</strong>
                            </span> <span class="text-muted text-xs block">Example menu </span>
                        </span>
                    </a>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li @if($controller == 'users') class='active' @endif >
                <a href="{{ url('/') }}/users"><i class="fa fa-male"></i> <span class="nav-label">User Management</span></a>
            </li> 
            <li  @if($controller == 'videos' && $method == '') class='active' @endif >
                <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">Streaming Video</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="live-stream-ingest-video.html">Live Stream Ingest</a></li>
                    <li  @if($controller == 'videos' && $method == '') class='active' @endif ><a href="{{ url('/') }}/videos">Video Library</a></li>
                    <li><a href="advertising.html">Advertising</a></li>
                </ul>
            </li> 
            <li>
                <a href="switcher.html"><i class="fa fa-sliders"></i> <span class="nav-label">Switcher</span></a>
            </li> 
            <li @if($method == 'user_submited') class='active' @endif >
                <a href="#"><i class="fa fa-upload"></i> <span class="nav-label">User Submitted</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li @if($method == 'user_submited') class='active' @endif ><a href="{{ url('/') }}/videos/user_submited">Video</a></li>
                    <li><a href="usc-photos.html">Photos</a></li>
                </ul>
            </li>             
        </ul>

    </div>
</nav>
