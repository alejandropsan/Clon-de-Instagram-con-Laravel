@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class='card'>
                <div class="card-header">
                    Edita la publicación
                </div>

                <div class="card-body">
                    <form method='POST' action="{{ route('image.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="image_id" value="{{ $image->id }}" />
                        <div class="form-group row">
                            <label for="image_path" class="col-md-2 col-form-label text-md-right">Imagen</label>
                            <div class="col-md-8">
                                @if($image->user->image)
                                    <div class='container-avatar'>    
                                        <img src='{{ route('image.file', ['filename' => $image->image_path]) }}' class="avatar" />
                                    </div>
                                @endif
                                <input id="image_path" type="file" name="image_path" class="form-control {{ $errors->has('image_path') ? 'is-invalid' : '' }}"/>
                            @if($errors->has('iamge_path'))
                            <span class="invalid-feedback" role='alert'>
                                <strong>{{ $errors->first('image_path') }}</strong>
                            </span>
                            @endif
                            </div>
                        </div>
                        <br/>
                        <div class="form-group row">
                            <label for="description" class="col-md-2 col-form-label text-md-right">Descripción</label>
                            <div class="col-md-8">
                                <textarea id="description" name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ $image->description }}</textarea>
                            @if($errors->has('description'))
                            <span class="invalid-feedback" role='alert'>
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
                            </div>
                        </div>
                        <br/>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <input type='submit' class="btn btn-primary" value="Actualizar publicación" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

