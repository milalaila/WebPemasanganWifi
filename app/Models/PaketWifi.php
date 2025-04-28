<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketWifi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_paket',
        'kecepatan',
        'harga',
        'deskripsi'
    ];
}
