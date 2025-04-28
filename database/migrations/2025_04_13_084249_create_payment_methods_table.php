<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('payment_methods', function (Blueprint $table) {
        $table->id();
        $table->string('nama_metode');       // Contoh: BCA, COD, DANA
        $table->enum('tipe', ['cod', 'bank', 'ewallet', 'qris']);
        $table->string('nomor')->nullable(); // Bisa no rekening, no HP, atau link QRIS
        $table->string('atas_nama')->nullable(); 
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
