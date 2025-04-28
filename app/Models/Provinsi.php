<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    
public function kabupatens()
{
    return $this->hasMany(Kabupaten::class);
}

public function kecamatans()
{
    return $this->hasManyThrough(Kecamatan::class, Kabupaten::class);
}

}

