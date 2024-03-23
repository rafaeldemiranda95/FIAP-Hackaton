<?php

namespace App\Repositories;

use App\Interfaces\PontoRepositoryInterface;
use App\Models\Ponto;
use Carbon\Carbon;

class PontoRepository implements PontoRepositoryInterface
{
    public function registrarPonto(array $data)
    {
        return Ponto::create($data);
    }

    public function buscarRegistrosPorUsuarioEData(int $userId, $dataInicio, $dataFim)
    {
        return Ponto::where('user_id', $userId)
                    ->whereDate('created_at', '>=', $dataInicio)
                    ->whereDate('created_at', '<=', $dataFim)
                    ->get();
    }

    public function gerarRelatorio(int $userId, $mes, $ano)
    {
        $inicioMes = Carbon::create($ano, $mes, 1);
        $fimMes = Carbon::create($ano, $mes, 1)->endOfMonth();

        return Ponto::where('user_id', $userId)
                    ->whereBetween('timestamp', [$inicioMes, $fimMes])
                    ->get();
    }
}
