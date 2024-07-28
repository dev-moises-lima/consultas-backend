<?php

namespace App\Http\Controllers;

use App\Http\Requests\PacienteStoreRequest;
use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Rules\Cpf;
use Intervention\Image\ImageManager;

class PacienteController extends Controller
{
    //

    public function store(PacienteStoreRequest $request)
    {
        $dados = $request->safe()->except(['foto']);

        $extensaoDaFoto = $request->foto->getClientOriginalExtension();
        $caminhoDaFoto = $request->foto->path();

        $imagemManager = ImageManager::gd()->read($caminhoDaFoto);
        $imagemManager->coverDown(1000, 1000);
        $nomeDaFoto = uniqid() . '.' . $extensaoDaFoto;
        $imagemManager->save("..\storage\app\public\imagens\\$nomeDaFoto");
        $novoCaminhoDaFoto = asset('storage/imagens/' . $nomeDaFoto);

        $dados['foto'] = $novoCaminhoDaFoto;

        Paciente::create($dados);

        return response(['mensagem' => 'Paciente cadastrado.'], 201);
    }

    public function obterTodos()
    {
        return Paciente::all();
    }

    public function obterUm(Request $request, string $pacienteId) {
        $paciente = Paciente::find($pacienteId);

        if(empty($paciente)) {
            return response(['mensagem' => "Paciente com o id {$pacienteId} não foi encontrado"], 404);
        }

        return $paciente;
    }

    public function obterConsultas(Request $request, string $pacienteId) {
        $paciente = Paciente::find($pacienteId);

        if(is_null($paciente)) {
            return response(['mensagem' => 'As consultas para um paciente não cadastrado não existem.'], 404);
        }

        $consultas = $paciente->consultas;

        return $consultas;
    }
}
