<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Form extends Model
{
    protected $table='forms_tables';
    protected $fillable = ['name','schema'];
    protected $casts =[
        'schema'=>'array'
    ];
}
