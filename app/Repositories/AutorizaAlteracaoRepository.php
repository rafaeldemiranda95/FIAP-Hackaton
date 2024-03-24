<?php

namespace App\Repositories;

use App\Interfaces\AutorizaAlteracaoRepositoryInterface;
use App\Models\AutorizaAlteracao;
use App\Models\Ponto;
use Carbon\Carbon;

class AutorizaAlteracaoRepository implements AutorizaAlteracaoRepositoryInterface
{
    public function resgistrarSolicitacao($data)
    {
        // 
        return AutorizaAlteracao::create($data);
    }
    public function confirmaSolicitacao($data, $id)
    {
        // 
        return AutorizaAlteracao::find($id)->update($data);
    }
    public function temAutorizacao($dataCompare)
    {
        $autorizacao =  AutorizaAlteracao::whereDate('dia', $dataCompare['dia'])->get();
        return $autorizacao;
        //whereDate('dia', $dataCompare['dia'])
        // ->where('user_id', $dataCompare['user_id'])
        // ->get();
        if ($autorizacao && $autorizacao->status === 'aprovado') {
            return true;
        } else if ($autorizacao && $autorizacao->status === 'reprovado') {
            return "A autorização não foi concediada.";
        } else {
            return "A autorização está agardando eprovação.";
        }
    }
}
