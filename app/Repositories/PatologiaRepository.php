<?php
namespace App\Repositories;

use App\Models\Patologia;
use App\Models\PatologiaAudit;

class PatologiaRepository
{
    public function store($request)
    {
        try {

            \DB::beginTransaction();
            $patologia = new Patologia($request->all());
            $patologia->save();

            $audit = new PatologiaAudit();

            $audit->user_id = 1;
            $audit->patologia_id = $patologia->id;
            $audit->acao = 'CRIOU';

            $audit->save();

            \DB::commit();
            return true;

         }catch(\Exception $e){
            \DB::rollback();
            return false;
         }
    }
    
    public function list()
    {
        return Patologia::where('ativo', true)->orderBy('nome', 'ASC')->get();
    }

    public function shelve($patologia_id)
    {
        try {

            \DB::beginTransaction();

            $patologia = Patologia::where('id', $patologia_id)->firstOrFail();

            $patologia->ativo = false;

            $patologia->save();

            $audit = new PatologiaAudit();

            $audit->user_id = 1;
            $audit->patologia_id = $patologia_id;
            $audit->acao = 'ARQUIVOU';

            $audit->save();

            \DB::commit();
            return true;
        }
        catch(\Exception $e){
            \DB::rollback();
            return false;
         }
    }

    public function filter($request)
    {
        if(empty($request->nome))
            return Patologia::where('ativo', $request->ativo)->orderBy('nome', 'ASC')->get();
        else
            return Patologia::where([
                    ['ativo', $request->ativo],
                    ['nome', 'like', '%'.$request->nome.'%'],
                    ])->orderBy('nome', 'ASC')->get();
    }

    public function get($patologia_id)
    {
        $patologia = Patologia::where('id', $patologia_id)->firstOrFail();

        if($patologia)
            return $patologia;
        else
            return false;
    }

    public function update($request)
    {
        try {

            \DB::beginTransaction();
        
            $patologia = Patologia::where('id', $request->id)->firstOrFail();

            $patologia->nome = $request->nome;
            $patologia->descricao = $request->descricao;
            $patologia->save();

            $audit = new PatologiaAudit();

            $audit->user_id = $request->user_id;
            $audit->patologia_id = $request->id;
            $audit->acao = 'ATUALIZOU';

            $audit->save();

            \DB::commit();
            return true;
        }
        catch(\Exception $e){
            dd($e);
            \DB::rollback();
            return false;
         }
    }

    public function history($patologia_id)
    {
        $historico = PatologiaAudit::where('patologia_id', $patologia_id)->orderBy('id', 'ASC')->get();
        
        foreach($historico as $acao)
        {
            $acao->autor = PatologiaAudit::find($acao->id)->user->name;
            $acao->patologia = PatologiaAudit::find($acao->id)->patologia->nome;
        }

        return $historico;
    }
}
