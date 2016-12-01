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
@extends('layouts.admin')
@section('title', 'Main page')

@section('content')
<?php
    // echo "<pre>";
    // print_r($data); die;
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Customers</h2>                    
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight"  ng-app="">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">                                
                    <h5><i class="fa fa-list-alt"></i> User Details</h5>
					<div class="pull-right">
	                	<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#add-user">Add Customer</button>
                		<!-- START: Modal -->
                        <!-- START: Add Customer Modal -->
                           <div class="modal inmodal" id="add-user" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content animated fadeIn">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <span class="pull-left"><strong>Add: @{{ name }}</strong></span>
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
        {!! Form::open(array('url' => 'users/createCustomer', 'class'=> 'user')) !!}
            <div class="form-group">
                {{ Form::label('Company Name') }}
                {{ Form::text('company_name', '', array('class' => 'form-control', 'placeholder' => 'Enter Company Name', 'ng-model' => 'name', 'required')) }} 
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                    {{ Form::label('Address') }}
                    {{ Form::text('address', '', array('class' => 'form-control', 'placeholder' => 'Enter Address', 'required')) }} 
                </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                    {{ Form::label('Address') }}
                    {{ Form::text('address1', '', array('class' => 'form-control', 'placeholder' => 'Enter Address')) }} 
                </div>
                </div>
            </div>
            <div class="form-group"><label>Country</label> 
            <select name="country" class="selectpicker countries" data-live-search="true" id="countries" 'required'>
                <option value=""></option>
            @foreach ($data['country'] as $countries)
                <option value="{{ $countries->countryName }}">{{ $countries->countryName }}</option>
            @endforeach
            </select>

            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                    {{ Form::label('City') }}
                    {{ Form::text('city', '', array('class' => 'form-control', 'placeholder' => 'Enter City', 'required')) }} 
                </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                    {{ Form::label('Zip/Postal Code') }}
                    {{ Form::text('zipcode', '', array('class' => 'form-control', 'placeholder' => 'Enter Zip/Postal Code')) }} 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                    {{ Form::label('Telephone') }}
                    {{ Form::text('phone', '', array('class' => 'form-control', 'placeholder' => 'Enter Telephone', 'required')) }} 
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                    {{ Form::label('Mobile Number') }}
                    {{ Form::text('mobile', '', array('class' => 'form-control', 'placeholder' => 'Enter Mobile Number' )) }} 
                    </div>
                </div>
            </div>
             <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                    {{ Form::label('Fax') }}
                    {{ Form::text('fax', '', array('class' => 'form-control', 'placeholder' => 'Enter Fax')) }} 
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                    {{ Form::label('Website URL') }}
                    {{ Form::text('website', '', array('class' => 'form-control', 'placeholder' => 'Enter Website URL', 'required')) }} 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                    {{ Form::label('Email') }}
                    {{ Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'Enter Email', 'required')) }} 
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                    {{ Form::label('Twitter Handle') }}
                    {{ Form::text('twitter', '', array('class' => 'form-control', 'placeholder' => 'Enter Twitter Handle')) }} 
                    </div>
                </div>
            </div>
            <hr class="hr-line-dashed"> 
            <div class="pull-right">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="button" id="add-company" class="btn btn-primary">Save</button>
            </div>
            {!! Form::close() !!}
        <!-- </form> -->
      </div>
    </div>
  </div>
  <div class="panel panel-default" id="multi-user">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          User Management
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body" id="new-user">
        <!-- <form role="form"> -->
        {!! Form::open(array('url' => '', 'class'=> 'user')) !!}
            <input type="hidden" name="company_id" class="company_id">
            <div class="form-group"><label>Role</label> 
            <select name="user_type" id="" class="form-control">
                <option value="">Select Role</option>
                <option value="2">Super Admin</option>
                <option value="3">Admin</option>
                <option value="4">Content Editor</option>
            </select>
            </div>
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
                    {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Enter Password', 'required')) }}                                       </div>
                </div> 
                <div class="row">
                    <div class="col-sm-6">
                    {{ Form::label('Email Address') }}
                    {{ Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'Enter Email Address', 'required')) }}                                     
                    </div>
                    <div class="col-sm-6">
                    {{ Form::label('Mobile Number') }}
                    {{ Form::text('mobile', '', array('class' => 'form-control', 'placeholder' => 'Enter Mobile Number', 'required')) }}
                    </div>
                </div>
            <div class="row" id="selects">
                <div class="col-sm-6">
                    <div class="form-group"><label>Access</label> 
                    <select name="access" id="access" class="form-control selectpicker access" multiple title="Please select">
                        <option value="User Management">User Management</option>
                        <option value="Video Library">Video Library</option>
                        <option value="Advertising">Advertising</option>
                        <option value="Switcher">Switcher</option>
                        <option value="Live Streaming">Live Streaming</option>
                        <optgroup label="User Submitted">
                        <option value="Video">Video</option>
                        <option value="Photos">Photos</option>
                      </optgroup>
                    </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group"><label>Notifications</label> 
                    <select name="notifications" id="notifications" class="form-control selectpicker notifications" multiple title="Please select">
                        <option value="email">Email</option>
                        <option value="sms">SMS</option>
                    </select>
                    </div>
                </div>
            </div>
            <div class="pull-right">
                <div class="btn-group">
                <button class="btn btn-xs btn-primary btn-outline" type="button" id="extra-user">Add Another User</button>
                <button class="btn btn-xs btn-primary usr-btn" value="" type="button">Save</button>
            </div>
            </div>          
            {!! Form::close() !!}

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
        {!! Form::open(array('url' => '', 'class'=> 'user')) !!}
        <div class="form-group"><label>&nbsp;</label> 
        <select name="" id="time-zone" class="form-control selectpicker time-zone" data-live-search="true" title="Please select">
            <?php $timezones = generate_timezone_list(); ?>
            @foreach($timezones as $timezone)
            <option value="{{$timezone}}">{{$timezone}}</option>
            @endforeach
            <option value="">Other</option>
        </select>
        </div>
        <hr class="hr-line-dashed"> 
        <div class="pull-right">
            <button type="button" class="btn btn-primary timezone" id="timezone">Save</button>
            <input type="hidden" name="company_id" class="company_id">
        </div>
        {!! Form::close() !!}
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
        {!! Form::open(array('url' => '', 'class' => 'product user', 'files'=>true)) !!}
                               
            <div class="form-group"><label>Video:</label>&nbsp;
               <div class="radio radio-green radio-inline">
                    <input type="radio" id="video-yes" value="0" name="video">
                    <label for="video-yes"> Yes </label>
                </div>
                <div class="radio radio-green radio-inline">
                    <input type="radio" id="video-no" value="1" name="video">
                    <label for="video-no"> No </label>
                </div>
            </div>
            <hr class="hr-line-dashed">
            <div class="video-station" style="display: none">
                <div class="row" id="video-station">
                    <div class="col-sm-3">
                        <div class="form-group"><label>Station Name</label> <input type="text" placeholder="Enter Station Name" class="form-control" name="video_station_name[]"></div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group"><label>Stream Name/Instance</label> <input type="text" placeholder="Enter Stream Name/Instance" class="form-control" name="video_station_stream[]"></div>
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label">Select Logo</label>
                        <input id="input-4" name="video_input4[]" type="file" class="file-loading input-4">
                    </div>
                    <div class="col-sm-2">                                      
                        <div class="btn-group btn-position">
                            <button class="btn btn-primary video-station" type="button"><i class="fa fa-plus"></i></button>
                            <button class="btn btn-primary minus" type="button"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>                                      
                </div>                                             
                <hr class="hr-line-dashed">
            </div>                                             
            <div class="form-group"><label>Radio:</label>&nbsp;
               <div class="radio radio-green radio-inline">
                    <input type="radio" id="radio-yes" value="0" name="radio">
                    <label for="radio-yes"> Yes </label>
                </div>
                <div class="radio radio-green radio-inline">
                    <input type="radio" id="radio-no" value="1" name="radio">
                    <label for="radio-no"> No </label>
                </div>
            </div>  
            <hr class="hr-line-dashed">
            <div class="audio-station" style="display: none">
                <div class="row" id="audio-station">
                    <div class="col-sm-3">
                        <div class="form-group"><label>Station Name</label> <input type="text" placeholder="Enter Station Name" class="form-control" name="radio_station_name[]"></div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group"><label>Stream Name/Instance</label> <input type="text" placeholder="Enter Stream Name/Instance" class="form-control" name="radio_station_stream[]"></div>
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label">Select Logo</label>
                        <input id="input-5" name="radio_input5[]" type="file" class="file-loading input-5">
                    </div>
                    <div class="col-sm-2">                                      
                        <div class="btn-group btn-position">
                            <button class="btn btn-primary audio-station" type="button"><i class="fa fa-plus"></i></button>
                            <button class="btn btn-primary minus" type="button"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>                                      
                </div>
                <hr class="hr-line-dashed"> 
            </div>
            <div class="pull-right">
                <button type="submit" class="btn btn-primary save-station">Save</button>
                <input type="hidden" name="company_id" class="company_id">
            </div>
          {!! Form::close() !!}
          <!-- </form> -->
      </div>
    </div>
  </div>
