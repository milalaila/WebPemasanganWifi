<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderReview extends Model
{
    use HasFactory;

    // Pastikan ini ada agar status bisa disimpan
    protected $fillable = ['nama', 'whatsapp', 'status', 'reason'];
}

