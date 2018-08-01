@extends('codinstagram.codinstagram')
@section('content')
    @if(isset($media))
        <div class="ui center grid" style="padding: 2%;">
            <div class="sixteen wide column center">
                <h2 class="ui header">
                    <img src="{{$user['profile_picture']}}" class="ui circular image">
                    <a class="header" href="{{$user['website']}}">{{$user['full_name']}}</a>
                </h2>
            </div>
            @for($a = 0; $a < count($media); $a++)
                <div class="four wide column imagencard mostrar" id="{{$media[$a]['id']}}"
                     style="background-image: url({{$media[$a]['img']['standard_resolution']['url']}}); background-size: cover;">
                </div>
                <div class="ui tiny modal" id="m{{$media[$a]['id']}}">
                    <i class="close icon"></i>
                    <div class="header">
                        <img src="">
                        <img class="ui avatar image" src="{{$media[$a]['user']['img']}}">
                        <span>{{$media[$a]['user']['username']}}</span>
                    </div>
                    <div class="image content">
                        <div class="ui Huge image">
                            <img class="ui Huge image" src="{{$media[$a]['img']['standard_resolution']['url']}}">
                        </div>
                        <div class="description">
                            <div class="ui header">{{$media[$a]['user']['full_name']}}</div>
                            <p>{{$media[$a]['descripcion']['texto']}}</p>
                            <div class="ui four column grid">
                                <div class="two column row">
                                    <div class="column"><i class="heart icon"></i> {{$media[$a]['likes']}}</div>
                                    <div class="column"><i class="comment icon"></i> {{$media[$a]['coments']}}</div>
                                </div>
                            </div>
                            <p>{{$media[$a]['fecha']}}</p>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    @endif
    <script>
        $('.mostrar').click(function () {
            let id = $(this).attr('id');
            $('#m' + id).modal('show');
            console.log(id);
            $.ajax({
                url: "/codinstagram/obtener/comentarios/" + id,
                data: "",
                method: "get",
                success: function (result) {
                    //console.log(result);
                    loader.classList.remove("active");
                },
                error: function (result) {
                    // console.log(result);
                    loader.classList.remove("active");
                },
                beforeSend: function () {
                    loader.className += " active";
                }
            });
        });

    </script>
@endsection