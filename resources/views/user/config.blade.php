@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            @include('includes.messages')
            
            <div class="card">
                <div class="card-header">Configuración de mi cuenta</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{ Auth::user()->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="subname" class="col-md-4 col-form-label text-md-end">{{ __('Subname') }}</label>

                            <div class="col-md-6">
                                <input id="subname" type="text" class="form-control {{ $errors->has('subname') ? 'is-invalid' : '' }}" name="subname" value="{{ Auth::user()->subname }}" required autocomplete="name" autofocus>

                                @error('subname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="nickname" class="col-md-4 col-form-label text-md-end">{{ __('Nickname') }}</label>

                            <div class="col-md-6">
                                <input id="nickname" type="text" class="form-control {{ $errors->has('nickname') ? 'is-invalid' : '' }}" name="nickname" value="{{ Auth::user()->nickname }}" required autocomplete="name" autofocus>

                                @error('nickname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ Auth::user()->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                      
                        <div class="row mb-3">
                            <label for="image_path" class="col-md-4 col-form-label text-md-end">{{ __('Avatar') }}</label>

                            <div class="col-md-6">
                                @include('includes.avatar')
                                <input id="image_path" type="file" class="form-control {{ $errors->has('image_path') ? 'is-invalid' : '' }}" name="image_path">

                                @error('image_path')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Guardar cambios
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
