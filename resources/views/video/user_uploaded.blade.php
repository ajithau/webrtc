<?php 
/**
 * User Controller
 *
 * @copyright  2016 SparkSupport
 * @author     Ajith
 * @date 	   14-10-16
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
?>
@extends('layouts.video')
@section('title', 'Main page')

@section('content')
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-12">
                <h2>Videos</h2> 
                 <ol class="breadcrumb">
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>
                        <a>User Submitted</a>
                    </li>
                    <li class="active">
                        <strong>Videos</strong>
                    </li>
                </ol>                       
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">                                
                                <h5><i class="fa fa-list-alt"></i> Video Listing</h5>
                            </div>
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-lg-9"></div>
                                    <div class="col-lg-3">
                                         <div class="form-group">    
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Filter">
      <div class="input-group-addon"><i class="fa fa-filter"></i></div>
    </div>
  </div>
                                    </div>
                                </div>
                            <ul class="list-inline">
                                    <li>
                                        <a href="#" class="thumbnail" data-toggle="modal" data-target="#usc-video-1">
                                            <img src="http://placehold.it/295x220" alt="">
                                            <div>
                                            <small class="text-info">Date Submitted</small><br>
                                            <span class="text-muted">12/12/2016</span>
                                            </div>
                                            <div>
                                                <small class="text-info">Submitted By</small><br>
                                                <span class="text-muted">John Doe</span>
                                            </div>
                                            <div>
                                                <small class="text-info">Country Submitted From</small><br>
                                                <span class="text-muted">Trinidad & Tobago</span>
                                            </div>
                                            <div align="right">
                                                <div class="btn-group">
                                <button class="btn btn-xs btn-primary btn-outline" type="button">Delete</button>
                                <button class="btn btn-xs btn-primary" type="button">Download</button>
                            </div>

                                            </div>

                                        </a>
                                    </li>
                                    <!-- START: Modal -->
                                        <div class="modal inmodal" id="usc-video-1" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content animated fadeIn">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                             <span class="pull-left"><strong>&nbsp;</strong></span>
                                        </div>
                                        <div class="modal-body no-padding">
                                             <figure>
                                <iframe width="100%" height="500" src="http://www.youtube.com/embed/bwj2s_5e12U" frameborder="0" allowfullscreen></iframe>
                            </figure> 
<div class="row">
                                            <div class="col-sm-12 padding-bottom-15">                                               
                                         <table class="table">
                            <tbody>
                            <tr>
                                <td nowrap><strong class="text-info pull-right">Date Submitted:</strong></td>
                                <td>12/12/2016</td>
                            </tr>
                            <tr>
                                <td nowrap><strong class="text-info pull-right">Submitted By:</strong></td>
                                <td>John Doe</td>
                            </tr>
                            <tr>
                                <td nowrap><strong class="text-info pull-right">Country Submitted From:</strong></td>
                                <td>Trinidad & Tobago</td>
                            </tr>
                            <tr>
                                <td nowrap><strong class="text-info pull-right">Story:</strong></td>
                                <td>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec at ornare mi. Aliquam efficitur dolor non lacus rhoncus, in convallis felis feugiat. Pellentesque a nunc vitae nisl eleifend rutrum. Mauris tincidunt lectus nec lectus sollicitudin vestibulum. Mauris ullamcorper purus quis odio iaculis, sit amet mollis mauris condimentum. Ut mattis fermentum nunc egestas faucibus. In suscipit leo nec orci egestas, in efficitur elit molestie. Proin sed sapien a quam pretium interdum ac id ante. Mauris sodales interdum lorem, at euismod massa ornare sed.
                                    </p>

<p>
    Vestibulum viverra ligula vel nisl semper, eu pharetra quam placerat. Mauris a mi quis nulla tincidunt tempus. Nam quis ligula quis urna ullamcorper tincidunt. Suspendisse feugiat interdum leo, eget porttitor urna placerat non. Sed dignissim ligula at enim rutrum pharetra. Quisque pretium euismod ipsum vel porttitor. Praesent nisl velit, sodales in sollicitudin quis, fermentum eu lectus. Duis pulvinar velit ut ultricies cursus. Etiam at nisi dui. Praesent eu hendrerit augue.
</p>

<p>
    Vestibulum tincidunt suscipit ex vel pretium. Donec luctus nunc quis ullamcorper lacinia. Nulla rutrum sodales molestie. Ut malesuada diam nec tortor finibus maximus. Ut in egestas massa, iaculis sagittis nunc. Proin quis magna a ligula condimentum ullamcorper id id enim. In faucibus elit eget pretium porta. Nullam orci nunc, gravida quis consequat molestie, fringilla maximus nunc. Integer vulputate velit nec elit auctor facilisis. Mauris at sem interdum, dignissim diam vel, efficitur ligula. Integer vitae odio eget tortor convallis posuere. Integer massa mi, accumsan sit amet lorem nec, tempor semper turpis.
</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                                            
                                           </div>
                                        </div>
                                        </div>
                                        <div class="modal-footer">
                                           <div class="btn-group">
                                <button class="btn btn-primary btn-outline" type="button">Delete</button>
                                <button class="btn btn-primary" type="button">Download</button>
                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                                        <!-- END: Modal -->               
                                </ul>                                
<nav class="text-center">
  <ul class="pagination">
    <li>
      <a href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li>
      <a href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
                                                   </div>
                        </div>
                       
                    </div>            
            </div>
           
      
@endsection