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
    Schema::create('pelanggans', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('nik');
        $table->string('no_hp');
        $table->string('email')->nullable();

        $table->foreignId('provinsi_id')->constrained('provinsis')->onDelete('cascade');
        $table->foreignId('kabupaten_id')->constrained('kabupatens')->onDelete('cascade');
        $table->foreignId('kecamatan_id')->constrained('kecamatans')->onDelete('cascade');

        $table->foreignId('paket_wifi_id')->constrained('paket_wifis')->onDelete('cascade');
        $table->foreignId('payment_method_id')->constrained('payment_methods')->onDelete('cascade');

        $table->string('kebutuhan'); 
        $table->date('tanggal_pemasangan')->nullable();
        $table->integer('total_harga')->nullable();
        $table->string('foto_ktp');
        $table->text('alamat');

        $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending');
        $table->text('alasan_penolakan')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggans');
    }
};
