<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioDeEstudo extends Model
{
    protected $fillable = ['vc_pdf','vc_nivel'];
    use HasFactory;
}
