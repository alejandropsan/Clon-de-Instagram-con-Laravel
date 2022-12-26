@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            @include('includes.messages')


            <div class="card pub_image pub_image_detail">
                <div class="card-header">
                    @if($image->user->image)
                    <div class='container-avatar'>    
                        <img src="{{ route('avatar', ['filename' => $image->user->image]) }}" class="avatar">
                    </div>
                    @endif
                    <div class="data-user">
                        {{ $image->user->name.' '.$image->user->subname }}
                        <span class="nickname">
                            {{ ' | @'.$image->user->nickname }}
                        </span>
                    </div>
                </div>    
                <div class="card-body">
                    <div class="image-container image-detail">
                        <img src='{{ route('image.file', ['filename' => $image->image_path]) }}' />
                    </div>

                    <div class="likes">

                        <!-- Comprobar si el usuario le ha dado like a la publicación -->
                        <?php $user_like = false; ?>
                        @foreach($image->likes as $like)
                        @if($like->user->id == Auth::user()->id)
                        <?php $user_like = true; ?>
                        @endif
                        @endforeach

                        @if($user_like)
                        <img src="{{ asset('img/heart-red.png') }}" data-id='{{$image->id}}' class="btn-dislike"/>
                        @else
                        <img src="{{ asset('img/heart-gray.png') }}" data-id='{{$image->id}}' class="btn-like"/> 
                        @endif

                        <span class="number-likes">{{ count($image->likes) }}</span>
                    </div>

                    @if(Auth::user() && Auth::user()->id == $image->user_id)
                    <div class='actions'>
<!--                        <a href="{{ route('image.delete', ['id' => $image->id]) }}" class="btn btn-danger btn-sm">Borrar</a>-->
                        <a href="{{ route('image.edit', ['id' => $image->id]) }}" class="btn btn-primary btn-sm">Actualizar</a>

                        <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal">
                            Eliminar
                        </button>

                        <!-- The Modal -->
                        <div class="modal" id="myModal">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">¿Estás seguro?</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        Si eliminas esta publicación desaparecerá definitivamente.  
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                                        <a href="{{ route('image.delete', ['id' => $image->id]) }}" class="btn btn-danger">Borrar definitivamente</a
                                    </div>

                                </div>
                            </div>
                        </div>  

                    </div>
                    @endif
                    <div class="description">
                        <span class="nickname">{{'@'.$image->user->nickname}}</span>
                        <span class="nickname date">{{ '| '.FormatTime::LongTimeFilter($image->created_at) }}</span>
                        <p>{{ $image->description }}</p>
                    </div>
                    <div class="clearfix"></div>
                    <div class="comments">

                        <h2>Comentarios ({{ count($image->comments) }})</h2>
                        <hr/>

                        <form action="{{ route('comment.save') }}" method="POST">
                            @csrf

                            <input type="hidden" name="image_id" value="{{ $image->id }}" />
                            <p>
                                <textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content"></textarea>
                                @if($errors->has('content'))
                                <span class="invalid-feedback" role='alert'>
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                                @endif
                            </p>

                            <input type="submit" class="btn btn-success" />
                        </form>

                        <hr/>
                        @foreach($image->comments as $comment)
                        <div class="comment">

                            <span class="nickname">{{'@'.$comment->user->nickname}}</span>
                            <span class="nickname date">{{ '| '.FormatTime::LongTimeFilter($comment->created_at) }}</span>
                            <p>{{ $comment->content }}<br/>

                                @if(Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
                                <a href="{{ route('comment.delete', ['id' => $comment->id]) }}" class="btn btn-sm btn-danger">
                                    Eliminar
                                </a>
                                @endif
                            </p>
                        </div>

                        @endforeach    

                    </div>

                </div>
            </div>        

        </div>

    </div>
</div>    
@endsection
