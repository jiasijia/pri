<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', '主页')</title>
    <link rel="shortcut icon" href="favicon.ico"> 
    <link type="text/css" rel="stylesheet" href="{{ URL::asset('/') }}css/bootstrap.min.css">
@section('css')
@show
</head>

<body class="gray-bg">
@section('contents')
@show
<script type="text/javascript" src="http://cdn.bootcss.com/jquery/3.1.0/jquery.js"></script>
<script type="text/javascript" src="{{ URL::asset('/') }}js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('/') }}js/fabric.js"></script>
<script type="text/javascript" src="{{ URL::asset('/') }}js/stas.min.js"></script>
<script>
$(function () {

})
</script>
@section('js')
@show
</body>
</html>