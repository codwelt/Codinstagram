<?php

namespace Codwelt\codinstagram\clases;

use Codwelt\codinstagram\model\Codinstagrammodelconfig;
use Codwelt\codinstagram\clases\tools;
use Codwelt\codinstagram\clases\apiopc;

class conexion
{
    public $tools;
    public $apiopc;
    public $inthemoment;

    public function __construct()
    {
        $this->tools = new tools();
        $this->apiopc = new apiopc();
        $this->inthemoment = $this->tools->forceToArray(Codinstagrammodelconfig::where('use', 'u')->get());
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
        if (isset($res->error_type)) {
            return $res->error_message;
        } elseif (isset($res->access_token)) {
            self::ActualizarToken($res->access_token);
            $this->apiopc->ActualizarDatosUsuario($res->user->id, $res->user->username, $res->user->profile_picture, $res->user->full_name, $res->user->bio, $res->user->website, $res->user->is_business, $ClientID);
            $this->apiopc->ActualizarDatoscounts($res->access_token, $ClientID);
            return true;
        } else {
            return redirect('/Errores/No sabemos que paso');
        }
    }

    public function TestToken($token)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.instagram.com/v1/users/self/?access_token=" . $token);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($ch));
        curl_close($ch);
        if (isset($result->meta->error_message)) {
            return $result->meta->error_message;
        } else {
            if ($result->data->id == $this->inthemoment[0]['idinstagram']) {
                return true;
            } else {
                return false;
            }
        }

    }

    public function ActualizarToken($token)
    {
        Codinstagrammodelconfig::where('flag', "f")
            ->update([
                'token' => $token,
                'use' => 'u'
            ]);
    }
}
