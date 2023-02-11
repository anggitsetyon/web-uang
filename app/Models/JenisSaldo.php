<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSaldo extends Model
{
    use HasFactory;
    protected $guarded = ['*'];

    
    public function transaksi()
    {
        return $this->hasMany(transaksi::class);
    }
}
