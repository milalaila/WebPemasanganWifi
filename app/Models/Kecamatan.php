<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'provinsi_id', 'kabupaten_id'];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function kabupaten()
{
    return $this->belongsTo(Kabupaten::class);
}

}

