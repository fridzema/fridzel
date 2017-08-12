@extends('admin.layouts.basic')

@section('stylesheets')
	<link href="{{ asset('css/dropzone.css') }}" rel="stylesheet">
@endsection

@section('content')
<form id="dropzone" class="dropzone">
  <div class="dz-message" data-dz-message><span>Upload</span></div>
</form>

<div id="photos">
	@foreach($photos as $photo)
		<a>
			<img src="{{ cdn($photo->getMedia('images')->first()->getUrl('small')) }}" alt="Photo not found" title="{{$photo->filename}}" />

			<form id="delete-form" method="post" action="{{ route('photos.destroy', $photo->id) }}" style="display: none;">
				<input name="_method" type="hidden" value="DELETE" />
    		{{ csrf_field() }}
    	</form>
     <button type="submit" class="delete" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">✖</button>
		</a>
	@endforeach
</div>
@endsection