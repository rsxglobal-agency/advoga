
<!DOCTYPE html>
<html>
<?php echo $__env->make('includes.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<body>
<!-- container section start -->
<section id="container" class="">

<?php echo $__env->make('includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('includes.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<section id="main-content">
<section class="wrapper">
<div class="container">

<?php echo $__env->yieldContent('content'); ?>

</div>


</section>
</section>

<?php echo $__env->make('includes.chat', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('includes.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</body>
</html>
