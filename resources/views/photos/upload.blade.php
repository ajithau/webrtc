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
{!! Form::open(array('url' => 'photos/upload','files'=>true,'method' => 'post')) !!}                    
    <!-- START: Modal -->
    <div class="inmodal" id="add-video" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated fadeIn">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span class="sr-only">Close</span></button>
                    <span class="pull-left"><strong>Add: Photo</strong> <!-- [First Name] [Last Name] --></span>
                </div>
                <div class="modal-body">
                    <div class="row" style="height: 200px">
                        <div id="container">
						    <div class="col-sm-8" >
						        <input id="input-4" name="video_input4[]" type="file" class="file-loading input-4">
						    </div>
                        </div>
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
                    <button type="submit" class="btn btn-primary" id="video-upload">Save</button>
                </div>
            </div>
        </div>
{!! Form::close() !!}
@endsection
