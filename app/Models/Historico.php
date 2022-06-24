<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    use HasFactory;

    protected $fillable = [
        'plantio_id',
        'users_id',
        'acao',
        'data_acao',
    ];

    public function plantio()
    {
        return $this->belongsTo(Plantio::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
