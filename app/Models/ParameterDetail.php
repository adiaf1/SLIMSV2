<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParameterDetail extends Model
{
    use HasFactory;
    
    protected $table = 'parameter_detail';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
