<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'provinsi_id'];

   
public function kecamatans()
{
    return $this->hasMany(Kecamatan::class);
}

public function provinsi()
{
    return $this->belongsTo(Provinsi::class);
}

}