</div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">close</button>
                                            <!-- <button type="submit" class="btn btn-primary">save</button> -->
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
                        <th>Customer ID</th>
                        <th>API Key</th>
                        <th>Company Name</th>
                        <th>Country</th>
                        <th>Created</th>
                        <th>Last Modified</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data['companies'] as $key => $companies)
                    <tr>
						<td>{{ $companies->id }}</td>
						<td>{{ $companies->api_key }}</td>
						<td>{{ $companies->company_name }}</td>
						<td>{{ $companies->country }}</td>
						<td>{{ date( 'd/m/Y', strtotime( $companies->created_at ) ) }}</td>
						<td>{{ date( 'd/m/Y', strtotime( $companies->updated_at ) ) }}</td>
                        <td>
                            <div class="text-center">
                                <button class="btn btn-xs btn-primary" type="button"  data-target="#edit-company{{ $companies->id }}"  data-toggle="modal"><i class="fa fa-pencil"></i></button>
                            </div>
                        </td>
                        <td>
                            <div class="text-center">
                                <button class="btn btn-xs btn-primary deleteCompany" type="button" value="{{ $companies->id }}"><i class="fa fa-times" ></i></button>
                            </div>
                        </td>   
					</tr>
					@endforeach
                    </tbody>
                </table>

