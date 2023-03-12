<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'tb_produk';

    public function merekProduk()
    {
        return $this->hasONe(Merek::class, 'id', 'merek_id')->withTrashed();
    }
}
