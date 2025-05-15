<?php

// database/migrations/xxxx_xx_xx_create_wilayah_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('wilayah', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('level'); // contoh: provinsi, kabupaten, kecamatan
            $table->unsignedBigInteger('parent_id')->nullable(); // relasi ke provinsi/kabupaten
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wilayah');
    }
};
