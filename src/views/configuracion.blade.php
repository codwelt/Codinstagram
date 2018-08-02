@extends('codinstagram.codinstagram')
@section('content')
    <div class="ui grid center ">
        <div class="fourteen wide column">
            <a href="{{URL::current()}}"><i class="redo icon"></i></a>
            <h4 class="ui header">Actualice en el redirect uri de instagram a: </h4>
            <span>{{URL::current()}}</span>
            <h4 class="ui dividing header">Configuración</h4>
            @if(Session::has('status'))
                {{Session::get('status')}}
            @endif
            @if($config != null)
                @for($a = 0; $a < count($config); $a++)
                    <form class="ui form" method="post" action="configuracion/actualizar">
                        @csrf
                        <div class="field">
                            <div class="four fields">
                                <div class="field">
                                    <label>Client id</label>
                                    <input name="ClientId" placeholder="Client Id" type="text"
                                           value="{{$config[$a]['ClientID']}}" id="ClientId" required>
                                </div>
                                <div class="field">
                                    <label>Client secret</label>
                                    <input name="ClientSecret" placeholder="ClientSecret" type="password"
                                           value="{{$config[$a]['ClientSecret']}}" id="ClientSecret" required>
                                </div>
                                <div class="field">
                                    <label>redirect url</label>
                                    <input name="RedirectUrl" placeholder="RedirectUrl" type="text"
                                           value="{{$config[$a]['RedirectUrl']}}" id="RedirectUrl" required>
                                </div>

                            </div>
                        </div>
                        <input type="submit" class="ui button" value="Configurar">
                        <a href="testeo" class="ui button">Testear credenciales</a>
                        @if($config != null)
                            <a href="/codinstagram/obtener/token/{{$config[$a]['ClientID']}}/{{base64_encode($config[$a]['RedirectUrl'])}}"
                               target="_blank" class="ui primary button">Conectar</a>
                            <a href="/codinstagram/Eliminar/{{$config[$a]['id']}}" class="ui red button">Borrar</a>
                        @endif
                    </form>
                    <br>
                @endfor

            @endif
            <button class="positive fluid ui button" id="Agregarnuevoperfil">Agregar nuevo perfil</button>
            <br><br>
            <div id="agregarcredenciales">

            </div>
        </div>

        <div class="two wide column">
            @if(isset($config[0]['profile_picture']))
                @for($a = 0; $a < count($config); $a++)
                    <div class="image">
                        <img src="{{$config[$a]['profile_picture']}}">
                    </div>
                    <div class="content">
                        <a class="header" href="{{$config[$a]['website']}}">{{$config[$a]['website']}}</a>
                        <div class="meta">
                            <span class="date">{{$config[$a]['full_name']}}</span>
                        </div>
                        <div class="description">
                            <div class="ui huge header">{{$config[$a]['username']}}</div>
                            {{$config[$a]['bio']}}
                        </div>
                    </div>
                @endfor
            @endif
        </div>
    </div>
@endsection
