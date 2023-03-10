<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiLabPaket extends Model
{
    use HasFactory;

    protected $table = 'transaksi_lab_paket';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
