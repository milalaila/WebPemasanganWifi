<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'no_hp', 'email', 'alamat', 'provinsi_id',
        'kabupaten_id', 'kecamatan_id',
        'paket_wifi_id',
        'payment_method_id', 'foto_ktp', 'nik', 'kebutuhan',
        'tanggal_pemasangan', 'total'
    ];

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_id');
    }
    
    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id');
    }
    
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }
    
}
