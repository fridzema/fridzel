<!DOCTYPE html>
<html>
    <head>
      <title>Robert Fridzema - Rotterdam</title>
      <link rel="shortcut icon" href="https://static.fridzema.com/favicon.ico" type="image/x-icon" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="Robert Fridzema, Photography Rotterdam">
      <meta name="keywords" content="robert, fridzema, rotterdam, photo, photograph, camera">
      {{-- Inlined CSS File --}}
      <style>{!! file_get_contents('css/app.css') !!}</style>
    </head>
    <body>
    	<h1>
    	@if(env('AUTHOR_EMAIL') || env('AUTHOR_NAME'))
    		<a href="@if(env('AUTHOR_EMAIL')) mailto:{{env('AUTHOR_EMAIL')}} @endif" rel="author">@if(env('AUTHOR_NAME')) {{env('AUTHOR_NAME')}} @endif</a>
    	@else
    		<a href="https://github.com/fridzema/fridzel" target="_blank" title="Fridzel on Github">Fridzel</a>
    	@endif
    	</h1>
      @yield('content')
      @if(env('ANALYTICS_ID'))
	      <script>
	          window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
	          ga('create','{{ env('ANALYTICS_ID') }}','auto');ga('send','pageview')
	      </script>
	      <script src="{{ cdn('js/analytics.js') }}" async defer></script>
      @endif
    </body>
</html>