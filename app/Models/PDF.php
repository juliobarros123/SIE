<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PDF extends Model {
    use HasFactory;
    protected $fillable = [ 'id_materia', 'vc_pdf', 'vc_descricao_pdf', 'it_estado', 'it_size_pdf'];
}
