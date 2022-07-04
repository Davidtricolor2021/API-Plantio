<?php

namespace App\Http\Controllers;

use App\Models\Historico as Historico;
use App\Http\Resources\Historico as HistoricoResource;
use Illuminate\Http\Request;

/*
 * APIs para listar, cadastrar, editar e remover dados de historico
*/

class HistoricoController extends Controller
{
    // Listar os históricos

    public function index()
    {
        $historicos = Historico::paginate(15);
        return HistoricoResource::collection($historicos);
    }

    //Cadastrar um novo histórico

    public function store(Request $request)
    {
        $historico = new Historico;
        $historico->plantio_id = $request->input('plantio_id');
        $historico->users_id = $request->input('users_id');
        $historico->acao = $request->input('acao');
        $historico->data_acao = $request->input('data_acao');

        if ($historico->save()) {
            return new HistoricoResource($historico);
        }
    }

    //Mostra um historico especifico

    public function show($id)
    {
        $historico = Historico::findOrFail($id);
        return new HistoricoResource($historico);
    }

    //Editar/Atualizar o conteudo de um histórico

    public function update(Request $request, $id)
    {
        $historico = Historico::findOrFail($request->id);
        $historico->plantio_id = $request->input('plantio_id');
        $historico->users_id = $request->input('users_id');
        $historico->acao = $request->input('acao');
        $historico->data_acao = $request->input('data_acao');

        if ($historico->save()) {
            return new HistoricoResource($historico);
        }        
    }

    //Deleta um histórico

    public function destroy($id)
    {
        $historico = Historico::findOrFail($id);

        if ($historico->delete()) {
            return response()->json([
                'message' => 'Histórico deletado com sucesso!',
            ]);
        }
    }
    
}
