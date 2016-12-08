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
<?php $count = count($video);?>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-12">
                <h2>Video Library</h2>
            </div>               
        </div>
        <div id="delete-lib" class="filter" ><i class="fa fa-trash-o" aria-hidden="true"></i></div>
        <div class="wrapper wrapper-content animated fadeInRight">

            <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">                                
                                <h5><i class="fa fa-list"></i> Videdo Listing</h5>
                            </div>
                            <div class="ibox-content">
                              <div class="row">
                                <div class="col-lg-6"><strong>Total no# of videos:</strong> {{$count}}</div>     
                                <div class="col-lg-6">
                                    <div class="pull-right">
                                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#add-video"><i class="fa fa-upload"></i> Upload Video(s)</button>
    <!-- START: Modal -->
    <div class="modal inmodal" id="add-video" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated fadeIn">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <span class="pull-left"><strong>Add: Video</strong> <!-- [First Name] [Last Name] --></span>
                </div>
                <div class="modal-body">
                {!! Form::open(array('url' => 'videos/create','files'=>true,'method' => 'post')) !!}                    
                    <div class="row">

                        <div id="filelist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
                        <br />

                        <div id="container">
                            {{ Form::label('Upload Video') }}<br>
                            <a id="pickfiles" href="javascript:;">[Select files]</a> 
                            <a id="uploadfiles" href="javascript:;">[Upload files]</a>
                        </div>

                        <br />
                        <pre style="display: none;" id="console">
                            <input id="uploaded" type="hidden" name="file_name" required>
                        </pre>
                        <!-- <div class="col-sm-6">
                        {{ Form::label('Upload Video') }}
                        {{ Form::file('video', null, array('class' => 'form-control', 'placeholder' => 'Upload Your Video')) }} 
                        </div> -->
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                        {{ Form::label('Title') }}
                        {{ Form::text('title', null, array('class' => 'form-control', 'placeholder' => 'Enter Title', 'required')) }} 
                        </div>
                        <div class="col-sm-6">
                        {{ Form::label('Meta Title') }}
                        {{ Form::text('meta_title', null, array('class' => 'form-control', 'placeholder' => 'Enter Meta Title')) }}                                     
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-sm-6">
                        {{ Form::label('Description') }}
                        {{ Form::textarea('description', null, array('class' => 'form-control', 'placeholder' => 'Enter Description', 'size' => '30x5')) }}
                        </div>
                        <div class="col-sm-6">
                        {{ Form::label('Full Description') }}
                        {{ Form::textarea('full_description', null, array('class' => 'form-control', 'placeholder' => 'Enter Full Description', 'size' => '30x5')) }}                                       
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-sm-6">
                        {{ Form::label('CopyRight') }}
                        {{ Form::text('copyright', null, array('class' => 'form-control', 'placeholder' => 'Enter Copy Right')) }}                                     
                        </div>
                        <div class="col-sm-6">
                        {{ Form::label('Author ') }}
                        {{ Form::text('author', null, array('class' => 'form-control', 'placeholder' => 'Enter Author Name')) }}
                    </div>
                </div> 
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="video-upload">Save</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!-- END: Modal -->
                                    </div>
                                </div>
                              </div>  
                       <hr class="hr-line-dashed" />
                         <!-- START: Table -->
                    {!! Form::open(array('url' => 'videos/deleteLib', 'id' => 'videolib'))!!}                    
                    <table class="table table-striped table-bordered table-hover dataTables" >
                    <thead>
                    <tr>
                      <th><input id="example-select-all" type="checkbox" /></th>
                        <th>Title</th>
                        <th>Duration</th>
                        <th>Upload Date</th>
                        <th>Uploaded by</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($video as $key => $detail)
                    <tr class="gradeX">
                      <td>{{ $detail['id'] }}</td>
                        <td>
                            <?php 
                            $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $detail['video']);
                            $img = explode('public', $withoutExt); ?>
                            <a href="{{ url('/') }}/video/detail/{{ $detail['id'] }}">
                                <img src="{{ url('/') }}/public{{$img[1]}}_130.jpg" alt="$video_detail['video']">&nbsp;
                            {{ $detail['detail'][0]['title'] }}
                            </a>
                        </td>
                        <td>{{ $detail['detail'][0]['duration'] }}</td>
                        <td>{{ date('d.m.Y', strtotime($detail['updated_at'])) }}</td>
                        <td>{{ $detail['user']['name'] }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                      <th></th>
                        <th>Title</th>
                        <th>Duration</th>
                        <th>Upload Date</th>
                        <th>Uploaded by</th>
                    </tr>
                    </tfoot>
                    </table>
                    {!! Form::close() !!}
                        
                        <!-- END: Table -->
                            </div>
                        </div>
                    </div>            
            </div>
@endsection