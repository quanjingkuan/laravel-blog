<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>@yield('title')</title>
@yield('meta')
@yield('style')
<!--[if lt IE 9]>
<script src="js/modernizr.js"></script>
<![endif]-->
</head>
<body style="background-color: #fff;">
@yield('content')
<script src="{{ asset('js/silder.js') }}"></script>
</body>
</html>
	