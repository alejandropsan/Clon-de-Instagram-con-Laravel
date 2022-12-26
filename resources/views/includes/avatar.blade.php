@if(Auth::user()->image)
<div class='container-avatar'>    
    <img src="{{ route('avatar', ['filename' => Auth::user()->image]) }}" class="avatar">
</div>    
@endif