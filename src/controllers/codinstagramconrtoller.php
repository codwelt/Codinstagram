<?php

namespace Codwelt\codinstagram\controllers;

use Codwelt\codinstagram\clases\apiopc;
use Codwelt\codinstagram\clases\conexion;
use Codwelt\codinstagram\clases\format;
use Codwelt\codinstagram\clases\tools;
use Codwelt\codinstagram\model\Codinstagrammodelconfig;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class codinstagramconrtoller extends Controller
{
    public $tools;
    protected $first;
    public $apiopc;
    public $conexion;
    public $format;

    public function __construct()
    {
        $this->tools = new tools();
        $this->apiopc = new apiopc();
        $this->conexion = new conexion();
        $this->format = new format();
        $this->inthemoment = $this->tools->forceToArray(Codinstagrammodelconfig::where('use', 'u')->get());

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (isset($this->inthemoment[0]['token'])) {
            $media = $this->apiopc->ObtenerMedia($this->inthemoment[0]['token']);
            $user = $this->inthemoment[0];
        } else {
            $media = null;
            $user = null;
        }
        return view('codinstagram::index', compact('codinstagram'))
            ->with('media', $media)
            ->with('user', $user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $val = $this->inthemoment;
        if (isset($val[0])) {
            $resultado = $this->conexion->TestToken($val[0]['token']);
            if ($resultado == "true") {
                return json_encode(["result" => "true"]);
            } else {
                $intento = $this->conexion->ObtenerToken($this->inthemoment[0]['ClientID'], $this->inthemoment[0]['ClientSecret'], $this->inthemoment[0]['RedirectUrl'], $this->inthemoment[0]['code']);
                if ($intento == "true") {
                    return json_encode(["result" => "true"]);
                } else {
                    return redirect('codinstagram/Errores/' . base64_encode($intento));
                }
                return redirect('codinstagram/Errores/' . base64_encode($resultado));
            }
        } else {
            return json_encode(["result" => "false"]);
        }
    }

    public function errores($error)
    {
        return view('codinstagram::errors', compact('codinstagram'))->with('error', base64_decode($error));
    }

    public function comentarios($id)
    {
        // return json_encode($this->apiopc->ObtenerComentarios($id, $this->inthemoment));
    }

    public function obtenerperfil(){
        return json_encode($this->format->FormatPerfil($this->inthemoment[0]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
