<?php 
/**
 * User Controller
 *
 * @copyright  2016 SparkSupport
 * @author     Ajith
 * @date 	   26-10-16
 * @contact    ajitharakkal@gmail.com
 */
?>
@extends('layouts.ad')
@section('title', 'Main page')

@section('content')
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-12">
                    <h2>Advertising</h2>                                 
                </div>            
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                    <div class="col-lg-6">
                        <!-- START: Accordion -->
                        <div class="panel-group accordion-panel-colour" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
         <i class="fa fa-empire"></i> Ad Providers
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body" ng-app="app" ng-controller="Ctrl">
           <table class="table table-striped table-bordered table-hover ad-provider" id="example">
            <thead>
                <tr style="font-weight: bold">
                  <td style="width:35%">Name</td>
                  <td style="width:20%">Status</td>
                  <td style="width:25%">Edit</td>
                </tr>
            </thead>
            <tbody>
            <tr ng-repeat="user in users">
              <td>
                <!-- editable username (text with validation) -->
                <span editable-text="user.name" e-name="name" e-form="rowform" onbeforesave="checkName($data, user.id)" e-required ng-click="rowform.$show()">
                  @{{ user.name || 'empty' }}
                </span>
              </td>
              <td>
                <!-- editable status (select-local) -->
                <span editable-select="user.status" e-name="status" e-form="rowform" e-ng-options="s.value as s.text for s in statuses">
                  @{{ showStatus(user) }}
                </span>
              </td>
              <td style="white-space: nowrap">
                <!-- form -->
                <form editable-form name="rowform" onbeforesave="saveUser($data, user.id)" ng-show="rowform.$visible" class="form-buttons form-inline" shown="inserted == user">
                  <button type="submit" ng-disabled="rowform.$waiting" class="btn btn-primary">
                    save
                  </button>
                  <button type="button" ng-disabled="rowform.$waiting" ng-click="rowform.$cancel()" class="btn btn-default">
                    cancel
                  </button>
                </form>
                <div class="buttons" ng-show="!rowform.$visible">
                  <button class="btn btn-danger" ng-click="removeUser($index)">del</button>
                </div>  
              </td>
            </tr>
            </tbody>
          </table>

		<button type="button" id="addRow" class="btn btn-w-m btn-primary pull-right">Add New Provider</button>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          <i class="fa fa-desktop"></i> Video(s) with Advertising
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
        <table class="table table-striped table-bordered table-hover videos-with-advertising" >
            <thead>
            <tr>
                <th>Title</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr class="gradeX">
                <td>                        	<a href="#">
                		<img src="#" alt="">&nbsp;
                	Arvin & Anaya
                	</a>
                	</td>
                <td><div class="text-center"><button class="btn btn-xs btn-primary" type="button"><i class="fa fa-times"></i></button></div></td>
                <td><div class="text-center"><button class="btn btn-xs btn-primary" type="button" data-toggle="modal" data-target="#embedCodeModal"><i class="fa fa-code"></i></button></div></td>		
            </tr>                    
               <tr class="gradeC">
                <td>
                	<a href="#">
                		<img src="#" alt="">&nbsp;
                	Perry Stone
                	</a>
                </td>
				   <td><div class="text-center"><button class="btn btn-xs btn-primary" type="button"><i class="fa fa-times"></i></button></div></td>
				   <td><div class="text-center"><button class="btn btn-xs btn-primary" type="button"><i class="fa fa-code"></i></button></div></td>
            </tr>                   
            </tbody>
            </table>
      </div>
    </div>
  </div>
  </div>
