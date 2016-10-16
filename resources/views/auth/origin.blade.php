<!doctype html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>登录</title>
	
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('/') }}css/default.css">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('/') }}css/styles.css">
	<link href="{{ URL::asset('/') }}css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
	
</head>
<body>
	<div class="LoR">
	</div>
	<div class='login'>
	  <div class='login_title'>
	    <span>账号登录</span>
	  </div>
	  <div class='login_fields'>
		<form class="m-t" action="{{ URL::route('authAuthPostLogin') }}" method="post" onsubmit="return false">
	    <div class='login_fields__user'>
	      <div class='icon'>
	        <img src='{{ URL::asset('/') }}img/user_icon_copy.png'>
	      </div>
	      <input placeholder='用户名' type='text' name="user_name">
	        <div class='validation'>
	          <img src='{{ URL::asset('/') }}img/tick.png'>
	        </div>
	      </input>
	    </div>
	    <div class='login_fields__password'>
	      <div class='icon'>
	        <img src='{{ URL::asset('/') }}img/lock_icon_copy.png'>
	      </div>
	      <input placeholder='密码' type='password' name="password">
	      <div class='validation'>
	        <img src='{{ URL::asset('/') }}img/tick.png'>
	      </div>
	    </div>
	    <div class='login_fields__submit'>
	      <input type='submit' value='登录'>
	      <div class='forgot'>
	        <a href='#'>忘记密码?</a>
	      </div>
	    </div>
		</form>
	  </div>
	  <div class='success'>
	    <h2>你他么的登陆成功了</h2>
	    <p>等待跳转</p>
	  </div>
	  <div class="success-img">
	  	<img src="{{ URL::asset('/') }}img/swal2.jpg">
	  </div>
	  <div class='disclaimer'>
	    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce semper laoreet placerat. Nullam semper auctor justo, rutrum posuere odio vulputate nec.</p>
	  </div>
	</div>
	<div class='authent'>
	  <img src='{{ URL::asset('/') }}img/puff.svg'>
	  <p>登录中...</p>
	</div>
	<script type="text/javascript" src="{{ URL::asset('/') }}js/three.min.js"></script>
	<script type="text/javascript" src='{{ URL::asset('/') }}js/stopExecutionOnTimeout.js?t=1'></script>
	<script type="text/javascript" src="{{ URL::asset('/') }}js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="{{ URL::asset('/') }}js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="{{ URL::asset('/') }}js/login.js"></script>
	<script src="{{ URL::asset('/') }}js/plugins/layer/layer.min.js"></script>
	<script src="{{ URL::asset('/') }}js/plugins/sweetalert/sweetalert.min.js"></script>
	<script>
	$(function(){
		
		$('input[type=submit]').click(function () {
			var self =$(this);
			$('.login').addClass('test');
			setTimeout(function () {
				$('.login').addClass('testtwo');
			}, 300);
			setTimeout(function () {
				$('.authent').show().animate({ right: -320 }, {
					easing: 'easeOutQuint',
					duration: 600,
					queue: false
				});
				$('.authent').animate({ opacity: 1 }, {
					duration: 200,
					queue: false
				}).addClass('visible');
			}, 500);
			
			setTimeout(function() {
				$.ajax({
					url: self.attr('action'), 
					data: {'user_name':$('input[name=user_name]').val(), 'password':$('input[name=password]').val()},
					type: "POST", 
					timeout: 30000,
					headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
					async:true,
					cache:false,
					success: function (rs) { 
						if (rs.result !== true) {
							var imgUrl = "{{ URL::asset('/') }}img/swal1.jpg";
							swal({
								imageUrl:imgUrl,
								title: "<h3>" + rs.message + "<h3>",
								imageSize: "120x120",
								showConfirmButton: false,
								allowOutsideClick: true,
								html:true,
							});
							$('.login div:not(.success,.success-img)').fadeIn(123);
							return false;
						} else {
							$('.login div').fadeOut(123);
							$('.success').fadeIn();
							$('.success-img').fadeIn();
							
							setTimeout(function(){
								location.href = "{{ URL::route('homeIndex') }}";
							}, 2000);
						}
						
					},
					complete:function() {
						setTimeout(function () {
							$('.authent').show().animate({ right: 90 }, {
								easing: 'easeOutQuint',
								duration: 600,
								queue: false
							});
							$('.authent').animate({ opacity: 0 }, {
								duration: 200,
								queue: false
							}).addClass('visible');
							$('.login').removeClass('testtwo');
						}, 0);
						setTimeout(function () {
							$('.login').removeClass('test');
						}, 0);
					},
					error: function () {
						layer.msg("请求错误，请稍后重试", {time: 3000, icon:5});
					}
				});
			}, 1000);
					
		});
	})
	</script>
</body>
</html>