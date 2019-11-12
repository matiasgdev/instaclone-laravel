@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 p-0">
      <h3 class="m-0 py-4 text-secondary" >Explorar la comunidad</h3>
      <form id="searcher" class="search__form mb-3">
        @include('includes.form')
      </form>

      @if (count($users) == 0)
        <p>No hay resultado para ese criterio de búsqueda</p>
      @endif

      @foreach($users as $user)
        
      <div class="User__profile row">
        <div class="col-md-4">
          @if($user->image)
              <img height="300" src="{{ route('user.avatar' , ['filename' => $user->image ]) }}" alt="Avatar">
          @endif
        </div>
        <div class="col-md-8">
          <h2> {{$user->name . ' ' . $user->surname}} </h2>
          <h3> {{'@' . $user->nick}} </h3>
          <p> {{ 'Se unio ' .\FormatTime::LongTimeFilter($user->created_at) }} </p>
        <a class="btn btn-success text-light" href="{{route('user.profile', ['id' => $user->id])}}"> Ver perfil </a>
        </div>
      </div>

			@endforeach

		<div class="Post__pagination">
				{{ $users->links() }}
    </div>
		</div>


	</div>
</div>
@endsection
