<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">{{ Auth::user()->name}}</strong>
                            </span> <span class="text-muted text-xs block">Example menu <b class="caret"></b></span>
                        </span>
                    </a>
<!--                     <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="#">Logout</a></li>
                    </ul> -->
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li>
                <a href="user-management.html"><i class="fa fa-male"></i> <span class="nav-label">User Management</span></a>
            </li> 
            <li>
                <a href="#"><i class="fa fa-desktop"></i> <span class="nav-label">Streaming Video</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="live-stream-ingest-video.html">Live Stream Ingest</a></li>
                    <li><a href="video-library.html">Video Library</a></li>
                    <li><a href="advertising.html">Advertising</a></li>
                </ul>
            </li> 
            <li>
                <a href="switcher.html"><i class="fa fa-sliders"></i> <span class="nav-label">Switcher</span></a>
            </li> 
            <li>
                <a href="#"><i class="fa fa-upload"></i> <span class="nav-label">User Submitted</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="usc-video.html">Video</a></li>
                    <li><a href="usc-photos.html">Photos</a></li>
                </ul>
            </li>             
        </ul>

    </div>
</nav>
