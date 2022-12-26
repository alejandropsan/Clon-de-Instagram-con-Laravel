<div class="card pub_image">
    <div class="card-header">
        @if($image->user->image)
        <div class='container-avatar'>    
            <img src="{{ route('avatar', ['filename' => $image->user->image]) }}" class="avatar">
        </div>
        @endif

        <div class="data-user">
            <a href="{{ route('profile', ["id" => $image->user->id]) }}">
                {{ $image->user->name.' '.$image->user->subname }}
                <span class="nickname">
                    {{ ' | @'.$image->user->nickname }}
                </span>
            </a>
        </div>
    </div>    
    <div class="card-body">
        <div class="image-container">
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
        <div class="description">
            <span class="nickname">{{'@'.$image->user->nickname}}</span>
            <span class="nickname date">{{ '| '.FormatTime::LongTimeFilter($image->created_at) }}</span>
            <p>{{ $image->description }}</p>

        </div>
        <div class='comments'>
            <a href="{{ route('image.detail', ["id" => $image->id]) }}" class="btn btn-sm btn-warning btn-comments">
                Comentarios ({{ count($image->comments) }})
            </a>
        </div>
    </div>
</div> 