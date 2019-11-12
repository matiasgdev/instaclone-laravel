@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
				
				<div class="card">

						<div class="card-header">
							Editar 
						</div>

						<div class="card-body">
							<form action=" {{ route('image.update') }} "  method="POST" enctype="multipart/form-data">
                @csrf
                
                <input type="hidden" name="image_id" value="{{$image->id}}">

								<div class="form-group row">
									<label class="col-md-3 col-form-label text-md-right" for="image_path"> Imagen </label>
									<div class="col-md-7">
										<input class="form-control-file  @error('image_path') is-invalid @enderror" type="file" id="image_path" name="image_path">
										
									@error('image_path')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
									@enderror
                  @if($image)
                    <img id="imageEdit" class="avatar" src="{{ route('image.file' , ['filename' => $image->image_path ]) }}" alt="{{$image->id}}">
                  @endif
									</div>
								</div>

								<div class="form-group row">
									<label class="col-md-3 col-form-label text-md-right" for="description"> Descripción </label>
									<div class="col-md-7">
                    <textarea class="form-control @error('description') is-invalid @enderror"  id="description" name="description" required>{{$image->description}}</textarea>
										
										@if($errors->has('description'))
											<span class="invalid-feedback" role="alert">
												<strong> {{ $errors->first('description') }} </strong>
											</span>
										@endif

									</div>
								</div>

								<div class="form-group row">
									<div class="col-md-7 offset-md-3">
										<input type="submit" class="btn btn-primary" value="Actualizar">
									</div>
								</div>

							</form>
						</div>

				</div>

      </div>
    </div>
  </div>
@endsection