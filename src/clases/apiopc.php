<?php
namespace  Codwelt\codinstagram\clases;

use Codwelt\codinstagram\model\Codinstagrammodelconfig;
use Codwelt\codinstagram\clases\tools;
use Codwelt\codinstagram\clases\format;
use Codwelt\codinstagram\providers\CodinstagramServiceProviders;

class apiopc
{
    public $tools;
    public $format;
    protected $first;

    /**
     * apiopc constructor.
     */
    public function __construct()
    {
        new CodinstagramServiceProviders();
        $this->tools = new tools();
        $this->format = new format();

    }

    /**
     * @param $id
     * @param $username
     * @param $profilepicture
     * @param $fullname
     * @param $bio
     * @param $website
     * @param $bussisnes
     */
    public function ActualizarDatosUsuario($id, $username, $profilepicture, $fullname, $bio, $website, $bussisnes, $ClientID)
    {
        Codinstagrammodelconfig::where('ClientID', $ClientID)
            ->update([
                'idinstagram' => $id,
                'username' => $username,
                'profile_picture' => $profilepicture,
                'full_name' => $fullname,
                'bio' => $bio,
                'website' => $website,
                'is_business' => $bussisnes
            ]);
    }


    public function ActualizarDatoscounts($token, $ClientID)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.instagram.com/v1/users/self/?access_token=" . $token);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        $res = json_decode($result);
        Codinstagrammodelconfig::where('ClientID', $ClientID)
            ->update([
                'media' => $res->data->counts->media,
                'follows' => $res->data->counts->follows,
                'followed_by' => $res->data->counts->followed_by,
            ]);
    }

    public function ObtenerMedia($token)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.instagram.com/v1/users/self/media/recent/?access_token=" . $token);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return $this->format->FormatMedia(json_decode($result));
    }

    public function ObtenerComentarios($id, $token)
    {
        dd($token);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.instagram.com/v1/media/" . $id . "/comments?access_token=" . $token);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return $this->format->FormatComments(json_decode($result));
    }

}
