<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketParameter extends Model
{
    use HasFactory;

    protected $table = 'paket_parameter';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
