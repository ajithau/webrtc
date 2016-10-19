<?php $__env->startSection('content'); ?>
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <h2 class="login-logo-name">META</h2>
            </div>
            <form class="m-t" role="form" method="POST" action="<?php echo e(url('/login')); ?>">
                        <?php echo e(csrf_field()); ?>

                    <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                    <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="<?php echo e(old('email')); ?>" required autofocus>

                    <?php if($errors->has('email')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                    <input id="password" type="password" class="form-control" placeholder="Password" name="password" required>

                    <?php if($errors->has('password')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                
            </form>
            <p class="m-t"> <small><strong>Copyright</strong> © 1994-2016 <a href="http://www.metamorphosis.tv">Metamorphosis</a> <br />(A Division of Davvydave Ltd.)</small> </p>    
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>