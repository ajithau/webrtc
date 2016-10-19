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

<?php $__env->startSection('title', 'Main page'); ?>

<?php $__env->startSection('content'); ?>
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
                        <div class="modal inmodal" id="add-user" tabindex="-1" role="dialog"  aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated fadeIn">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <span class="pull-left"><strong>Add:</strong> <!-- [First Name] [Last Name] --></span>
                                    </div>
                                    <div class="modal-body">
									<?php echo Form::open(array('url' => 'users/createAdmin')); ?>

	                                	<div class="row">
	                                		<div class="col-sm-6">
	                                		<?php echo e(Form::label('First Name')); ?>

	                                		<?php echo e(Form::text('first_name', '', array('class' => 'form-control', 'placeholder' => 'Enter First Name'))); ?> 
	                                		</div>
	                                		<div class="col-sm-6">
	                                		<?php echo e(Form::label('Last Name')); ?>

	                                		<?php echo e(Form::text('last_name', '', array('class' => 'form-control', 'placeholder' => 'Enter Last Name'))); ?>                                		
	                                		</div>
	                                	</div> 
	                                	<div class="row">
	                                		<div class="col-sm-6">
	                                		<?php echo e(Form::label('User Name')); ?>

	                                		<?php echo e(Form::text('name', '', array('class' => 'form-control', 'placeholder' => 'Enter User Name'))); ?>

	                                		</div>
	                                		<div class="col-sm-6">
	                                		<?php echo e(Form::label('Password')); ?>

	                                		<?php echo e(Form::password('password', array('class' => 'form-control', 'placeholder' => 'Enter Password'))); ?>                                		</div>
	                                	</div> 
	                                	<div class="row">
	                                		<div class="col-sm-6">
	                                		<?php echo e(Form::label('Email Address')); ?>

	                                		<?php echo e(Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'Enter Email Address'))); ?>                                		
	                                		</div>
	                                		<div class="col-sm-6">
	                                		<?php echo e(Form::label('Mobile Number')); ?>

	                                		<?php echo e(Form::text('mobile', '', array('class' => 'form-control', 'placeholder' => 'Enter Mobile Number'))); ?>

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
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                    <tr>
						<td><?php echo e($user->name); ?></td>
						<td><?php echo e($user->name); ?></td>
						<td><?php echo e($user->first_name); ?></td>
						<td><?php echo e($user->last_name); ?></td>
						<td>******</td>
						<td><?php echo e($user->email); ?></td>
						<td><?php echo e($user->mobile); ?></td>
						<td> </td>
						<td><?php echo e($user->notification); ?></td>
						<td><?php echo e($user->created_at); ?></td>
						<td><?php echo e($user->updated_at); ?></td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>            
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>