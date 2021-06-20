<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patologia extends Model
{
    protected $keyType = 'integer';

    protected $table = 'patologias';

    protected $fillable = ['nome', 'descricao', 'ativo', 'arquivado'];
}
