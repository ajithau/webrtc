<?php 
/**
 * User Controller
 *
 * @copyright  2016 SparkSupport
 * @author     Ajith
 * @date       14-10-16
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
?>
@extends('layouts.video')
@section('title', 'Main page')

@section('content')
    <!-- START: Modal -->
    <div class="inmodal" id="add-video" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated fadeIn">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <span class="pull-left"><strong>Add: Video</strong> <!-- [First Name] [Last Name] --></span>
                </div>
                <div class="modal-body">
                {!! Form::open(array('url' => 'videos/userUpload','files'=>true,'method' => 'post')) !!}                    
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
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                        {{ Form::label('Title') }}
                        {{ Form::text('title', null, array('class' => 'form-control', 'placeholder' => 'Enter Title', 'required')) }} 
                        </div>
                        <div class="col-sm-6">
                        {{ Form::label('User') }}
                        {{ Form::text('user', null, array('class' => 'form-control', 'placeholder' => 'Enter User name')) }}                                     
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-sm-6">
                        {{ Form::label('Country') }}
                        {{ Form::text('country', null, array('class' => 'form-control', 'placeholder' => 'Enter Country')) }}
                        </div>
                        <div class="col-sm-6">
                        {{ Form::label('Story') }}
                        {{ Form::textarea('story', null, array('class' => 'form-control', 'placeholder' => 'Enter Full Description', 'size' => '30x5')) }}                                       
                        </div>
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
@endsection