<!-- END: Accordion -->
                   
	<!-- START: Embed Code Modal -->
    <div class="modal" id="embedCodeModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content animated fadeIn">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>   
                            <h4 class="modal-title">Embed Code</h4>                                            
                        </div>
                        <div class="modal-body">
                            <label class="control-label">Auto Play:</label>
                               <div class="radio radio-green radio-inline">
                            <input type="radio" id="inlineRadio1" value="option1" name="radioInline" checked="">
                            <label for="inlineRadio1"> Yes </label>
                        </div>
                        <div class="radio radio-green radio-inline">
                            <input type="radio" id="inlineRadio2" value="option2" name="radioInline">
                            <label for="inlineRadio2"> No </label>
                        </div>
                                 <div class="input-group">
                            <input type="text" class="form-control" value=""><span class="input-group-btn"> 
              		<button class="btn btn-primary" type="button"><i class="fa fa-copy"></i> Copy</button>
              		  </span></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>                    
    <!-- END: Embed Code Modal -->  
		
    </div>
    
    <div class="col-lg-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">                                
                <h5><i class="fa fa-cog"></i> Advertising Details</h5>
            </div>
            <div class="ibox-content">
             <form method="get" class="form-horizontal">
                <div class="form-group"><label class="col-sm-2 control-label">Ad Source:</label>
					  <div class="col-sm-10">
                       <div class="radio radio-green radio-inline">
                            <input type="radio" id="ad-provider" value="option1" name="ad-source">
                            <label for="ad-provider"> Ad Provider </label>
                        </div>
                        <div class="radio radio-green radio-inline">
                            <input type="radio" id="video" value="option2" name="ad-source">
                            <label for="video"> Video Library</label>
                        </div>

                     </div>
                </div>
                <div class="hr-line-dashed"></div>
            <div class="ad-providers">
                <div class="form-group"><label class="col-sm-2 control-label">Ad Provider:</label>
					  <div class="col-sm-8">
                       <select class="select-ad-provider">
								<option value=""></option>
								<option value="Google Double Click (DFP)">Google Double Click (DFP)</option>
								<option value="OpenX">OpenX</option>
							</select>
                     </div>
                     <div class="col-sm-2"><button class="btn btn-primary btn-outline" type="button"><i class="fa fa-plus"></i></button></div>
                </div>
                <div class="form-group"><label class="col-sm-2 control-label"></label>
					  <div class="col-sm-8">
                       <select class="select-fallback-ad-provider">
								<option value=""></option>
								<option value="Google Double Click (DFP)">Google Double Click (DFP)</option>
								<option value="OpenX">OpenX</option>
							</select>
                     </div>
                     <div class="col-sm-2">
                     	<div class="btn-group">
                            <button class="btn btn-primary btn-outline" type="button"><i class="fa fa-plus"></i></button>
                            <button class="btn btn-primary btn-outline" type="button"><i class="fa fa-minus"></i></button>
                        </div>
					</div>
                </div>
                <div class="hr-line-dashed"></div>
            </div>
            <div class="ad-video">
                <div class="form-group"><label class="col-sm-2 control-label">Video Library:</label>
					  <div class="col-sm-10">
							<select class="select-videos">
							<option value=""></option>
								<option value="video1">video 1</option>
								<option value="video2">video 2</option>
							</select>
                     </div>                                     
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-sm-2 control-label">Ad Type:</label>
					  <div class="col-sm-10">
                       <select name="" id="" class="form-control">
                       	<option value="">Google IMA Preroll</option>
                       	<option value="">Preroll</option>
                       	<option value="">Postroll</option>
                       </select>
                     </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-sm-2 control-label">Video:</label>
					  <div class="col-sm-10">
                       <select class="select-video">
							<option value=""></option>
								<option value="video1">video 1</option>
								<option value="video2">video 2</option>
							</select>
                     </div>
                </div>
                <div class="hr-line-dashed"></div>
            </div>
            <div class="video-play">
                <div class="form-group">
                <div class="col-sm-12 text-info"><h3>Video Title</h3></div>
				 </div>
					 <div class="form-group"> 
                     <div class="col-sm-12 no-padding">
                     <div id="player">Loading the player...</div>
                     </div>
                </div>
                <div class="hr-line-dashed"></div>
            </div>
            <div class="noui">
                <div class="form-group">                                  
                    <div class="col-sm-11">
					<!-- Slider -->	
						<span class="noUi-connect" id="slider"></span>
						<span id="field"></span>
                    </div>
					<div class="col-sm-1"><button class="btn btn-primary" type="button" id="break"><i class="fa fa-plus"></i></button></div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">                                  
                    <div class="col-sm-3">
                    <label for="" class="control-label">Break 1</label>
					 <div class="input-group">
                                <input type="number" class="form-control"> <span class="input-group-btn"> 
              		<button class="btn btn-primary" type="button"><i class="fa fa-minus"></i></button>
              		  </span></div>                                    
                    </div>
                    <div class="col-sm-3">
                    <label for="" class="control-label">Break 2</label>
					 <div class="input-group">
                                <input type="number" class="form-control"> <span class="input-group-btn"> 
              		<button class="btn btn-primary" type="button"><i class="fa fa-minus"></i></button>
              		  </span></div>                                    
                    </div>
                    <div class="col-sm-3">
                    <label for="" class="control-label">Break 3</label>
					 <div class="input-group">
                                <input type="number" class="form-control"> <span class="input-group-btn"> 
              		<button class="btn btn-primary" type="button"><i class="fa fa-minus"></i></button>
              		  </span></div>                                    
                    </div>
                    <div class="col-sm-3">
                    <label for="" class="control-label">Break 4</label>
					 <div class="input-group">
                                <input type="number" class="form-control"> <span class="input-group-btn"> 
              		<button class="btn btn-primary" type="button"><i class="fa fa-minus"></i></button>
              		  </span></div>
                    
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
            </div>
            <div class="scheduled-ad">
                <div class="form-group"><label class="col-sm-2 control-label">Scheduled Ad Breaks:</label>
					  <div class="col-sm-10">
                       <div class="radio radio-green radio-inline">
                            <input type="radio" id="scheduled-ad-no" value="option1" name="scheduled-ad-breaks" checked="">
                            <label for="scheduled-ad-no"> No </label>
                        </div>
                        <div class="radio radio-green radio-inline">
                            <input type="radio" id="scheduled-ad-yes" value="option2" name="scheduled-ad-breaks">
                            <label for="scheduled-ad-yes"> Yes </label>
                        </div>
                     </div>
                </div>
                <div class="hr-line-dashed"></div>
            </div>
            <div class="companion-ad">
                <div class="form-group"><label class="col-sm-2 control-label">Companion Ad:</label>
					  <div class="col-sm-10">
                       <div class="radio radio-green radio-inline">
                            <input type="radio" id="companion-ad-no" value="option1" name="companion-ad" checked="">
                            <label for="companion-ad-no"> No </label>
                        </div>
                        <div class="radio radio-green radio-inline">
                            <input type="radio" id="companion-ad-yes" value="option2" name="companion-ad">
                            <label for="companion-ad-yes"> Yes </label>
                        </div>
                     </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="companion-details">
                    <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
    					  <div class="col-sm-4">
    					  <label for="div-id" class="control-label">DIV ID</label>
    							<input id="div-id" type="text" class="form-control">
                         </div>
                         <div class="col-sm-3">
                         <label for="height">Height</label>
    							<div class="input-group">
                                    <input type="number" id="height" name="height" class="form-control"> <span class="input-group-addon">px</span></div> 
                         </div>
                         <div class="col-sm-3">
                         <label for="height">Width</label>
    							<div class="input-group">
                                    <input type="number" id="width" class="form-control"> <span class="input-group-addon">px</span></div> 
                         </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                </div>
                <div class="form-group"><label class="col-sm-2 control-label">Ad Message (<span class="text-danger">Optional</span>):</label>
					  <div class="col-sm-10">
                       <input type="text" class="form-control">
                     </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-sm-2 control-label">Skip Ad:</label>
					  <div class="col-sm-10">
                       <div class="radio radio-green radio-inline">
                            <input type="radio" id="skip-no" value="option1" name="skip-ad" checked="">
                            <label for="skip-no"> No </label>
                        </div>
                        <div class="radio radio-green radio-inline">
                            <input type="radio" id="skip-yes" value="option2" name="skip-ad">
                            <label for="skip-yes"> Yes </label>
                        </div>
                     </div>
                </div>
                <div class="hr-line-dashed"></div>
            </div>
                <div class="form-group">
                <div class="col-sm-12">
                <button type="submit" class="btn btn-w-m btn-primary pull-right">Save</button>
					</div>
				 </div>
				</form>
            </div>
        </div>
    </div>        
    </div>
    </div>
    <?php 
    $withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $video[0]['video']);
    $video_path = explode('public', $video[0]['video']); 
    $img_path   = explode('public', $withoutExt);
    ?>      
    <!-- JW PLayer -->
    <script src="http://content.jwplatform.com/libraries/D219T2Wf.js"></script>
    <script>
        /* Angular x-editable form */
        var app = angular.module("app", ["xeditable"]);

        app.run(function(editableOptions) {
          editableOptions.theme = 'bs3';
        });

        app.controller('Ctrl', function($scope, $filter, $http) {
         $scope.users = [
            {id: 1, name: 'awesome user1', status: 2, group: 4, groupName: 'admin'},
            {id: 2, name: 'awesome user2', status: undefined, group: 3, groupName: 'vip'},
            {id: 3, name: 'awesome user3', status: 2, group: null}
          ]; 

          $scope.statuses = [
            {value: 1, text: 'status1'},
            {value: 2, text: 'status2'},
            {value: 3, text: 'status3'},
            {value: 4, text: 'status4'}
          ]; 

          $scope.groups = [];
          $scope.loadGroups = function() {
            return $scope.groups.length ? null : $http.get('/groups').success(function(data) {
              $scope.groups = data;
            });
          };

          $scope.showGroup = function(user) {
            if(user.group && $scope.groups.length) {
              var selected = $filter('filter')($scope.groups, {id: user.group});
              return selected.length ? selected[0].text : 'Not set';
            } else {
              return user.groupName || 'Not set';
            }
          };

          $scope.showStatus = function(user) {
            var selected = [];
            if(user.status) {
              selected = $filter('filter')($scope.statuses, {value: user.status});
            }
            return selected.length ? selected[0].text : 'Not set';
          };

          $scope.checkName = function(data, id) {
            if (id === 2 && data !== 'awesome') {
              return "Username 2 should be `awesome`";
            }
          };

          $scope.saveUser = function(data, id) {
            //$scope.user not updated yet
            angular.extend(data, {id: id});
            // return $http.post('/saveUser', data);
            return true;
          };

          // remove user
          $scope.removeUser = function(index) {
            $scope.users.splice(index, 1);
          };

          // add user
          $scope.addUser = function() {
            $scope.inserted = {
              id: $scope.users.length+1,
              name: '',
              status: null,
              group: null 
            };
            $scope.users.push($scope.inserted);
          };
        });
    </script>
    <script type="text/javascript">
    /*var playerInstance = jwplayer("player");
    playerInstance.setup({
        image: "{{ url('/') }}/public{{$img_path[1]}}_290.jpg", 
        sources: [{ 
            file: "{{ url('/') }}/public{{$video_path[1]}}"
            }],            
        autostart: "false",
        androidhls: "true",
        abouttext: "Metamorphosis",
        aboutlink: "http://www.metamorphosis.tv",
        aspectratio: "16:9",
        'bufferlength': "13",
        provider: "http",
            advertising: {
                client: 'vast',
                schedule: {
                postroll:{
                    tag: 'http://demo.tremorvideo.com/proddev/vast/vast2RegularLinear.xml',
                    offset: 'post'
                }
            }
        }
    });*/
     var playerInstance = jwplayer("player");
    playerInstance.setup({
        image: "http://ddwc.metamorphosis.tv/poster/ddwc.png", 
        sources: [{ 
            file: "http://104.196.194.7:1935/vod/_definst_/mp4:sample.mp4/manifest.m3u8"            
        }],    
    autostart: "false",
    androidhls: "true",
    abouttext: "Metamorphosis",
    aboutlink: "http://www.metamorphosis.tv",
    aspectratio: "16:9",

    });


  $( document ).ready(function() {

    var slider = document.getElementById('slider');

    noUiSlider.create(slider, {
      start: [ 0 ],
      range: {
        'min': [  0 ],
        'max': [ 634 ]
      }
    })
    var rangeSliderValueElement = document.getElementById('field');

    slider.noUiSlider.on('update', function( values, handle ) {
      rangeSliderValueElement.innerHTML = values[handle]+' Seconds';
      if(values[handle] != '0.00') {
        jwplayer("player").seek(values[handle])
      }
    });

  });
  </script>
@endsection