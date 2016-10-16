<link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset('/')); ?>css/home/index/index.css">
<?php $__env->startSection('contents'); ?>
<canvas id="c"></canvas>
<?php $__env->stopSection(); ?>
首页
<?php $__env->startSection('js'); ?>
<script>

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>