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
@extends('layouts.home')
@section('title', 'Main page')

@section('content')
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-12">
                <h2>Video Library</h2>
            </div>               
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">                                
                                <h5><i class="fa fa-list"></i> Videdo Listing</h5>
                            </div>
                            <div class="ibox-content">
                              <div class="row">
                                <div class="col-lg-6"><strong>Total no# of videos:</strong> 6</div>                                 
                                <div class="col-lg-6">
                                    <div class="pull-right">
                                        <button class="btn btn-primary" type="button"><i class="fa fa-upload"></i> Upload Video(s)</button>
                                    </div>
                                </div>
                              </div>  
                       <hr class="hr-line-dashed" />
                         <!-- START: Table -->
                        
                   <table class="table table-striped table-bordered table-hover dataTables" >
                    <thead>
                    <tr>
                      <th><input name="select_all" value="1" id="example-select-all" type="checkbox" /></th>
                        <th>Title</th>
                        <th>Duration</th>
                        <th>Upload Date</th>
                        <th>Uploaded by</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="gradeX">
                      <td></td>
                        <td>
                            <a href="video-details.html">
                                <img src="http://lorempixel.com/130/80/" alt="">&nbsp;
                            Car Jump - Nike MVP Muppets
                            </a>
                        </td>
                        <td>0:31</td>
                        <td>12.12.2016</td>
                        <td>John Doe</td>
                    </tr>
                    <tr class="gradeC">
                      <td></td>
                        <td>
                            <a href="video-details.html">
                                <img src="http://lorempixel.com/130/80/sports" alt="">&nbsp;
                            Differently Abled Persons Awareness Campaign - Debbie & Joan
                            </a>
                        </td>
                        <td>7:45</td>
                        <td>21.04.2016</td>
                        <td>John Doe</td>
                    </tr>
                    <tr class="gradeA">
                     <td></td>
                        <td>
                            <a href="video-details.html">
                                <img src="http://lorempixel.com/130/80/technics" alt="">&nbsp;
                            Lakewood Chruch - Worship
                            </a>
                        </td>
                        <td>2:01</td>
                        <td>06.10.2016</td>
                        <td>Jane Doe</td>
                    </tr>
                    <tr class="gradeA">
                     <td></td>
                        <td>
                            <a href="video-details.html">
                                <img src="http://lorempixel.com/130/80/people" alt="">&nbsp;
                            Bishop TD Jakes - Hillsong Conference Europe 2011
                            </a>
                        </td>
                        <td>10:22</td>
                        <td>17.10.2016</td>
                        <td>Jane Doe</td>
                    </tr>
                    <tr class="gradeA">
                       <td></td>
                        <td>
                            <a href="video-details.html">
                                <img src="http://lorempixel.com/130/80/transport" alt="">&nbsp;
                            Arvin & Anaya
                            </a>
                        </td>
                        <td>10:22</td>
                        <td>30.11.2016</td>
                        <td>Jane Doe</td>
                    </tr>
                    <tr class="gradeA">
                       <td></td>
                        <td>
                            <a href="video-details.html">
                                <img src="http://lorempixel.com/130/80/fashion" alt="">&nbsp;
                            Perry Stone
                            </a>
                        </td>
                        <td>30:00</td>
                        <td>31.12.2016</td>
                        <td>John Doe</td>
                    </tr>
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
                        
                        <!-- END: Table -->
                            </div>
                        </div>
                    </div>            
            </div>
@endsection