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

<?php $__env->startSection('title', 'Main page'); ?>

<?php $__env->startSection('content'); ?>
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
                                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#add-video"><i class="fa fa-upload"></i> Upload Video(s)</button>
    <!-- START: Modal -->
    <div class="modal inmodal" id="add-video" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated fadeIn">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <span class="pull-left"><strong>Add:</strong> <!-- [First Name] [Last Name] --></span>
                </div>
                <div class="modal-body">
                <?php echo Form::open(array('url' => 'videos/create','files'=>true,'method' => 'post')); ?>                    
                    <div class="row">

                        <div id="filelist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
                        <br />

                        <div id="container">
                            <?php echo e(Form::label('Upload Video')); ?><br>
                            <a id="pickfiles" href="javascript:;">[Select files]</a> 
                            <a id="uploadfiles" href="javascript:;">[Upload files]</a>
                        </div>

                        <br />
                        <pre style="background: none; border: none" id="console"></pre>
                        <!-- <div class="col-sm-6">
                        <?php echo e(Form::label('Upload Video')); ?>

                        <?php echo e(Form::file('video', null, array('class' => 'form-control', 'placeholder' => 'Upload Your Video'))); ?> 
                        </div> -->
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                        <?php echo e(Form::label('Title')); ?>

                        <?php echo e(Form::text('title', null, array('class' => 'form-control', 'placeholder' => 'Enter Title'))); ?> 
                        </div>
                        <div class="col-sm-6">
                        <?php echo e(Form::label('Meta Title')); ?>

                        <?php echo e(Form::text('meta_title', null, array('class' => 'form-control', 'placeholder' => 'Enter Meta Title'))); ?>                                     
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-sm-6">
                        <?php echo e(Form::label('Description')); ?>

                        <?php echo e(Form::textarea('description', null, array('class' => 'form-control', 'placeholder' => 'Enter Description', 'size' => '30x5'))); ?>

                        </div>
                        <div class="col-sm-6">
                        <?php echo e(Form::label('Full Description')); ?>

                        <?php echo e(Form::textarea('full_description', null, array('class' => 'form-control', 'placeholder' => 'Enter Full Description', 'size' => '30x5'))); ?>                                       
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-sm-6">
                        <?php echo e(Form::label('CopyRight')); ?>

                        <?php echo e(Form::text('copyright', null, array('class' => 'form-control', 'placeholder' => 'Enter Copy Right'))); ?>                                     
                        </div>
                        <div class="col-sm-6">
                        <?php echo e(Form::label('Author ')); ?>

                        <?php echo e(Form::text('author', null, array('class' => 'form-control', 'placeholder' => 'Enter Author Name'))); ?>

                    </div>
                </div> 
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
    <!-- END: Modal -->
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.video', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>