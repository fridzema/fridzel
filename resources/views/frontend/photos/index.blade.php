@extends('frontend.layouts.basic')

@section('content')
	@foreach($photos as $photo)
		<article id="photos">
			<a href="{{route('photo.show', $photo->id)}}"><img src="{{ asset($photo->getMedia('images')->first()->getUrl('medium')) }}" alt="Photo-{{ $photo->id }}" width="600" /></a>
		</article>
	@endforeach
@endsection