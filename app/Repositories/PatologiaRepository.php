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
        return Patologia::where('ativo', true)->get();
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
}
