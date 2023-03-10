<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokterPerujuk extends Model
{
    use HasFactory;

    protected $table = 'dokter_perujuk';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
