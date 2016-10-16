<!doctype html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0,maximum-scale=1, user-scalable=no">
	<title>登录</title>
	
	<link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('/')); ?>login/css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('/')); ?>login/css/default.css">
	<link rel='stylesheet prefetch' href='http://fonts.useso.com/css?family=Open+Sans'>
	<link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('/')); ?>login/css/styles.css">
	
</head>
<body>
<div class="cont">
  <div class="demo">
    <div class="login">
      <div class="login__check"></div>
      <div class="login__form">
        <div class="login__row">
          <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
            <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
          </svg>
          <input type="text" name="user_name" class="login__input name" placeholder="Username"/>
        </div>
        <div class="login__row">
          <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
            <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
          </svg>
          <input type="password" name="password" class="login__input pass" placeholder="Password"/>
        </div>
        <button type="button" class="login__submit">登 录</button>
        <p class="login__signup">还没有账号? &nbsp;<a href="javascript:;" class="register">立刻注册</a></p>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="<?php echo e(URL::asset('/')); ?>js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="<?php echo e(URL::asset('/')); ?>js/three.min.js"></script>
<script src='<?php echo e(URL::asset('/')); ?>login/js/stopExecutionOnTimeout.js?t=1'></script>
<script src="<?php echo e(URL::asset('/')); ?>js/plugins/layer/layer.min.js"></script>
<script>
$(function(){
	var animating = false, submitPhase1 = 1100, submitPhase2 = 400, logoutPhase1 = 800, $login = $('.login'), $app = $('.app');
    function ripple(elem, e) {
        $('.ripple').remove();
        var elTop = elem.offset().top, elLeft = elem.offset().left, x = e.pageX - elLeft, y = e.pageY - elTop;
        var $ripple = $('<div class=\'ripple\'></div>');
        $ripple.css({
            top: y,
            left: x
        });
        elem.append($ripple);
    }
    $(document).on('click', '.register', function(){
    	layer.msg('玩蛋去吧');
    })
    $(document).on('click', '.login__submit', function (e) {
    	var that = $(this);
    	var user_name = $('input[name=user_name]').val();
    	var password = $('input[name=password]').val();
        if (animating)
            return;

        if (user_name == false) {
        	layer.msg('请输入用户名',{shift: 4});
        	return false;
        }
        if (password == false) {
        	layer.msg('请输入密码',{shift: 4});
        	return false;
        }
        $.ajax({
			url: "<?php echo e(URL::route('authAuthPostLogin')); ?>", 
			data: {'user_name':$('input[name=user_name]').val(), 'password':$('input[name=password]').val()},
			type: "POST", 
			timeout: 30000,
			headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
			async:true,
			cache:false,
			beforeSend:function(){
				animating = true;
		        ripple(that, e);
		        that.addClass('processing');
			},
			success: function (rs) { 
				if (rs.result !== true) {
					layer.msg(rs.message,{shift: 4});
					return false;
				} else {
					location.href = "<?php echo e(URL::route('homeIndex')); ?>";
				}
				
			},
			complete:function() {
				animating = false;
				that.removeClass('processing');
			},
			error: function () {
				layer.msg("请求错误，请稍后重试", {time: 3000, icon:5});
			}		
		});
    });
})
</script>
</body>
</html>