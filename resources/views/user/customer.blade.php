<?php 
/**
 * User Controller
 *
 * @copyright  2016 SparkSupport
 * @author     Ajith
 * @date 	   13-10-16
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
?>
@extends('layouts.home')
@section('title', 'Main page')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>User Management</h2>                    
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
                        <!-- START: Add Customer Modal -->
                           <div class="modal inmodal" id="add-user" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content animated fadeIn">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <span class="pull-left"><strong>Add:</strong></span>
                                        </div>
                                        <div class="modal-body no-padding">
                                           <div class="panel-group accordion-panel-colour padding-top-10" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Company Details
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        {!! Form::open(array('url' => 'users/createCustomer')) !!}
            <div class="form-group"><label>Company Name</label> 
                {{ Form::label('Company Name') }}
                {{ Form::text('company_name', '', array('class' => 'form-control', 'placeholder' => 'Enter Company Name')) }} 
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group"><label>Address</label> <input type="text" placeholder="Enter Address" class="form-control"></div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group"><label>Address</label> <input type="text" placeholder="Enter Address" class="form-control"></div>
                </div>
            </div>
            <div class="form-group"><label>Country</label> 
            <select class="selectpicker" data-live-search="true" id="countries">
            @foreach ($data['country'] as $countries)
                <option value="{{ $countries->countryName }}">{{ $countries->countryName }}</option>
            @endforeach
            </select>

            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group"><label>City</label> <input type="text" placeholder="Enter City" class="form-control"></div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group"><label>Zip/Postal Code</label> <input type="text" placeholder="Enter Zip/Postal Code" class="form-control"></div>
                </div>
            </div>
             <div class="row">
                <div class="col-sm-6">
                    <div class="form-group"><label>Telephone</label> <input type="tel" placeholder="Enter Telephone" class="form-control"></div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group"><label>Mobile Number</label> <input type="tel" placeholder="Enter Mobile Number" class="form-control"></div>
                </div>
            </div>
             <div class="row">
                <div class="col-sm-6">
                    <div class="form-group"><label>Fax</label> <input type="tel" placeholder="Enter Fax" class="form-control"></div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group"><label>Website URL</label> <input type="url" placeholder="Enter Website URL" class="form-control"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group"><label>Email</label> <input type="email" placeholder="Enter Email" class="form-control"></div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group"><label>Twitter Handle</label> <input type="text" placeholder="Enter Twitter Handle" class="form-control"></div>
                </div>
            </div>
            <hr class="hr-line-dashed"> 
            <div class="pull-right">
                <!-- <button type="button" class="btn btn-primary">Save</button> -->
            </div>
        <!-- </form> -->
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          User Management
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
        <!-- <form role="form">                                     -->
            <div class="form-group"><label>Role</label> 
            <select name="" id="" class="form-control">
                <option value="">Select Role</option>
                <option value="">Super Admin</option>
                <option value="">Admin</option>
            </select>
            </div>
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
                    {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Enter Password')) }}                                       </div>
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
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group"><label>Access</label> 
                    <select name="" id="access" class="form-control selectpicker" multiple title="Please select">
                        <option value="User Management">User Management</option>
                        <option value="Video Library">Video Library</option>
                        <option value="Advertising">Advertising</option>
                        <option value="Switcher">Switcher</option>
                        <optgroup label="User Submitted">
                        <option value="Video">Video</option>
                        <option value="Photos">Photos</option>
                      </optgroup>
                    </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group"><label>Notifications</label> 
                    <select name="" id="notifications" class="form-control selectpicker" multiple title="Please select">
                        <option value="email">Email</option>
                        <option value="sms">SMS</option>
                    </select>
                    </div>
                </div>
            </div>
            <div class="pull-right">
                <div class="btn-group">
                <button class="btn btn-xs btn-primary btn-outline" type="button">Add Another User</button>
                <!-- <button class="btn btn-xs btn-primary" type="button">Save</button> -->
            </div>
            </div>          
        <!-- </form>      -->
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Time Zone
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
        <div class="form-group"><label>&nbsp;</label> 
            <select name="" id="time-zone" class="form-control selectpicker" data-live-search="true" title="Please select">
                <option value="">(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz</option>
                <option value="">Other</option>
            </select>
            </div>
            <hr class="hr-line-dashed"> 
            <div class="pull-right">
                <!-- <button type="button" class="btn btn-primary">Save</button> -->
        </div>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingFour">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          Product Details
        </a>
      </h4>
    </div>
    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
      <div class="panel-body">
        <!-- <form role="form"> -->
                               
            <div class="form-group"><label>Video:</label>&nbsp;                                   
               <div class="radio radio-green radio-inline">
                    <input type="radio" id="video-yes" value="option1" name="video">
                    <label for="video-yes"> Yes </label>
                </div>
                <div class="radio radio-green radio-inline">
                    <input type="radio" id="video-no" value="option2" name="video">
                    <label for="video-no"> No </label>
                </div>
            </div>
            <hr class="hr-line-dashed">
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group"><label>Station Name</label> <input type="text" placeholder="Enter Station Name" class="form-control"></div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group"><label>Stream Name/Instance</label> <input type="text" placeholder="Enter Stream Name/Instance" class="form-control"></div>
                </div>
                <div class="col-sm-3">
                    <label class="control-label">Select Logo</label>
<input id="input-4" name="input4[]" type="file" multiple class="file-loading">
                </div>
                <div class="col-sm-3">                                      
                    <div class="btn-group btn-position">
                        <button class="btn btn-primary" type="button"><i class="fa fa-plus"></i></button>
                        <button class="btn btn-primary" type="button"><i class="fa fa-minus"></i></button>
                    </div>
                </div>                                      
            </div>                                              
            <hr class="hr-line-dashed">
            <div class="form-group"><label>Radio:</label>&nbsp;                                   
               <div class="radio radio-green radio-inline">
                    <input type="radio" id="radio-yes" value="option1" name="radio">
                    <label for="radio-yes"> Yes </label>
                </div>
                <div class="radio radio-green radio-inline">
                    <input type="radio" id="radio-no" value="option2" name="radio">
                    <label for="radio-no"> No </label>
                </div>
            </div>  
            <hr class="hr-line-dashed">
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group"><label>Station Name</label> <input type="text" placeholder="Enter Station Name" class="form-control"></div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group"><label>Stream Name/Instance</label> <input type="text" placeholder="Enter Stream Name/Instance" class="form-control"></div>
                </div>
                <div class="col-sm-3">
                    <label class="control-label">Select Logo</label>
<input id="input-5" name="input5[]" type="file" multiple class="file-loading">
                </div>
                <div class="col-sm-3">                                      
                    <div class="btn-group btn-position">
                        <button class="btn btn-primary" type="button"><i class="fa fa-plus"></i></button>
                        <button class="btn btn-primary" type="button"><i class="fa fa-minus"></i></button>
                    </div>
                </div>                                      
            </div>
            <hr class="hr-line-dashed"> 
            <div class="pull-right">
                <!-- <button type="button" class="btn btn-primary">Save</button> -->
            </div>
          <!-- </form> -->
      </div>
    </div>
  </div>
</div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">close</button>
                                            <button type="submit" class="btn btn-primary">save</button>
                                        {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                           <!-- END: Add Customer Modal -->
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
                    @foreach ($data['users'] as $user)
                    <tr>
						<td>{{ $user->name }}</td>
						<td>{{ $user->name }}</td>
						<td>{{ $user->first_name }}</td>
						<td>{{ $user->last_name }}</td>
						<td>******</td>
						<td>{{ $user->email }}</td>
						<td>{{ $user->mobile }}</td>
						<td> </td>
						<td>{{ $user->notification }}</td>
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
