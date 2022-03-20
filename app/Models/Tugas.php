<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_mapel',
        'week',
        'judul',
        'deskripsi',
        'tugas',
        'link',
        'file',
        'link_meet',
        'deadline'
    ];

}
