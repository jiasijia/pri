<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <title><?php echo $__env->yieldContent('title', '管理后台'); ?></title>
    <link rel="shortcut icon" href="favicon.ico"> 
    <link href="<?php echo e(URL::asset('/')); ?>css/bootstrap.min14ed.css?v=3.3.6" rel="stylesheet">
    <link href="<?php echo e(URL::asset('/')); ?>css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="<?php echo e(URL::asset('/')); ?>css/animate.min.css" rel="stylesheet">
    <link href="<?php echo e(URL::asset('/')); ?>css/style.min862f.css?v=4.1.0" rel="stylesheet">
    <link href="<?php echo e(URL::asset('/')); ?>css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <link href="<?php echo e(URL::asset('/')); ?>css/plugins/iCheck/custom.css" rel="stylesheet">
<?php $__env->startSection('css'); ?>
<?php echo $__env->yieldSection(); ?>
</head>

<body class="gray-bg">
<?php $__env->startSection('contents'); ?>
<?php echo $__env->yieldSection(); ?>
<script src="<?php echo e(URL::asset('/')); ?>js/jquery.min63b9.js?v=2.1.4"></script>
<script src="<?php echo e(URL::asset('/')); ?>js/bootstrap.min14ed.js?v=3.3.6"></script>
<script src="<?php echo e(URL::asset('/')); ?>js/plugins/layer/layer.min.js"></script>
<script src="<?php echo e(URL::asset('/')); ?>js/plugins/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo e(URL::asset('/')); ?>js/plugins/webuploader/webuploader.min.js"></script>
<script src="<?php echo e(URL::asset('/')); ?>js/demo/webuploader-single.js"></script>
<script src="<?php echo e(URL::asset('/')); ?>js/content.min.js?v=1.0.0"></script>
<script src="<?php echo e(URL::asset('/')); ?>js/plugins/iCheck/icheck.min.js"></script>
<script>

</script>
<?php $__env->startSection('js'); ?>
<?php echo $__env->yieldSection(); ?>
</body>
</html>