<?php
namespace App\Services;

use App\Repositories\PatologiaRepository;

class PatologiaService
{
    public function __construct(PatologiaRepository $PatologiaRepository)
    {
         $this->PatologiaRepository = $PatologiaRepository;
    }

    public function store($request)
    {
        if($this->PatologiaRepository->store($request))
            return response()->json('Patologia salva com sucesso!', 200);
        else
            return response()->json('Erro ao salvar patologia!', 500);
    }

    public function list()
    {
        $patologias = $this->PatologiaRepository->list();
        
        if($patologias)
            return $patologias;
        else
            return response()->json('Erro ao listar patologias!', 500);
    }
}