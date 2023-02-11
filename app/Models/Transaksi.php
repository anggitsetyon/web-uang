<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
  use HasFactory;

  protected $guarded = ['id'];
  public function scopeFilter($query, array $filters)
  {
    $query->when($filters['search'] ?? false, function ($query, $search) {
      return $query->where('jenis_saldo', 'like', '%' . $search . '%')
        ->orWhere('nominal', 'like', '%' . $search . '%')
        ->orWhere('keterangan', 'like', '%' . $search . '%');
    });
    $query->when($filters['akun'] ?? false, function ($query, $jenis_akun) {
      return $query->whereHas('kategori', function ($query) use ($jenis_akun) {
        $query->where('jenis_akun', $jenis_akun);
      });
    });
    $query->when($filters['d'] ?? false, function ($query, $search) {
      return $query->where('tanggal', 'like', '%' . $search . '%');
    });
  }

  public function kategori()
  {
    return $this->belongsTo(kategori::class);
  }
  public function jenisSaldo()
  {
    return $this->belongsTo(jenissaldo::class);
  }
  public function user()
  {
    return $this->belongsTo(user::class);
  }
}
