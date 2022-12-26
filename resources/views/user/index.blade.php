@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-group">
                <h1>Perfiles</h1>
                <form action="{{ route('user.index') }}" method="GET" id='buscador'>
                    
                   <div class='row'>
                        <div class='form-group col'>
                            <input type="text" id="search" class="form-control" />
                        </div>
                        <div class='form-group col btn-search'>
                            <input type="submit" value="Buscar" class='btn btn-success' />
                        </div>
                   </div>    
                </form>
            </div>
            <hr/>
            @foreach($users as $user)

            <div class="profile-user">

                @if($user->image)
                <div class='container-avatar'>    
                    <img src="{{ route('avatar', ['filename' => $user->image]) }}" class="avatar">
                </div>
                @endif

                <div class="user-info">
                    <h2>{{'@'. $user->nickname }}</h2>
                    <h3>{{ $user->name. ' '.$user->subname }}</h3>
                    <p>{{ 'Se unió: '.FormatTime::LongTimeFilter($user->created_at) }}</p>
                    <a href="{{ route('profile', ['id' => $user->id]) }}" class="btn btn-success">Ver perfil</a>
                </div>

                <div class="clearfix"></div>
                <hr/>
            </div>
            @endforeach
            
            <!-- PAGINACION -->
            <div class="clearfix"></div>
            <div class="pagination">{{ $users->links() }}</div>
        </div>

    </div>
</div>    
@endsection
