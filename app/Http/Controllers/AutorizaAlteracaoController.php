<?php

namespace App\Http\Controllers;

use App\Services\AutorizaAlteracaoService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AutorizaAlteracaoController extends Controller
{
    //
    protected $autorizaAlteracaoService;

    public function __construct(AutorizaAlteracaoService $autorizaAlteracaoService)
    {
        $this->autorizaAlteracaoService = $autorizaAlteracaoService;
    }
    public function solicitarAlteracao(Request $request)
    {
        try {
            $request->validate([
                'dia' => 'required|date',
            ], [
                'dia.date' => 'O campo dia deve estar no formato dd-mm-YYY.',
            ]);

            $data = [
                'dia' => Carbon::create($request['dia']),
                'status' => 'Aguardando Aprovação',
                'user_id' => auth()->user()->id
            ];

            $this->autorizaAlteracaoService->resgistrarSolicitacao($data);

            return response()->json(['messagen' => "Solicitação registrada com sucesso."]);
        } catch (\Exception $e) {
            // Resposta em caso de erro
            return response()->json([
                'mensagem' => 'Erro ao registrar solicitação de alteração de ponto: ' . $e->getMessage(),
            ], 500);
        }

        // $data = ['dia' => $request['dia'], 'status' => 'Aguardando Aprovação'];
        // return response()->json($data);

        // $this->autorizaAlteracaoService->resgistrarSolicitacao($request);
        // return 'Funciona solicitarAlteracao';
    }

    public function autorizaAlteracao(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required|string|in:aprovado,rejeitado',
            ], [
                'status.required' => 'O campo status é obrigatório.',
                'status.string' => 'O campo status deve ser uma string.',
                'status.in' => 'O campo status deve ser aprovado ou rejeitado.',
            ]);
            $data = [
                // 'dia' => Carbon::create($request['dia']),
                'status' => $request['status'],
                // 'user_id' => auth()->user()->id
            ];
            $this->autorizaAlteracaoService->confirmaSolicitacao($data, $id);

            return response()->json(['messagen' => "Solicitação autorizada com sucesso."]);
        } catch (\Exception $e) {
            // Resposta em caso de erro
            return response()->json([
                'mensagem' => 'Erro ao registrar solicitação de alteração de ponto: ' . $e->getMessage(),
            ], 500);
        }
    }
}
