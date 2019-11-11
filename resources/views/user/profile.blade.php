@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="User__profile row">
            <div class="col-md-4">
              @if($user->image)
                  <img height="300" src="{{ route('user.avatar' , ['filename' => $user->image ]) }}" alt="Avatar">
              @endif
            </div>
            <div class="col-md-8">
              <h3> {{'@' . $user->nick}} </h3>
              <h2> {{$user->name . ' ' . $user->surname}} </h2>
              <p> {{ 'Se unio ' .\FormatTime::LongTimeFilter($user->created_at) }} </p>
            </div>
          </div>
            @include('includes.flash')
      
            @foreach($user->images as $image)
              @include('includes.image', ['image' => $image])
            @endforeach
    </div>
   
	</div>
</div>
@endsection
