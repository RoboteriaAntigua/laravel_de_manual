<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nombre extends Model
{
    use HasFactory;
    protected $table="nombres";
    protected $fillable= [
        'nombre',
        'email',
        'edad'
    ];
}
