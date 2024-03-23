<?php

namespace App\Interfaces;

interface PontoRepositoryInterface
{
    public function registrarPonto(array $data);
    public function buscarRegistrosPorUsuarioEData(int $userId, $dataInicio, $dataFim);
    public function gerarRelatorio(int $userId, $mes, $ano);

}
