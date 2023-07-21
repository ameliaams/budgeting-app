<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rab extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_coa',
        'saldo_normal',
        'nominal'
    ];
}
