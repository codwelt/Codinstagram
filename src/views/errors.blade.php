@extends('codinstagram.codinstagram')
@section('content')
    <div class="ui grid center ">
        <div class="fourteen wide column">
            <h1><i class="exclamation circle icon"></i> Errores</h1>
            @if($error)
                <h3>{{$error}}</h3>
            @endif
        </div>
    </div>
@endsection