<!-- Edit user details -->
<!-- START: Modal -->
    <!-- START: Add Customer Modal -->
       @foreach ($data['companies'] as $key => $companies)
       <div class="modal inmodal" id="edit-company{{ $companies->id }}" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content animated fadeIn">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <span class="pull-left" ng-init="companyname='{{ $companies->company_name }}'"><strong>Edit: @{{companyname}}</strong></span>
                    </div>
                    <div class="modal-body no-padding">
                       <div class="panel-group accordion-panel-colour padding-top-10" id="accordion{{ $companies->id }}" role="tablist" aria-multiselectable="true">
                          <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                              <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion{{ $companies->id }}" href="#collapseOne{{ $companies->id }}" aria-expanded="true" aria-controls="collapseOne{{ $companies->id }}">
                                  Company Details
                                </a>
                              </h4>
                            </div>
                            <input type="hidden" value="{{ $companies->id }}" name="company_id"></input>
                            <div id="collapseOne{{ $companies->id }}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                              <div class="panel-body">
                                {!! Form::open(array('url' => 'users/createCustomer')) !!}
                                    <input type="hidden" name="company_id" value="{{ $companies->id }}">
                                    <div class="form-group"><label>Company Name</label> 
                                        {{ Form::label('Company Name') }}
                                        {{ Form::text('company_name', $companies->company_name, array('class' => 'form-control', 'placeholder' => 'Enter Company Name', 'ng-model' => 'companyname')) }} 
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                            {{ Form::label('Address') }}
                                            {{ Form::text('address', $companies->address, array('class' => 'form-control', 'placeholder' => 'Enter Address')) }} 
                                        </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                            {{ Form::label('Address') }}
                                            {{ Form::text('address1', $companies->address1, array('class' => 'form-control', 'placeholder' => 'Enter Address')) }} 
                                        </div>
                                        </div>
                                    </div>
                                    <div class="form-group"><label>Country</label> 
                                    <select name="country" class="selectpicker countries" data-live-search="true" id="countries">
                                    @foreach ($data['country'] as $countries)
                                        <option value="{{ $countries->countryName }}" @if($companies->country == $countries->countryName){ {{"selected"}} } @endif >{{ $countries->countryName }}</option>
                                    @endforeach
                                    </select>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                            {{ Form::label('City') }}
                                            {{ Form::text('city', $companies->city, array('class' => 'form-control', 'placeholder' => 'Enter City')) }} 
                                        </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                            {{ Form::label('Zip/Postal Code') }}
                                            {{ Form::text('zipcode', $companies->zipcode, array('class' => 'form-control', 'placeholder' => 'Enter Zip/Postal Code')) }} 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                            {{ Form::label('Telephone') }}
                                            {{ Form::text('phone', $companies->phone, array('class' => 'form-control', 'placeholder' => 'Enter Telephone')) }} 
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                            {{ Form::label('Mobile Number') }}
                                            {{ Form::text('mobile', $companies->mobile, array('class' => 'form-control', 'placeholder' => 'Enter Mobile Number')) }} 
                                            </div>
                                        </div>
                                    </div>
                                     <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                            {{ Form::label('Fax') }}
                                            {{ Form::text('fax', $companies->fax, array('class' => 'form-control', 'placeholder' => 'Enter Fax')) }} 
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                            {{ Form::label('Website URL') }}
                                            {{ Form::text('website', $companies->website, array('class' => 'form-control', 'placeholder' => 'Enter Website URL')) }} 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                            {{ Form::label('Email') }}
                                            {{ Form::text('email', $companies->email, array('class' => 'form-control', 'placeholder' => 'Enter Email')) }} 
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                            {{ Form::label('Twitter Handle') }}
                                            {{ Form::text('twitter', $companies->twitter, array('class' => 'form-control', 'placeholder' => 'Enter Twitter Handle')) }} 
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="hr-line-dashed"> 
                                    <div class="pull-right">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="button" id="add-s" class="btn btn-primary add-company">Save</button>
                                    </div>
                                    {!! Form::close() !!}
                                <!-- </form> -->
                              </div>
                            </div>
                          </div>
                          <div class="panel panel-default" id="multi-user">
                            <div class="panel-heading" role="tab" id="headingTwo">
                              <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion{{ $companies->id }}" href="#collapseTwo{{ $companies->id }}" aria-expanded="false" aria-controls="collapseTwo{{ $companies->id }}">
                                  User Management
                                </a>
                              </h4>
                            </div>

   <div id="collapseTwo{{ $companies->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-Two">
      <div class="panel-body">
        @if(!isset($data['users'][$key][0]))
        <!-- <form role="form"> -->
        {!! Form::open(array('url' => '', 'class'=> 'user')) !!}
            <input type="hidden" name="company_id" class="company_id">
            <div class="form-group"><label>Role</label> 
            <select name="user_type" id="" class="form-control">
                <option value="">Select Role</option>
                <option value="2">Super Admin</option>
                <option value="3">Admin</option>
                <option value="4">Content Editor</option>
            </select>
            </div>
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
                    {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Enter Password', 'required')) }}                                       </div>
                </div> 
                <div class="row">
                    <div class="col-sm-6">
                    {{ Form::label('Email Address') }}
                    {{ Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'Enter Email Address', 'required')) }}                                     
                    </div>
                    <div class="col-sm-6">
                    {{ Form::label('Mobile Number') }}
                    {{ Form::text('mobile', '', array('class' => 'form-control', 'placeholder' => 'Enter Mobile Number', 'required')) }}
                    </div>
                </div>
            <div class="row" id="selects">
                <div class="col-sm-6">
                    <div class="form-group"><label>Access</label> 
                    <select name="access" id="access" class="form-control selectpicker access" multiple title="Please select">
                        <option value="User Management">User Management</option>
                        <option value="Video Library">Video Library</option>
                        <option value="Advertising">Advertising</option>
                        <option value="Switcher">Switcher</option>
                        <option value="Live Streaming">Live Streaming</option>
                        <optgroup label="User Submitted">
                        <option value="Video">Video</option>
                        <option value="Photos">Photos</option>
                      </optgroup>
                    </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group"><label>Notifications</label> 
                    <select name="notifications" id="notifications" class="form-control selectpicker notifications" multiple title="Please select">
                        <option value="email">Email</option>
                        <option value="sms">SMS</option>
                    </select>
                    </div>
                </div>
            </div>
            <div class="pull-right">
                <div class="btn-group">
                <button class="btn btn-xs btn-primary btn-outline" type="button" id="extra-user">Add Another User</button>
                <button class="btn btn-xs btn-primary usr-btn" value="" type="button">Save</button>
            </div>
            </div>          
            {!! Form::close() !!}

        <!-- </form>      -->
        @endif
        @foreach ($data['users'][$key] as $user)
        <?php
            $notification = unserialize($user->notification);
            if(!is_array($notification)) {
                $notification = array();
            }
            $access = unserialize($user->access);
            if(!is_array($access)) {
                $access = array();
            }
         ?>
       <table class="table table-bordered table-responsive">
            <thead>
            <tr>
                <th>Role</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    @if($user->role == 2) 
                        Super Admin 
                    @elseif($user->role == 3)
                        Admin
                    @elseif($user->role == 4)
                        Content Editor
                    @endif
                </td>
                <td>{{$user->first_name}}</td>
                <td>{{$user->last_name}}</td>
                <td>{{$user->name}}</td>
                <td><div class="text-center"><button class="btn btn-xs btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample{{$user->id}}" aria-expanded="false" aria-controls="collapseExample"><i class="fa fa-pencil"></i></button></div></td>
                <td><div class="text-center"><button class="btn btn-xs btn-primary deleteUser" value="{{$user->id}}" type="button"><i class="fa fa-times"></i></button></div></td>
            </tr>
            </tbody>
        </table>
        <!-- START: Collapse -->
        <div class="collapse" id="collapseExample{{$user->id}}">
        <div id="new-user">
        <!-- <form role="form"> -->
            {!! Form::open(array('url' => '')) !!}
                <div class="form-group"><label>Role</label> 
                <select name="user_type" id="" class="form-control">
                    <option value="">Select Role</option>
                    <option value="2" @if($user->role == 2) selected @endif>Super Admin</option>
                    <option value="3" @if($user->role == 3) selected @endif>Admin</option>
                    <option value="4" @if($user->role == 4) selected @endif>Content Editor</option>
                </select>
                </div>
                <div class="row">
                        <div class="col-sm-6">
                        {{ Form::label('First Name') }}
                        {{ Form::text('first_name', $user->first_name, array('class' => 'form-control', 'placeholder' => 'Enter First Name', 'required')) }} 
                        </div>
                        <div class="col-sm-6">
                        {{ Form::label('Last Name') }}
                        {{ Form::text('last_name', $user->last_name, array('class' => 'form-control', 'placeholder' => 'Enter Last Name', 'required')) }}                                     
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-sm-6">
                        {{ Form::label('User Name') }}
                        {{ Form::text('name', $user->name, array('class' => 'form-control', 'placeholder' => 'Enter User Name', 'required')) }}
                        </div>
                        <div class="col-sm-6">
                        {{ Form::label('Password') }}
                        {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Enter Password', 'required')) }}                                       </div>
                    </div> 
                    <div class="row">
                        <div class="col-sm-6">
                        {{ Form::label('Email Address') }}
                        {{ Form::text('email', $user->email, array('class' => 'form-control', 'placeholder' => 'Enter Email Address', 'required')) }}                                     
                        </div>
                        <div class="col-sm-6">
                        {{ Form::label('Mobile Number') }}
                        {{ Form::text('mobile', $user->mobile, array('class' => 'form-control', 'placeholder' => 'Enter Mobile Number', 'required')) }}
                        </div>
                    </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group"><label>Access</label> 
                        <select name="access" id="access" class="form-control selectpicker access" multiple title="Please select">
                        <option value="User Management"@if(in_array('User Management',$access)) selected @endif>User Management</option>
                        <option value="Video Library"@if(in_array('Video Library',$access)) selected @endif>Video Library</option>
                        <option value="Advertising"@if(in_array('Advertising',$access)) selected @endif>Advertising</option>
                        <option value="Switcher"@if(in_array('Switcher',$access)) selected @endif>Switcher</option>
                        <option value="Live Streaming"@if(in_array('Live Streaming',$access)) selected @endif>Live Streaming</option>
                        <optgroup label="User Submitted">
                        <option value="Video"@if(in_array('Video',$access)) selected @endif>Video</option>
                        <option value="Photos"@if(in_array('Photos',$access)) selected @endif>Photos</option>
                      </optgroup>
                    </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group"><label>Notifications</label> 
                        <select name="notifications" id="notifications" class="form-control selectpicker notifications" multiple title="Please select">
                            <option value="email" @if(in_array('email',$notification)) selected @endif>Email</option>
                            <option value="sms" @if(in_array('sms',$notification)) selected @endif>SMS</option>
                        </select>
                        </div>
                    </div>
                </div>
                <div class="pull-right">
                    <div class="btn-group">
                    <button class="btn btn-xs btn-primary btn-outline" type="button" id="extra-user">Add Another User</button>
                    <button class="btn btn-xs btn-primary usr-btn" type="button" value="{{$user->id}}">Save</button>
                    <input type="hidden" name="company_id" value="{{ $companies->id }}">                                        
                </div>
                </div>          
                {!! Form::close() !!}
            <!-- </form> -->
            </div>
        </div>
        <!-- END: Collapse -->        
    @endforeach
      </div>
    </div>

                          </div>
                          <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                              <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion{{ $companies->id }}" href="#collapseThree{{ $companies->id }}" aria-expanded="false" aria-controls="collapseThree{{ $companies->id }}">
                                  Time Zone
                                </a>
                              </h4>
                            </div>
                            <div id="collapseThree{{ $companies->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                              <div class="panel-body">
                                <div class="form-group"><label>&nbsp;</label> 
                                <select name="timezone" id="time-zone" class="form-control selectpicker time-zone" data-live-search="true" title="Please select">
                                    <?php $timezones = generate_timezone_list(); ?>
                                    <option value="{{ $companies->timezone }}" selected >{{ $companies->timezone }}</option>
                                    @foreach($timezones as $timezone)
                                    <option value="{{$timezone}}">{{$timezone}}</option>
                                    @endforeach
                                    <option value="">Other</option>
                                </select>
                                    </div>
                                    <hr class="hr-line-dashed"> 
                                    <div class="pull-right">
                                        <button type="button" class="btn btn-primary timezone">Save</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingFour">
                              <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion{{ $companies->id }}" href="#collapseFour{{ $companies->id }}" aria-expanded="false" aria-controls="collapseFour{{ $companies->id }}">
                                  Product Details
                                </a>
                              </h4>
                            </div>
                            <div id="collapseFour{{ $companies->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                              <div class="panel-body">
                                <?php 
                                    unset($radio);
                                    unset($video);
                                    foreach ($data['products'][$key] as $value) {
                                        if($value->station_type == 'video') {
                                            $video = 'video';
                                        }
                                        if($value->station_type == 'radio') {
                                            $radio = 'radio';
                                        }
                                    }
                                ?>
                                <!-- <form role="form"> -->
                                {!! Form::open(array('url' => '', 'class' => 'product', 'files'=>true)) !!}              
                                    <div class="form-group"><label>Video:</label>&nbsp;
                                       <div class="radio radio-green radio-inline">
                                            <input type="radio" id="video-yes" value="0" name="video" @if(isset($video)) checked="checked" @endif >
                                            <label for="video-yes"> Yes </label>
                                        </div>
                                        <div class="radio radio-green radio-inline">
                                            <input type="radio" id="video-no" value="1" name="video">
                                            <label for="video-no"> No </label>
                                        </div>
                                    </div>
                                    <hr class="hr-line-dashed">
                                    <div class="video-station" @if(!isset($video)) style="display: none" @endif>
                                    @if(!isset($video))
                                    <div class="row" id="video-station">
                                        <div class="col-sm-3">
                                            <div class="form-group"><label>Station Name</label> <input type="text" placeholder="Enter Station Name" class="form-control" name="video_station_name[]"></div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group"><label>Stream Name/Instance</label> <input type="text" placeholder="Enter Stream Name/Instance" class="form-control" name="video_station_stream[]"></div>
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="control-label">Select Logo</label>
                                            <input id="input-4" name="video_input4[]" type="file" multiple class="file-loading input-4">
                                        </div>
                                        <div class="col-sm-3">                                      
                                            <div class="btn-group btn-position">
                                                <button class="btn btn-primary video-station" type="button"><i class="fa fa-plus"></i></button>
                                                <button class="btn btn-primary minus" type="button"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>                                      
                                    </div>                                             
                                    <hr class="hr-line-dashed">
                                    @endif
                                    @foreach ($data['products'][$key] as $product)
                                        @if($product->station_type == 'video')
                                        <div class="row" id="video-station">
                                            <div class="col-sm-3">
                                                <div class="form-group"><label>Station Name</label> <input type="text" placeholder="Enter Station Name" class="form-control" name="video_station_name[]" value="{{$product->station_name}}"></div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group"><label>Stream Name/Instance</label> <input type="text" placeholder="Enter Stream Name/Instance" class="form-control" name="video_station_stream[]" value="{{$product->station_instance}}"></div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="control-label">Select Logo</label>
                                                <img src="">
                                                <input id="input-4{{$product->id}}" name="video_input4[]" type="file" class="file-loading input-4">
                                            </div>
                                            <div class="col-sm-2">                                      
                                                <div class="btn-group btn-position">
                                                    <button class="btn btn-primary video-station" type="button"><i class="fa fa-plus"></i></button>
                                                    <button class="btn btn-primary minus" type="button"><i class="fa fa-minus"></i></button>
                                                </div>
                                            </div>                                      
                                        </div>                                             
                                        <hr class="hr-line-dashed">
                                        <script type="text/javascript">
                                        $(document).on('ready', function() {
                                            $("#input-4{{$product->id}}").fileinput({
                                                showCaption: false, 
                                                uploadUrl: baseUrl+"videoLogo",
                                                autoReplace: true,
                                                overwriteInitial: true,
                                                showUploadedThumbs: false,
                                                maxFileCount: 1,
                                                initialPreview: [
                                                    "<img style='height:160px; width:190px' src='{{$product->station_logo}}'>",
                                                ],
                                                initialPreviewShowDelete: false,
                                                showRemove: false,
                                                showClose: false,
                                                layoutTemplates: {actionDelete: ''}, // disable thumbnail deletion
                                                allowedFileExtensions: ["jpg", "png", "gif"]                         
                                            });
                                        })
                                        </script>
                                        <input type="hidden" value="{{ $product->id }}" name="video_id[]"></input>
                                        @endif
                                    @endforeach
                                    </div>                                             
                                    <div class="form-group"><label>Radio:</label>&nbsp;
                                       <div class="radio radio-green radio-inline">
                                            <input type="radio" id="radio-yes" value="0" name="radio"  @if(isset($radio)) checked="checked" @endif >
                                            <label for="radio-yes"> Yes </label>
                                        </div>
                                        <div class="radio radio-green radio-inline">
                                            <input type="radio" id="radio-no" value="1" name="radio">
                                            <label for="radio-no"> No </label>
                                        </div>
                                    </div>  
                                    <hr class="hr-line-dashed">
                                    <div class="audio-station" @if(!isset($radio)) style="display: none" @endif>
                                    @if(!isset($radio))
                                    <div class="row" id="audio-station">
                                        <div class="col-sm-3">
                                            <div class="form-group"><label>Station Name</label> <input type="text" placeholder="Enter Station Name" class="form-control" name="radio_station_name[]"></div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group"><label>Stream Name/Instance</label> <input type="text" placeholder="Enter Stream Name/Instance" class="form-control" name="radio_station_stream[]"></div>
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="control-label">Select Logo</label>
                                            <input id="input-5" name="radio_input5[]" type="file" multiple class="file-loading input-5">
                                        </div>
                                        <div class="col-sm-3">                                      
                                            <div class="btn-group btn-position">
                                                <button class="btn btn-primary audio-station" type="button"><i class="fa fa-plus"></i></button>
                                                <button class="btn btn-primary minus" type="button"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div>                                      
                                    </div>
                                    <hr class="hr-line-dashed"> 
                                    @endif
                                    @foreach ($data['products'][$key] as $product)
                                        @if($product->station_type == 'radio')
                                        <div class="row" id="audio-station">
                                            <div class="col-sm-3">
                                                <div class="form-group"><label>Station Name</label> <input type="text" placeholder="Enter Station Name" class="form-control" name="radio_station_name[]" value="{{$product->station_name}}" ></div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group"><label>Stream Name/Instance</label> <input type="text" placeholder="Enter Stream Name/Instance" class="form-control" name="radio_station_stream[]" value="{{$product->station_instance}}"></div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="control-label">Select Logo</label>
                                                <input id="input-5{{$product->id}}" name="radio_input5[]" type="file" class="file-loading input-5">
                                            </div>
                                            <div class="col-sm-2">                                      
                                                <div class="btn-group btn-position">
                                                    <button class="btn btn-primary audio-station" type="button"><i class="fa fa-plus"></i></button>
                                                    <button class="btn btn-primary minus" type="button"><i class="fa fa-minus"></i></button>
                                                </div>
                                            </div>                                      
                                        </div>
                                        <hr class="hr-line-dashed"> 
                                        <script type="text/javascript">
                                                $(document).on('ready', function() {
                                                $("#input-5{{$product->id}}").fileinput({
                                                    showCaption: false, 
                                                    uploadUrl: baseUrl+"/audioLogo",
                                                    autoReplace: true,
                                                    overwriteInitial: true,
                                                    showUploadedThumbs: false,
                                                    maxFileCount: 1,
                                                    initialPreview: [
                                                        "<img style='height:160px; width:190px' src='{{$product->station_logo}}'>",
                                                    ],
                                                    initialPreviewShowDelete: false,
                                                    showRemove: false,
                                                    showClose: false,
                                                    layoutTemplates: {actionDelete: ''}, // disable thumbnail deletion
                                                    allowedFileExtensions: ["jpg", "png", "gif"]                         
                                                });
                                            })
                                        </script> 
                                        <input type="hidden" value="{{ $product->id }}" name="radio_id[]"></input>
                                        @endif
                                    @endforeach
                                    </div>
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary save-station">Save</button>
                                        <input type="hidden" name="company_id" value="{{ $companies->id }}">                    
                                    </div>
                                    {!! Form::close() !!}
                                <!-- </form> -->
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">close</button>
                        <!-- <button type="submit" class="btn btn-primary">save</button> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Add Customer Modal -->
        <!-- END: Modal -->
        <!-- End of edit user details -->
                    @endforeach
                </div>
            </div>
            <nav class="text-center">
              <ul class="pagination">
                @include('pagination.default', ['paginator' => $data['companies']])
              </ul>
            </nav>
        </div>            
    </div>
</div>
@endsection
<?php
function generate_timezone_list()
{
    static $regions = array(
        DateTimeZone::AFRICA,
        DateTimeZone::AMERICA,
        DateTimeZone::ANTARCTICA,
        DateTimeZone::ASIA,
        DateTimeZone::ATLANTIC,
        DateTimeZone::AUSTRALIA,
        DateTimeZone::EUROPE,
        DateTimeZone::INDIAN,
        DateTimeZone::PACIFIC,
    );

    $timezones = array();
    foreach( $regions as $region )
    {
        $timezones = array_merge( $timezones, DateTimeZone::listIdentifiers( $region ) );
    }

    $timezone_offsets = array();
    foreach( $timezones as $timezone )
    {
        $tz = new DateTimeZone($timezone);
        $timezone_offsets[$timezone] = $tz->getOffset(new DateTime);
    }

    // sort timezone by offset
    asort($timezone_offsets);

    $timezone_list = array();
    foreach( $timezone_offsets as $timezone => $offset )
    {
        $offset_prefix = $offset < 0 ? '-' : '+';
        $offset_formatted = gmdate( 'H:i', abs($offset) );

        $pretty_offset = "UTC${offset_prefix}${offset_formatted}";

        $timezone_list[$timezone] = "(${pretty_offset}) $timezone";
    }

    return $timezone_list;
}
?>
