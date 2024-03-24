<?php

namespace App\Http\Controllers;

use App\Interfaces\PontoServiceInterface;
use App\Services\PontoService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PontoController extends Controller
{
    protected $pontoService;

    public function __construct(PontoService $pontoService)
    {
        $this->pontoService = $pontoService;
    }

    public function registrar(Request $request)
    {
        try {
            // Validação dos dados da requisição
            $validatedData = $request->validate([
                'tipo' => 'required|in:entrada,intervalo_inicio,intervalo_fim,saida',
            ]);

            // Preparação dos dados para registro
            $data = [
                'tipo' => $validatedData['tipo'],
                'user_id' => auth()->user()->id,
            ];

            // Tentativa de registrar o ponto utilizando o serviço
            $this->pontoService->registrar($data);

            // Resposta em caso de sucesso
            return response()->json([
                'mensagem' => 'Registro efetuado com sucesso',
            ], 200);
        } catch (\Exception $e) {
            // Resposta em caso de erro
            return response()->json([
                'mensagem' => 'Erro ao registrar o ponto: ' . $e->getMessage(),
            ], 500);
        }
    }


    public function visualizarRegistros(Request $request)
    {
        $userId = auth()->user()->id;
        $dataInicio = $request->query('data_inicio');
        $dataFim = $request->query('data_fim');

        $registros = $this->pontoService->visualizarRegistros($userId, $dataInicio, $dataFim);

        return response()->json($registros);
    }

    public function gerarRelatorio(Request $request)
    {
        $userId = auth()->user()->id;
        $mes = $request->query('mes');
        $ano = $request->query('ano');

        $relatorio = $this->pontoService->gerarRelatorio($userId, $mes, $ano);

        return response()->json($relatorio);
    }
}
