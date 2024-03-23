<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ponto extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tipo',
        'timestamp',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
