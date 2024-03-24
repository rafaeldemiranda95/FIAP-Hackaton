<?php

namespace App\Services;

use App\Interfaces\AutorizaAlteracaoRepositoryInterface;
use App\Interfaces\AutorizaAlteracaoServiceInterface;
use Carbon\Carbon;
use App\Repositories\PontoRepository;
use Carbon\CarbonPeriod;

class AutorizaAlteracaoService implements AutorizaAlteracaoServiceInterface
{
    protected $autorizaAlteracaoRepository;

    public function __construct(AutorizaAlteracaoRepositoryInterface $autorizaAlteracaoRepository)
    {
        $this->autorizaAlteracaoRepository = $autorizaAlteracaoRepository;
    }

    public function resgistrarSolicitacao($data)
    {
        return $this->autorizaAlteracaoRepository->resgistrarSolicitacao($data);
    }

    public function confirmaSolicitacao($data, $id)
    {
        return $this->autorizaAlteracaoRepository->confirmaSolicitacao($data, $id);
    }

    public function temAutorizacao($dataCompare)
    {
        return $this->autorizaAlteracaoRepository->temAutorizacao($dataCompare);
    }
}
