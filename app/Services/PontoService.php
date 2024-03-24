<?php

namespace App\Services;

use App\Interfaces\AutorizaAlteracaoServiceInterface;
use App\Services\AutorizaAlteracaoService;
use App\Interfaces\PontoServiceInterface;
use App\Interfaces\PontoRepositoryInterface;
use Carbon\Carbon;
use App\Models\Ponto;
use App\Repositories\PontoRepository;
use Carbon\CarbonPeriod;

class PontoService implements PontoServiceInterface
{
    protected $pontoRepository;
    protected $autorizaAlteracaoService;

    public function __construct(PontoRepositoryInterface $pontoRepository, AutorizaAlteracaoService $autorizaAlteracaoService)
    {
        $this->pontoRepository = $pontoRepository;
        $this->autorizaAlteracaoService = $autorizaAlteracaoService;
    }

    public function registrar(array $data)
    {
        $data['user_id'] = auth()->user()->id;
        $data['timestamp'] = Carbon::now();
        return $this->pontoRepository->registrarPonto($data);
    }

    public function visualizarRegistros(int $userId, $dataInicio, $dataFim)
    {
        $registros = $this->pontoRepository->buscarRegistrosPorUsuarioEData($userId, $dataInicio, $dataFim);
        return $registros;
    }

    public function alterar($data, $id)
    {
        // $ponto = $this->pontoRepository->exibirPonto($id);

        // $carbonInstance = Carbon::parse($ponto['timestamp']);

        // $dia =  $carbonInstance->format('Y-m-d');

        // $dataCompare = ['user_id' => auth()->user()->id, 'dia' => Carbon::createFromFormat('Y-m-d', $dia)->startOfDay()];

        // return $dataCompare;

        // $verifica = $this->autorizaAlteracaoService->temAutorizacao($dataCompare);
        $dataFormat = $data['data'] . ' ' . $data['hora'];
        $data['timestamp'] = Carbon::createFromFormat('d-m-Y H:i', $dataFormat);
        $data['user_id'] = auth()->user()->id;

        return $this->pontoRepository->alterarPonto($data, $id);
    }

    public function gerarRelatorio(int $userId, $mes, $ano)
    {
        $registros = $this->pontoRepository->gerarRelatorio($userId, $mes, $ano);
        return $registros;
    }
}
