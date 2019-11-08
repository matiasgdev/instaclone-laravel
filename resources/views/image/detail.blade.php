@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-10">
			@include('includes.flash')

				<div class="card mb-4">
					<div class="card-header Post__header">
						@if($image->user->image)
						<div class="container-avatar">
								<img class="avatar" src="{{ route('user.avatar' , ['filename' => $image->user->image ]) }}" alt="Avatar">
						</div>
						@endif
						{{ $image->user->name . ' ' . $image->user->surname }}
						<span class="Post__date"> {{  \FormatTime::LongTimeFilter($image->created_at)}} </span>

					</div>

					<div class="card-body Post__body">

						<div class="Post__imageContainer Post__imageContainer--detail">
							<img src="{{ route('image.file', ['filename' => $image->image_path ]) }}" />
						</div>

						<div class="Post__info">

							<span class="Post__info--likes">

								{{-- Verify if user like image --}}
								@php  $user_like = false;  @endphp
								@foreach($image->likes as $like)
									@if ($like->user_id == Auth::user()->id)
										@php $user_like = true; @endphp
									@endif
								@endforeach
								{{-- ------------ --}}
								@if ($user_like)
								<div>
									<img class="dislike" width="20px" src="{{ asset('img/heart-red.png') }}" data-id="{{$image->id}}"  >
									<span id="counts-like" class="count-like" data-counts="{{count($image->likes)}}">
										{{count($image->likes)}} 
									</span>
								</div> 
								@else
									<img class="like" width="20px"src="{{asset('img/heart.png')}}" data-id="{{$image->id}}" > <span class="count-like"> {{count($image->likes)}} </span>  
								@endif
	
							</span>
							<span class="Post__info--user"> {{ '@'.$image->user->nick }} </span>
							<span class="Post__info--description text-muted">
								{{ $image->description }}
							</span>
							<br>
						</div>

						<div class="Post__comments">
							<h4> Comentarios </h4>
							@foreach($image->comments as $comment)
								<div class="Post__comments--all">
									<span class="Post__info--user user--comment"> 
										{{ $comment->user->nick }}
										<span class="Post__date">
											| {{  \FormatTime::LongTimeFilter($comment->created_at)}} 
										</span>
									</span>
									@if(Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id  == Auth::user()->id))
										<a class="Post__comments--delete" href="{{ route('comment.delete', ['id' => $comment->id]) }}"> x </a>
									@endif

									<br>
									<span class="Post__info--description text-muted">
										{{ $comment->content }}
									</span>

								</div>
								@endforeach
						</div>

						<div class="Post__form">
							<form action=" {{route('comment.save')}} " method="POST" >
								@csrf
								<input type="hidden" name="image_id" value="{{$image->id}}" >
								<textarea class="form-control" name="comment" id="comment"></textarea>

								@if($errors->has('comment'))
									<span class="Post__form--alert alert-danger alert" role="alert">
										<strong> {{ $errors->first('comment') }} </strong>
									</span>
								@endif
								<button class="btn btn-lg btn-info"> Post </button>
							</form>
						</div>
					</div>
				</div>

	</div>
</div>
@endsection