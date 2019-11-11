@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-7">

      <h3 class="m-0 py-4 text-secondary" >Mis imagenes favoritas</h3>
      
      @foreach ($likes as $like)

        @include('includes.image', ['image' => $like->images ])

      @endforeach
      
      <div class="Post__pagination">
				{{ $likes->links() }}
			</div>
  
		</div>


	</div>
</div>
@endsection

