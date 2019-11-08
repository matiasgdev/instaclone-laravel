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
    <div class="Post__imageContainer">
      <a href="{{route('image.detail', ['id' => $image->id])}}">
        <img src="{{ route('image.file', ['filename' => $image->image_path ]) }}" />
      </a>
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

      <div>
        <span class="Post__info--user"> {{ '@'.$image->user->nick }} </span>
        <span class="Post__info--description text-muted">
          {{ $image->description }}
        </span>
        <br>
        <span class="Post__info--viewComments">
          <a href="">Ver comentarios ({{ count($image->comments) }})  </a>
        </span>
      </div>


    </div>
  </div>
</div>