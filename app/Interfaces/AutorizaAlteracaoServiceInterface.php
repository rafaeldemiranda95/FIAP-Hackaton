<?php

namespace App\Interfaces;

interface AutorizaAlteracaoServiceInterface
{
    public function resgistrarSolicitacao($data);
    public function confirmaSolicitacao($data, $id);
    public function temAutorizacao($dataCompare);
}
