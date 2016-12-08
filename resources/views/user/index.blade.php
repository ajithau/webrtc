<?php 
/**
 * User Controller
 *
 * @copyright  2016 SparkSupport
 * @author     Ajith
 * @date 	   12-10-16
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
?>
@extends('layouts.home')
@section('title', 'Main page')

@section('content')
<?php
    $userid = Auth::User()->id;
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2></h2>                    
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">                                
                    <h5><i class="fa fa-list-alt"></i> User Details</h5>
					<div class="pull-right">
                		<!-- START: Modal -->
                        <div class="modal inmodal" id="add-user" tabindex="-1" role="dialog"  aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated fadeIn">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <span class="pull-left"><strong>Add:</strong> <!-- [First Name] [Last Name] --></span>
                                    </div>
                                    <div class="modal-body">
									{!! Form::open(array('url' => 'users/createAdmin')) !!}
	                                	<div class="row">
	                                		<div class="col-sm-6">
	                                		{{ Form::label('First Name') }}
	                                		{{ Form::text('first_name', '', array('class' => 'form-control', 'placeholder' => 'Enter First Name')) }} 
	                                		</div>
	                                		<div class="col-sm-6">
	                                		{{ Form::label('Last Name') }}
	                                		{{ Form::text('last_name', '', array('class' => 'form-control', 'placeholder' => 'Enter Last Name')) }}                                		
	                                		</div>
	                                	</div> 
	                                	<div class="row">
	                                		<div class="col-sm-6">
	                                		{{ Form::label('User Name') }}
	                                		{{ Form::text('name', '', array('class' => 'form-control', 'placeholder' => 'Enter User Name')) }}
	                                		</div>
	                                		<div class="col-sm-6">
	                                		{{ Form::label('Password') }}
	                                		{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Enter Password')) }}                                		</div>
	                                	</div> 
	                                	<div class="row">
	                                		<div class="col-sm-6">
	                                		{{ Form::label('Email Address') }}
	                                		{{ Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'Enter Email Address')) }}                                		
	                                		</div>
	                                		<div class="col-sm-6">
	                                		{{ Form::label('Mobile Number') }}
	                                		{{ Form::text('mobile', '', array('class' => 'form-control', 'placeholder' => 'Enter Mobile Number')) }}
	                                	</div>
                                	</div> 
                                </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                            		{!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                        <!-- END: Modal -->
					</div>
            	</div>
                <div class="ibox-content no-padding">
                    
                <table class="table table-hover table-bordered table-responsive">
                    <thead>
                    <tr>                                    
                        <th>Role</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Access</th>
                        <th>Notifications</th>
                        <th>Created</th>
                        <th>Last Modified</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <input type="hidden" id="user" value="{{ $user->id }}"></input>
						<td class="" id="">
                            @if($user->role == 2) {{"Super Admin"}} 
                            @elseif($user->role == 3) {{"Admin"}}
                            @elseif($user->role == 4) {{"Content Editor"}}
                            @endif
                        </td>
						<td @if($userid == $user->id) class="inline_edit" id="first_name" @endif>{{ $user->first_name }}</td>
						<td @if($userid == $user->id) class="inline_edit" id="last_name" @endif>{{ $user->last_name }}</td>
						<td @if($userid == $user->id) class="inline_edit" id="name" @endif>{{ $user->name }}</td>
						<td @if($userid == $user->id) class="inline_edit" id="password" @endif>******</td>
						<td @if($userid == $user->id) class="inline_edit" id="email" @endif>{{ $user->email }}</td>
						<td @if($userid == $user->id) class="inline_edit" id="mobile" @endif>{{ $user->mobile }}</td>
						<td> </td>
						<td><?php $notify = unserialize($user->notification);
                        if(is_array($notify)) {
                            foreach ($notify as $notification) {
                                echo $notification.'</br>';
                        } } ?>
                        </td>
						<td>{{ date( 'd/m/Y', strtotime( $user->created_at ) ) }}</td>
						<td>{{ date( 'd/m/Y', strtotime( $user->updated_at ) ) }}</td>
   					</tr>
					@endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>            
	</div>
</div>
@endsection
