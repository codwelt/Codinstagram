<?php

namespace Codwelt\codinstagram\controllers;

use Codwelt\codinstagram\clases\apiopc;
use Codwelt\codinstagram\clases\tools;
use Codwelt\codinstagram\model\Codinstagrammodelconfig;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class codinstagramconrtoller extends Controller
{
    public $tools;
    protected $first;
    public $apiopc;

    public function __construct()
    {
        $this->tools = new tools();
        $this->apiopc = new apiopc();
        $this->first = $this->tools->forceToArray(Codinstagrammodelconfig::with('Scope')->first());

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (isset($this->first['token'])) {
            $media = $this->apiopc->ObtenerMedia($this->first['token']);
            $user = $this->first;
        } else {
            $media = null;
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
        if (isset($this->first['token'])) {
            $this->apiopc->ActualizarDatoscounts($this->first['token']);
            return json_encode(["result" => "true"]);
        } else {
            return json_encode(["result" => "false"]);
        }
    }

    public function comentarios($id)
    {
        return json_encode($this->apiopc->ObtenerComentarios($id, $this->first['token']));
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
