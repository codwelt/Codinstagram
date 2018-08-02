<?php
/**
 * Created by PhpStorm.
 * User: heros
 * Date: 30/07/2018
 * Time: 9:03 PM
 */

namespace Codwelt\codinstagram\clases;

use Carbon\Carbon;

class format
{

    public function FormatMedia($data)
    {

        $response = [];
        if (isset($data)) {
            for ($a = 0; $a < count($data->data); $a++) {
                $dt = Carbon::now();
                $dt->timestamp = $data->data[$a]->created_time;
                $response[$a] = [
                    'id' => $data->data[$a]->id,
                    'fecha' => $dt->diffForHumans(),
                    'img' => [
                        'thumbnail' => [
                            'url' => $data->data[$a]->images->thumbnail->url,
                            'width' => $data->data[$a]->images->thumbnail->width,
                            'height' => $data->data[$a]->images->thumbnail->height,
                        ],
                        'low_resolution' => [
                            'url' => $data->data[$a]->images->low_resolution->url,
                            'width' => $data->data[$a]->images->low_resolution->width,
                            'height' => $data->data[$a]->images->low_resolution->height,
                        ],
                        'standard_resolution' => [
                            'url' => $data->data[$a]->images->standard_resolution->url,
                            'width' => $data->data[$a]->images->standard_resolution->width,
                            'height' => $data->data[$a]->images->standard_resolution->height,
                        ],
                    ],
                    'likes' => $data->data[$a]->likes->count,
                    'url' => $data->data[$a]->link,
                    'descripcion' => self::FormatDescripcion($data->data[$a]->caption),
                    'user' => [
                        'id' => $data->data[$a]->user->id,
                        'full_name' => $data->data[$a]->user->full_name,
                        'img' => $data->data[$a]->user->profile_picture,
                        'username' => $data->data[$a]->user->username,
                    ],
                    'coments' => $data->data[$a]->comments->count,
                    'link' => $data->data[$a]->link,
                ];
            }
        }
        return $response;
    }

    public function FormatDescripcion($des)
    {
        $dt = Carbon::now();
        if (isset($des)) {
            $dt->timestamp = $des->created_time;
            $data = [
                'texto' => $des->text,
                'fecha_cracion' => $dt->diffForHumans(),
                'id' => $des->id,
            ];
        } else {
            $data = [
                'texto' => "No registrado",
                'fecha_cracion' => null,
                'id' => null,
            ];
        }

        return $data;
    }

    public function FormatComments($data)
    {
        dd($data);
    }

    public function FormatCredentialsBd($data)
    {
        $date = [];
        for ($a = 0; $a < count($data); $a++) {
            $date[$a] = [
                'id' => $data[$a]['id'],
                'ClientID' => $data[$a]['ClientID'],
                'ClientSecret' => $data[$a]['ClientSecret'],
                'RedirectUrl' => $data[$a]['RedirectUrl'],
                'username' => $data[$a]['username'],
                'profile_picture' => $data[$a]['profile_picture'],
                'full_name' => $data[$a]['full_name'],
                'bio' => $data[$a]['bio'],
                'website' => $data[$a]['website'],
            ];
        }
        return $date;
    }

    public function FormatPerfil($data)
    {
        $date = [
            'username' => $data['username'],
            'profile_picture' => $data['profile_picture'],
            'full_name' => $data['full_name'],
            'bio' => $data['bio'],
            'website' => $data['website'],
            'is_business' => $data['is_business'],
            'media' => $data['media'],
            'follows' => $data['follows'],
            'followed_by' => $data['followed_by'],
        ];
      return $data;
    }

}
