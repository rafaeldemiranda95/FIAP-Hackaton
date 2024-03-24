<?php

namespace App\Interfaces;

interface PontoRepositoryInterface
{
    public function registrarPonto(array $data);
    public function exibirPonto($id);
    public function buscarRegistrosPorUsuarioEData(int $userId, $dataInicio, $dataFim);
    public function gerarRelatorio(int $userId, $mes, $ano);
    public function alterarPonto(array $data, $id);
}
