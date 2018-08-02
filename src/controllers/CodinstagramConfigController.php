<?php

namespace Codwelt\codinstagram\controllers;

use Codwelt\codinstagram\clases\conexion;
use Codwelt\codinstagram\clases\format;
use Codwelt\codinstagram\clases\tools;
use Codwelt\codinstagram\model\Codinstagrammodelconfig;
use Codwelt\codinstagram\model\Codinstagrammodelscope;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class CodinstagramConfigController extends Controller
{

    public $tools;
    public $format;
    protected $conexion;
    protected $first;
    public $request;

    public function __construct(Request $re)
    {
        $this->tools = new tools();
        $this->conexion = new conexion();
        $this->format = new format();
        $this->first = $this->tools->forceToArray(Codinstagrammodelconfig::with('Scope')->first());
        $this->request = $re;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (isset($_GET['code'])) {
            self::accesoapi($_GET['code']);
        }
        $scope = $this->tools->forceToArray(Codinstagrammodelscope::all());
        $config = $this->format->FormatCredentialsBd($this->tools->forceToArray(Codinstagrammodelconfig::all()));

        return view('codinstagram::configuracion', compact('codinstagram'))
            ->with('scope', $scope)
            ->with('config', $config);
    }

    //El codigo no concuerda con el dado
    private function accesoapi($codigo)
    {
        Codinstagrammodelconfig::where('flag', "f")
            ->update([
                'code' => $codigo
            ]);
        $valors = $this->tools->forceToArray(Codinstagrammodelconfig::where('flag', "f")->get());
        $val = $this->conexion->ObtenerToken($valors[0]['ClientID'], $valors[0]['ClientSecret'], $valors[0]['RedirectUrl'], $codigo);
        if ($val) {
            Codinstagrammodelconfig::where('flag', "f")
                ->update([
                    'flag' => null]);
            echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
            return json_encode(['value' => true]);

        } else {
            Codinstagrammodelconfig::where('flag', "f")
                ->update([
                    'flag' => null]);
            return json_encode($val);
        }
    }

    public function obtenertoken($clientid, $requesturl)
    {
        Codinstagrammodelconfig::where('ClientID', $clientid)
            ->update([
                'flag' => "f"]);
        $url = "https://api.instagram.com/oauth/authorize/?client_id=" . $clientid . "&redirect_uri=" . base64_decode($requesturl) . "&response_type=code";
        echo "<script languaje='javascript' type='text/javascript'>location.href ='" . $url . "';</script>";

    }

    public function AgregarCredenciales($clientid, $clientsecret, $redirecturi)
    {
        $config = new Codinstagrammodelconfig();
        $config->ClientID = $clientid;
        $config->ClientSecret = base64_decode($clientsecret);
        $config->RedirectUrl = base64_decode($redirecturi);
        $config->save();
        return json_encode(["create" => true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $config = $this->tools->forceToArray(Codinstagrammodelconfig::all());
        $resultado = $this->conexion->TestConexion($config[0]['ClientID'], $config[0]['RedirectUrl']);
        if ($resultado) {
            session('status2', 'Task was successful!2');
            session(['status' => 'Task was successful!']);
            return redirect()->route("CodinstagramConfig");
        } else {
            dd("Si no pero si funciona");
            return redirect()->route("CodinstagramConfig");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $config = new  Codinstagrammodelconfig();
        $config->ClientID = $request['ClientId'];
        $config->ClientSecret = $request['ClientSecret'];
        $config->RedirectUrl = $request['RedirectUrl'];
        $config->ScopeId = $request['scope'];
        $config->save();
        return redirect()->route("CodinstagramConfig")->withErrors("Credenciales se registraron con exito");
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
    public function update(Request $request, $id = 1)
    {
        Codinstagrammodelconfig::where('id', $this->first['id'])
            ->update([
                'ClientID' => $request['ClientId'],
                'ClientSecret' => $request['ClientSecret'],
                'RedirectUrl' => $request['RedirectUrl'],
                'ScopeId' => $request['scope']]);
        return redirect()->route("CodinstagramConfig")->withErrors("se ha configurado con exito");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Codinstagrammodelconfig::where('id', $id)->delete();
        return redirect()->route("CodinstagramConfig")->withErrors("se ha eliminado con exito");
    }
}
