$(document).ready(function () {
    var loader = document.getElementById("loader");
    Obtenerdatos();

    function Obtenerdatos() {
        $.ajax({
            url: "/codinstagram/obtener/datos/",
            data: "",
            method: "get",
            success: function (result) {
                loader.classList.remove("active");
            },
            error: function (result) {
                loader.classList.remove("active");
            },
            beforeSend: function () {
                loader.className += " active";
            }
        });
    }

    let cont = 0;
    $("#Agregarnuevoperfil").click(function (e) {
        e.preventDefault();
        $('#agregarcredenciales').append('<div class="ui segment" id="s' + cont + '"><form class="ui form"><a href="#!" class="closecredencial" count="s' + cont + '" style="float: right; z-idex: 10000;">cerrar <i class="close icon closecredencial" ></i></a><div class="four fields"><div class="field"><label>Client id</label><input name="ClientId" placeholder="Client Id" type="text" id="ClientId' + cont + '" required> </div><div class="field"><label>Client secret</label><input name="ClientSecret" placeholder="ClientSecret" type="password" id="ClientSecret' + cont + '" required></div><div class="field"><label>redirect url</label><input name="RedirectUrl" placeholder="RedirectUrl" type="text" id="RedirectUrl' + cont + '" required></div></div><a href="#!" class="ui button agregarcredencial" id="'+cont+'">Configurar</a></form></div>');
        cont += 1;
        $(".closecredencial").click(function (e) {
            e.preventDefault();
            let segment = $(this).attr('count');
            $('#' + segment).remove();
        });
        $(".agregarcredencial").click(function(e){
            e.preventDefault();
            let form = $(this).attr('id');
            let clientid = $('#ClientId'+form).val();
            let clientsecret = btoa($('#ClientSecret'+form).val());
            let redirecturi = btoa($('#RedirectUrl'+form).val());
            console.log(clientid+" - "+clientsecret+" - "+redirecturi);
            $.ajax({
                url: "/codinstagram/configuracion/agregando/"+clientid+"/"+clientsecret+"/"+redirecturi,
                data: "",
                method: "get",
                success: function (result) {
                    $('#s' + form).remove();
                    loader.classList.remove("active");
                },
                error: function (result) {
                    console.log(result);
                    loader.classList.remove("active");
                },
                beforeSend: function () {
                    loader.className += " active";
                }
            });
        });
    });


});