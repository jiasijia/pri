<?php $__env->startSection('contents'); ?>
<canvas id="c"></canvas>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript" src="<?php echo e(URL::asset('/')); ?>js/home/index/martrix.js"></script>
<script>

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>