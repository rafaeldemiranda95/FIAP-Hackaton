<?php 

namespace App\Http\Controllers;

use App\Interfaces\PontoServiceInterface;
use Illuminate\Http\Request;
use Carbon\Carbon;
class PontoController extends Controller
{
    protected $pontoService;

    public function __construct(PontoServiceInterface $pontoService)
    {
        $this->pontoService = $pontoService;
    }

    public function registrar(Request $request)
    {
        $request->validate([
            'tipo' => 'required|in:entrada,intervalo_inicio,intervalo_fim,saida',
        ]);

        $data = [
            'tipo' => $request->tipo,
            'user_id' => auth()->user()->id, 
        ];

        $this->pontoService->registrar($data);

        return response()->json([
            'mensagem' => 'Registro efetuado com sucesso',
        ], 200);
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
