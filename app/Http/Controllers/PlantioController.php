<?php

namespace App\Http\Controllers;

use App\Models\Plantio as Plantio;
use App\Http\Resources\Plantio as PlantioResource;
use App\Models\Historico;
use Illuminate\Http\Request;

/*
 * APIs para listar, cadastrar, editar e remover dados de Plantio
*/

class PlantioController extends Controller
{
    // Listar os Plantios

    public function index()
    {
        $plantios = Plantio::where('ativo', '=', true)->paginate(15);
            return PlantioResource::collection($plantios);
    }

    //Cadastrar um novo plantio

    public function store(Request $request)
    {
        $plantio = new Plantio;
        $plantio->mes = $request->input('mes');
        $plantio->ano = $request->input('ano');
        $plantio->valor_incremento = $request->input('valor_incremento');
        $plantio->valor_compensacao = $request->input('valor_compensacao');
        $plantio->valor_reparacao = $request->input('valor_reparacao');
        $plantio->tca_firmado = $request->input('tca_firmado');
        $plantio->tca_executado = $request->input('tca_executado');

        if ($plantio->save()) {

            $historico = new Historico();
            $historico->plantio_id = $plantio->id;
            $historico->users_id = auth()->user()->id;
            $historico->acao = 'criar';
            $historico->data_acao = date("Y-m-d");

            $historico->save();
            
            return new PlantioResource($plantio);
        }
    }

    //Mostra um plantio especifico

    public function show($id)
    {
        $plantio = Plantio::where('ativo', '=', true)->findOrFail($id);
        return new PlantioResource($plantio);
    }

    //Editar/Atualizar o conteudo de um plantio

    public function update(Request $request, $id)
    {
        $plantio = Plantio::where('ativo', '=', true)->findOrFail($request->id);
        $plantio->mes = $request->input('mes');
        $plantio->ano = $request->input('ano');
        $plantio->valor_incremento = $request->input('valor_incremento');
        $plantio->valor_compensacao = $request->input('valor_compensacao');
        $plantio->valor_reparacao = $request->input('valor_reparacao');
        $plantio->tca_firmado = $request->input('tca_firmado');
        $plantio->tca_executado = $request->input('tca_executado');

        if ($plantio->save()) {
            /*
            TODO: descomentar as linhas abaixo e entre a cria????o do objeto $historico e o save, criar o registro de que foi feita uma atualiza????o de registro
            dicas: pegar o id de plantio do objeto $plantio que acabou de salvar, e o id de usu??rio de auth()->user()->id.
            Para a data da a????o, usar o comando date com o formato yyyy-mm-dd (ver na documenta????o do PHP a fun????o "date()")
            Para a acao, usar uma das op????es: 'criar', 'atualizar', 'remover'

            Aplicar esse cadastro de hist??rico em todos os m??todos de cria????o, atualiza????o e remo????o de plantio
            */
            
            $historico = new Historico();
            $historico->plantio_id = $plantio->id;
            $historico->users_id = auth()->user()->id;
            $historico->acao = 'atualizar';
            $historico->data_acao = date("Y-m-d");

            $historico->save();

            return new PlantioResource($plantio);
        }
    }

    //Deleta um plantio

    public function destroy($id)
    {
        $plantio = Plantio::where('ativo', '=', true)->findOrFail($id);
           
            $plantio->ativo = false; 
            $plantio->save();

            $historico = new Historico();               
            $historico->plantio_id = $plantio->id;
            $historico->users_id = auth()->user()->id;
            $historico->acao = 'remover';
            $historico->data_acao = date("Y-m-d");

            $historico->save();

            return response()->json([
                'message' => 'Plantio deletado com sucesso!',
                
            ]);
        }
}