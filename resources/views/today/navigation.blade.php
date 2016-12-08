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
$method     = Request::segment(2); 

// Hide links as per user aceess.
$permission = unserialize(Auth::user()->access);
if(!is_array($permission)) {
    $permission = array();
}?>
<script type="text/javascript">
    var baseUrl = document.location.origin+'/angul';
</script>
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">{{ Auth::user()->name}}</strong>
                            </span> <span class="text-muted text-xs block">
                                @if(Auth::user()->role == 2) {{"Super Admin"}} 
                                @elseif(Auth::user()->role == 3 || Auth::user()->role == 1) {{"Admin"}}
                                @elseif(Auth::user()->role == 4) {{"Content Editor"}}
                                @endif
                            </span>
                        </span>
                    </a>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            @if(Auth::user()->role == 1)
                <li @if($controller == 'users') class='active' @endif >
                    <a href="{{ url('/') }}/users"><i class="fa fa-users"></i> <span class="nav-label">Admin Users</span></a>
                </li>
                <li @if($controller == 'customers') class='active' @endif >
                    <a href="{{ url('/') }}/customers"><i class="fa fa-gears"></i> <span class="nav-label">Customers</span></a>
                </li> 
            @else
                @if (in_array("User Management", $permission))
                <li @if($controller == 'user-management') class='active' @endif >
                    <a href="{{ url('/') }}/user-management"><i class="fa fa-male"></i> <span class="nav-label">User Management</span></a>
                </li> 
                @endif
                @if (in_array("Live Streaming", $permission) || in_array("Video Library", $permission) || in_array("Advertising", $permission))
                <li  @if($controller == 'videos'|| $controller == 'advertisement' || $controller == 'live-stream-ingest') class='active' @endif >
                    <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">Streaming Video</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        @if (in_array("Live Streaming", $permission))
                        <li @if($controller == 'live-stream-ingest' && $method == '') class='active' @endif><a href="live-stream-ingest">Live Stream Ingest</a></li>
                        @endif
                        @if (in_array("Video Library", $permission))
                        <li  @if($controller == 'videos' && $method == '') class='active' @endif ><a href="{{ url('/') }}/videos">Video Library</a></li>
                        @endif
                        @if (in_array("Advertising", $permission))
                            <li  @if($controller == 'advertisement') class='active' @endif ><a href="{{ url('/') }}/advertisement">Advertising</a></li>
                        @endif
                    </ul>
                </li> 
                @endif
                <!-- <li>
                    <a href="switcher.html"><i class="fa fa-sliders"></i> <span class="nav-label">Switcher</span></a>
                </li> --> 
                @if (in_array("Video", $permission) || in_array("Photos", $permission))
                <li @if($controller == 'usc-video' || $controller == 'usc-photos') class='active' @endif >
                    <a href="#"><i class="fa fa-upload"></i> <span class="nav-label">User Submitted</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                    @if (in_array("Video", $permission))
                        <li @if($controller == 'usc-video') class='active' @endif ><a href="{{ url('/') }}/usc-video">Video</a></li>
                    @endif
                    @if (in_array("Photos", $permission))
                        <li @if($controller == 'usc-photos') class='active' @endif ><a href="{{ url('/') }}/usc-photos">Photos</a></li>
                    @endif
                    </ul>
                </li>             
                @endif
            @endif
        </ul>

    </div>
</nav>
