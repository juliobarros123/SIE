<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReacaoVideo extends Model
{
    use HasFactory;
    protected $fillable=[
        'reacao',
        'id_user',
        'id_video'];
}
