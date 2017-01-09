<!DOCTYPE html>
<html>
<head>
	@include('includes.head')
</head>
<body>
	<header>
		@include('includes.header')
	</header>
		<content>
			@yield('content')
		</content>
	<footer>
		@include('includes.footer')
	</footer>
</body>
</html>