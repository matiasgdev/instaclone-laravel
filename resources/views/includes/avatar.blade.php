@if(Auth::user()->image)
  <div class="text-center">
    <img class="avatar" src="{{ route('user.avatar' , ['filename' => Auth::user()->image ]) }}" alt="Avatar">
  </div>
@endif