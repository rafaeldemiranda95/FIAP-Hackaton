<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutorizaAlteracao extends Model
{
    use HasFactory;

    protected $table = 'autoriza_alteracoes';

    protected $fillable = ['dia', 'status', 'user_id'];

    public function ponto()
    {
        return $this->belongsTo(Ponto::class, 'dia');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
