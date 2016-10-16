<?php $__env->startSection('contents'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript" src="<?php echo e(URL::asset('/')); ?>js/home/album/three.js"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('/')); ?>js/home/album/album.js"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('/')); ?>js/home/album/tween.min.js"></script>
<script>

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home.base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>