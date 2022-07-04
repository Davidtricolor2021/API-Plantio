<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plantio extends Model
{
    use HasFactory;

    protected $fillable = [
        'mes',
        'ano',
        'valor_incremento',
        'valor_compensacao',
        'valor_reparacao',
        'tca_firmado',
        'tca_executado',
        'ativo'        
    ];
}
