<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatologiaAudit extends Model
{
    protected $keyType = 'integer';

    protected $table = 'patologias_audit';

    protected $fillable = ['user_id', 'patologia_id', 'acao'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function patologia()
    {
        return $this->belongsTo('App\Models\Patologia');
    }
}
