@extends('frontend.layouts.basic')

@section('content')
<article id="photo">
	<a href="{{ route('index') }}"><img src="{{ asset('icons/back.svg') }}" title="Go back" width="30" /></a>
	<img src="{{ asset($photo->getMedia('images')->first()->getUrl('large')) }}" alt="Photo-{{ $photo->id }}" width="1800" class="photo" />
</article>
@endsection