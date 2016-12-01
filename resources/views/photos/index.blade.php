<?php 
/**
 * User Controller
 *
 * @copyright  2016 SparkSupport
 * @author     Ajith
 * @date     08-11-16
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
?>
@extends('layouts.user')
@section('title', 'Main page')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-12">
                <h2>Photos</h2> 
                 <ol class="breadcrumb">
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>
                        <a>User Submitted</a>
                    </li>
                    <li class="active">
                        <strong>Photos</strong>
                    </li>
                </ol>                       
            </div>
        </div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">                                
                        <h5><i class="fa fa-list-alt"></i> Photo Listing</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-9"></div>
                            <div class="col-lg-3">
                            {!! Form::open(array('id' => 'filter', 'method' => 'get')) !!}
                                 <div class="form-group">    
                                    <div class="input-group">
                                      <input type="text" class="form-control" placeholder="Filter" name="filter">
                                      <div class="input-group-addon"><i class="fa fa-filter filter"></i></div>
                                    </div>
                                  </div>
                            {!! Form::close() !!}
                            </div>
                        </div>
                        <ul class="list-inline">
                            @foreach ($photos as $photo)
                            <?php $image = explode('/', $photo->url);
                            // open file a image resource
                            $img = Image::make(file_get_contents('public/user-photos/'.$image[7] ))->fit(295, 220);
                            $img->encode('png');
                            $type = 'png';
                            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($img);
                            ?>
                            <li>
                                <div class="thumbnail" >
                                    <img data-toggle="modal" data-target="#usc-photo-1" src="{!! $base64 !!}" width="295" height="220" alt="">
                                    <div>
                                    <small class="text-info">Date Submitted</small><br>
                                    <span class="text-muted">{{ $photo->created_at}}</span>
                                    </div>
                                    <div>
                                        <small class="text-info">Submitted By</small><br>
                                        <span class="text-muted">{{ $photo->user }}</span>
                                    </div>
                                    <div>
                                        <small class="text-info">Country Submitted From</small><br>
                                        <span class="text-muted">{{ $photo->country }}</span>
                                    </div>
                                    <div align="right">
                                        <div class="btn-group">
                                        <button class="btn btn-xs btn-primary btn-outline img-delete" type="button" value="{{ $photo->id }}">Delete</button>
                                        <button class="btn btn-xs btn-primary" type="button"><a class="download" href="{{ url('/') }}/public/user-photos/{{ $image[7] }}" download>Download</a></button>
                                    </div>
                                    </div>
                                </div>
                            </li>
                            <!-- START: Modal -->
                    <div class="modal inmodal" id="usc-photo-1" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                     <span class="pull-left"><strong>&nbsp;</strong></span>
                                </div>
                                <div class="modal-body no-padding">
                                    <img src="{{ url('/') }}/public/user-photos/{{ $image[7] }}" width="898" height="673" alt="" class="img-responsive">
                                    <div class="row">
                                    <div class="col-sm-12 padding-bottom-15">   
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td nowrap><strong class="text-info pull-right">Date Submitted:</strong></td>
                                                <td>{{ $photo->created_at }}</td>
                                            </tr>
                                            <tr>
                                                <td nowrap><strong class="text-info pull-right">Submitted By:</strong></td>
                                                <td>{{ $photo->user }}</td>
                                            </tr>
                                            <tr>
                                                <td nowrap><strong class="text-info pull-right">Country Submitted From:</strong></td>
                                                <td>{{ $photo->country }}</td>
                                            </tr>
                                            <tr>
                                                <td nowrap><strong class="text-info pull-right">Story:</strong></td>
                                                <td>
                                                    <p>{{ $photo->story }}</p>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                   </div>
                                </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="btn-group">
                                        <button class="btn btn-primary btn-outline img-delete" type="button" value="{{ $photo->id }}">Delete</button>
                                        <button class="btn btn-primary" type="button"><a class="download" href="{{ url('/') }}/public/user-photos/{{ $image[7] }}" download>Download</a></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!-- END: Modal -->                
                </ul>                                
                <input type="hidden" value="photo" name="link"></input>                  
                <nav class="text-center">
                  <ul class="pagination">
                    @include('pagination.default', ['paginator' => $photos])
                  </ul>
                </nav>
                </div>
            </div>
        </div>            
    </div>
</div>
@endsection
