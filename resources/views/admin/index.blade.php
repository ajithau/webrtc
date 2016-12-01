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
@extends('layouts.admin')
@section('title', 'Main page')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Admin Users</h2>                    
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">                                
                    <h5><i class="fa fa-list-alt"></i> User Details</h5>
					<div class="pull-right">
	                	<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#add-user">Add User</button>
                		<!-- START: Modal -->
                        <div class="modal inmodal" id="add-user" tabindex="-1" role="dialog"  aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated fadeIn">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <span class="pull-left"><strong>Add: Admin User</strong> <!-- [First Name] [Last Name] --></span>
                                    </div>
                                    <div class="modal-body">
									{!! Form::open(array('url' => 'users/createAdmin', 'class'=> 'admin-user')) !!}
	                                	<div class="row">
	                                		<div class="col-sm-6">
	                                		{{ Form::label('First Name') }}
	                                		{{ Form::text('first_name', '', array('class' => 'form-control', 'placeholder' => 'Enter First Name', 'required')) }} 
	                                		</div>
	                                		<div class="col-sm-6">
	                                		{{ Form::label('Last Name') }}
	                                		{{ Form::text('last_name', '', array('class' => 'form-control', 'placeholder' => 'Enter Last Name', 'required')) }}                                		
	                                		</div>
	                                	</div> 
	                                	<div class="row">
	                                		<div class="col-sm-6">
	                                		{{ Form::label('User Name') }}
	                                		{{ Form::text('name', '', array('class' => 'form-control', 'placeholder' => 'Enter User Name', 'required')) }}
	                                		</div>
	                                		<div class="col-sm-6">
	                                		{{ Form::label('Password') }}
	                                		{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Enter Password', 'required')) }}                                		</div>
	                                	</div> 
	                                	<div class="row">
	                                		<div class="col-sm-6">
	                                		{{ Form::label('Email Address') }}
	                                		{{ Form::text('email', '', array('class' => 'form-control', 'type' => 'email', 'placeholder' => 'Enter Email Address', 'required')) }}                                		
	                                		</div>
	                                		<div class="col-sm-6">
	                                		{{ Form::label('Mobile Number') }}
	                                		{{ Form::text('mobile', '', array('class' => 'form-control', 'placeholder' => 'Enter Mobile Number', 'required')) }}
	                                	</div>
                                	</div> 
                                </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <!-- END: Modal -->
					</div>
            	</div>
                <div class="ibox-content no-padding">
                    
                <table class="table table-hover table-bordered table-responsive">
                    <thead>
                    <tr>                                    
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Email Address</th>
                        <th>Mobile Number</th>
                        <th>Created</th>
                        <th>Last Modified</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <input type="hidden" id="user" value="{{ $user->user_id }}"></input>
                        <td class="inline_edit" id="first_name">{{ $user->first_name }}</td>
                        <td class="inline_edit" id="last_name">{{ $user->last_name }}</td>
						<td class="inline_edit" id="name">{{ $user->name }}</td>
						<td class="inline_edit" id="password">******</td>
						<td class="inline_edit" id="email">{{ $user->email }}</td>
						<td class="inline_edit" id="mobile">{{ $user->mobile }}</td>
						<td class="" id="create">{{ date( 'd/m/Y', strtotime( $user->created_at ) ) }}</td>
						<td class="" id="update">{{ date( 'd/m/Y', strtotime( $user->updated_at ) ) }}</td>
                        <td>
                            <div class="text-center">
                                <button class="btn btn-xs btn-primary"  data-toggle="modal" data-target="#edit-user{{ $user->name }}"  type="button"><i class="fa fa-pencil"></i></button>
                            </div>
                        </td>
                        <td>
                            <div class="text-center">
                                <button class="btn btn-xs btn-primary deleteUser" type="button" value="{{ $user->user_id }}"><i class="fa fa-times"></i></button>
                            </div>
                        </td>					
                    </tr>
					@endforeach
                    </tbody>
                </table>
                </div>
                    @foreach ($users as $user)
                        <!-- START: Modal -->
                        <div class="modal inmodal" id="edit-user{{ $user->name }}" tabindex="-1" role="dialog"  aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated fadeIn">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <span class="pull-left"><strong>Edit: {{ $user->name }}</strong> <!-- [First Name] [Last Name] --></span>
                                    </div>
                                    <div class="modal-body">
                                    {!! Form::open(array('url' => 'users/updateAdmin')) !!}
                                        <input type="hidden" name="user_id" value="{{ $user->user_id }}">
                                        <div class="row">
                                            <div class="col-sm-6">
                                            {{ Form::label('First Name') }}
                                            {{ Form::text('first_name', $user->first_name, array('class' => 'form-control', 'required')) }} 
                                            </div>
                                            <div class="col-sm-6">
                                            {{ Form::label('Last Name') }}
                                            {{ Form::text('last_name', $user->last_name, array('class' => 'form-control', 'placeholder' => 'Enter Last Name')) }}                                     
                                            </div>
                                        </div> 
                                        <div class="row">
                                            <div class="col-sm-6">
                                            {{ Form::label('User Name') }}
                                            {{ Form::text('name', $user->name, array('class' => 'form-control', 'placeholder' => 'Enter User Name')) }}
                                            </div>
                                            <div class="col-sm-6">
                                            {{ Form::label('Password') }}
                                            {{ Form::password('password', array('class' => 'form-control', 'placeholder' => '******')) }}                                       </div>
                                        </div> 
                                        <div class="row">
                                            <div class="col-sm-6">
                                            {{ Form::label('Email Address') }}
                                            {{ Form::text('email', $user->email, array('class' => 'form-control', 'placeholder' => 'Enter Email Address')) }}                                     
                                            </div>
                                            <div class="col-sm-6">
                                            {{ Form::label('Mobile Number') }}
                                            {{ Form::text('mobile',  $user->mobile, array('class' => 'form-control', 'placeholder' => 'Enter Mobile Number')) }}
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
					@endforeach
                <nav class="text-center">
                  <ul class="pagination">
                    @include('pagination.default', ['paginator' => $users])
                  </ul>
                </nav>
            </div>
        </div>            
	</div>
</div>
@endsection
