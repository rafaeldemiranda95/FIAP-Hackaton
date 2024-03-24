<?php

namespace App\Interfaces;

interface AutorizaAlteracaoRepositoryInterface
{
    public function resgistrarSolicitacao($data);
    public function confirmaSolicitacao($data, $id);
    public function temAutorizacao($dataCompare);
}
