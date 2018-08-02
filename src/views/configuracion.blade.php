@extends('codinstagram.codinstagram')
@section('content')
    <div class="ui grid center ">
        <div class="sixteen wide column">
            <div class="ui grid center ">
                <div class="eight wide column ">
                    <a href="{{URL::current()}}"><i class="redo icon"></i></a>
                    <h5>Configure su cliente con los siguientes pasos en el siguiete link <a target="_blank" href="https://www.instagram.com/developer/register/">Configurar</a></h5>
                    <h4 class="ui header">1. Actualice en el redirect uri de instagram a: </h4>
                    <span>{{URL::current()}}</span>
                    <h4 class="ui header">2. Desactivar las autenticaciones Aouth en la misma pagina.</h4>
                    <h4 class="ui header">3. Actualice el cliente .</h4>
                </div>
                <div class="eight wide column ">
                    <img src="https://codwelt.com/storage/paquetes/codinstagram/link.PNG" alt="ejemplo">
                </div>
            </div>
            @if($config != null)
                @for($a = 0; $a < count($config); $a++)
                    @if(isset($config[0]['profile_picture']))
                        <h2 class="ui header">
                            <img src="{{$config[$a]['profile_picture']}}" class="ui circular image">
                            {{$config[$a]['full_name']}} - <i>{{'@'.$config[$a]['username']}}</i><br><a class="header" target="_blank" href="{{$config[$a]['website']}}">{{$config[$a]['website']}}</a>
                        </h2>
                    @endif
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
    </div>
@endsection
