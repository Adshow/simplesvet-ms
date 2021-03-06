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

    public function shelve($patologia_id)
    {
        if(!$patologia_id)
            return response()->json('É necessário enviar uma patologia válida', 500);

        if($this->PatologiaRepository->shelve($patologia_id))
            return response()->json('Patologia arquivada com sucesso!', 200);
        else
            return response()->json('Erro ao arquivar patologia!', 500);
    }

    public function filter($request)
    {
        $patologias = $this->PatologiaRepository->filter($request);

        if($patologias)
            return $patologias;
        else
            return response()->json('Erro ao filtrar patologias!', 500);
    }

    public function get($patologia_id)
    {
        if(!$patologia_id)
            return response()->json('É necessário enviar uma patologia válida', 500);

        $patologia = $this->PatologiaRepository->get($patologia_id);
        
        if($patologia)
            return $patologia;
        else
            return response()->json('Erro ao buscar patologia!', 500);
    }

    public function update($request)
    {
        if($this->PatologiaRepository->update($request))
            return response()->json('Patologia atualizada com sucesso!', 200);
        else
            return response()->json('Erro ao atualizar patologia!', 500);
    }

    public function history($patologia_id)
    {
        if(!$patologia_id)
            return response()->json('É necessário enviar uma patologia válida', 500);

        $historico = $this->PatologiaRepository->history($patologia_id);
        
        if($historico)
            return $historico;
        else
            return response()->json('Erro ao buscar historico de patologia!', 500);
    }
}