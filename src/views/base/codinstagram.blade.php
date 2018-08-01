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
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="{{asset('/codinstagram/js/main.js')}}"></script>
</head>
<body>
<section class="cuerpocodinstagram">
    @include('flash::message')
    <div class="sixteen wide column">
        <div class="ui pointing menu">
            <a class="active item" href="/codinstagram/inicio">
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
<div class="ui dimmer" id="loader">
    <div class="ui huge text loader">Loading</div>
</div>
<script>
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
</body>
</html>