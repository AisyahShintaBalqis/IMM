<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');                         // Nama pengurus
            $table->string('position');                     // Jabatan (Ketua, Sekretaris, dsb.)
            $table->string('division');                     // Bidang (Human Development, Media, Organisasi, dsb.)
            $table->string('photo')->nullable();            // Foto opsional
            $table->integer('order')->default(0);           // Urutan tampil dalam bidang
            $table->enum('status', ['active', 'inactive'])  // Status
                ->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
