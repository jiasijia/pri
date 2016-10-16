<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <title><?php echo $__env->yieldContent('title', '主页'); ?></title>
    <link rel="shortcut icon" href="favicon.ico"> 
    <link type="text/css" rel="stylesheet" href="<?php echo e(URL::asset('/')); ?>css/bootstrap.min.css">
<?php $__env->startSection('css'); ?>
<?php echo $__env->yieldSection(); ?>
</head>

<body class="gray-bg">
<?php $__env->startSection('contents'); ?>
<?php echo $__env->yieldSection(); ?>
<script type="text/javascript" src="http://cdn.bootcss.com/jquery/3.1.0/jquery.js"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('/')); ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('/')); ?>js/fabric.js"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('/')); ?>js/stas.min.js"></script>
<script>
$(function () {

})
</script>
<?php $__env->startSection('js'); ?>
<?php echo $__env->yieldSection(); ?>
</body>
</html>