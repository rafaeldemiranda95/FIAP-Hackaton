<?php 
namespace App\Services;

use App\Interfaces\PontoServiceInterface;
use App\Interfaces\PontoRepositoryInterface;
use Carbon\Carbon;
use App\Models\Ponto;
use Carbon\CarbonPeriod;

class PontoService implements PontoServiceInterface
{
    protected $pontoRepository;

    public function __construct(PontoRepositoryInterface $pontoRepository)
    {
        $this->pontoRepository = $pontoRepository;
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


   
    public function gerarRelatorio(int $userId, $mes, $ano)
    {
        $registros = $this->pontoRepository->gerarRelatorio($userId, $mes, $ano);
        return $registros;
    }
}
