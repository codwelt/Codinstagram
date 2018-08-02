<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Codinstagram</title>
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.css">
    <link rel="stylesheet" href="{{asset('/codinstagram/css/main.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/components/accordion.min.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/components/accordion.min.js"></script>
    <script src="{{asset('/codinstagram/js/main.js')}}"></script>
</head>
<body>
<section class="cuerpocodinstagram">
    <div class="sixteen wide column">
        <div class="ui pointing menu">
            <a class="item" href="/codinstagram/inicio">
                Inicio
            </a>
            <a class="item" href="/codinstagram/configuracion">
                Configurar
            </a>
        </div>
        <div class="ui segment">
            @yield('content')
        </div>
    </div>
</section>
<div class="ui dimmer" id="loader" style="position: fixed;">
    <div class="ui huge text loader">Loading</div>
</div>
</body>
</html>