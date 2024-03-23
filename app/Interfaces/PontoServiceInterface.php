<?php 
namespace App\Interfaces;

interface PontoServiceInterface
{
    public function registrar(array $data);
    public function visualizarRegistros(int $userId, $dataInicio, $dataFim);
    public function gerarRelatorio(int $userId, $mes, $ano);

}
