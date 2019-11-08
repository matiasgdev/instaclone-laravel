@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-7">
			@include('includes.flash')

			@foreach($images as $image)
				@include('includes.image', ['image' => $image])
			@endforeach
			
		<div class="Post__pagination">
				{{ $images->links() }}
			</div>
		</div>


	</div>
</div>
@endsection
