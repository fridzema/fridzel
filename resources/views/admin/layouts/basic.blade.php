<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fridzel </title>
    <link href="{{ cdn('css/admin.css') }}" rel="stylesheet">
    @yield('stylesheets')
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>

		@yield('content')

		@if(Auth::user())
		  <a class="logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
		    Logout
		  </a>
			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				{{ csrf_field() }}
			</form>
		@endif
    <script src="{{cdn('js/admin.js')}}"></script>
    <script type="text/javascript">Dropzone.autoDiscover = false;</script>
</body>
</html>
