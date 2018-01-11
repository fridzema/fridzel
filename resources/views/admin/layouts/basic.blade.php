<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fridzel </title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.css" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    @yield('stylesheets')
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
		<div class="ui secondary pointing menu">
		  <a class="active item" href="{{ route('photos.index') }}">
		    <i class="icon picture"></i> Photos
		  </a>
		  <a class="item" href="{{ route('blog_posts.index') }}">
		    <i class="write square icon"></i> Blog
		  </a>
		  <a class="item" >
		    <i class="icon settings"></i> Settings
		  </a>
		  <div class="right menu">
		    <a class="ui item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
		      <i class="sign out icon"></i>
		    </a>
				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					{{ csrf_field() }}
				</form>
		  </div>
		</div>

		<div class="ui segment">
			@yield('content')
		</div>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.js"></script>
	@yield('scripts')
</body>
</html>
