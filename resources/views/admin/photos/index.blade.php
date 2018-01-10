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
		<a data-model-id="{{ $photo->id }}" data-order-id="@if(!is_null($photo->id)){{ $photo->id }}@endif">
			<img src="{{ asset($photo->getMedia('images')->first()->getUrl('small')) }}" alt="Photo not found" title="{{$photo->filename}}" />
      <button class="btn drag-handle">
        <img src="{{asset('icons/move.svg')}}" width="20" height="20" />
      </button>
     <button type="submit" class="btn delete" onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
     	<img src="{{asset('icons/trash.svg')}}" width="20" height="20" />
     </button>
		<form id="delete-form" method="post" action="{{ route('photos.destroy', $photo->id) }}" style="display: none;">
			<input name="_method" type="hidden" value="DELETE" />
  		{{ csrf_field() }}
  	</form>
		</a>
	@endforeach
</div>
@endsection

@section('scripts')
	<script id="uploaded-photos" type="x-tmpl-mustache">
		@{{#photos}}
			@{{ photo.filename }}
		@{{/photos}}
	</script>
	<script src="{{asset('js/admin.js')}}"></script>
	<script type="text/javascript">Dropzone.autoDiscover = false;</script>
@endsection