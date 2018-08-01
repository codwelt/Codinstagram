<?php

namespace  Codwelt\codinstagram\clases;

use Codwelt\codinstagram\model\Codinstagrammodelconfig;
use Codwelt\codinstagram\clases\tools;
use Codwelt\codinstagram\clases\apiopc;

class conexion
{
    public $tools;
    public $apiopc;

    public function __construct()
    {
        $this->tools = new tools();
        $this->apiopc = new apiopc();

    }

    public function TestConexion($clientid, $redirecturi)
    {
        $ch = curl_init("https://api.instagram.com/oauth/authorize/?client_id=" . $clientid . "&redirect_uri=" . $redirecturi . "&response_type=code");
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function ObtenerToken($ClientID, $ClientSecret, $RedirectUrl, $code)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.instagram.com/oauth/access_token");
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "client_id=" . $ClientID . "&client_secret=" . $ClientSecret . "&grant_type=authorization_code&redirect_uri=" . $RedirectUrl . "&code=" . $code);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $remote = curl_exec($ch);
        curl_close($ch);
        $res = json_decode($remote);
        if (isset($res->access_token)) {
            self::ActualizarToken($res->access_token);
            $this->apiopc->ActualizarDatosUsuario($res->user->id, $res->user->username, $res->user->profile_picture, $res->user->full_name, $res->user->bio, $res->user->website, $res->user->is_business, $ClientID);
            $this->apiopc->ActualizarDatoscounts($res->access_token, $ClientID);
            return true;
        } else{
            return $res->error_message;
        }
    }

    public function ActualizarToken($token)
    {
        Codinstagrammodelconfig::where('flag', "f")
            ->update([
                'token' => $token
            ]);
    }
}
