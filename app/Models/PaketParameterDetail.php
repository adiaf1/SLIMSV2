<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketParameterDetail extends Model
{
    use HasFactory;

    protected $table = 'paket_parameter_detail';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
