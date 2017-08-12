@extends('admin.layouts.basic')

@section('content')
<section id="login">
	<img id="logo" src="{{ cdn('img/logo.svg') }}" alt="Logo Fridzel" title="Logo Fridzel" width="100" height="100" />
	<form action="{{ route('login') }}" method="POST" role="form">
	    {{ csrf_field() }}

	    <input autofocus="" class="form-control" id="email" name="email" required="" type="email"  placeholder="Email" value="{{ old('email') }}" />
	    <input id="password" name="password" required="" type="password" placeholder="Password" />
	    <button type="submit">Login</button>

	    @if ($errors->has('email') || $errors->has('password'))
	    	<a href="{{ route('password.request') }}">Forgot Your Password?</a>
	    @endif
	</form>
</section>
@endsection
