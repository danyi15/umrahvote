<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id('id_candidate');  // ID kandidat sebagai primary key
            $table->string('nama_ketua');  // Nama ketua kandidat
            $table->string('nama_wakil')->nullable();  // Nama wakil kandidat (opsional)
            $table->text('visi');  // Visi kandidat
            $table->text('misi');  // Misi kandidat
            $table->text('program_kerja');  // Program kerja kandidat
            $table->string('photo')->nullable();  // Foto kandidat (opsional, dapat berupa URL atau path)
            $table->timestamps();  // Timestamps (created_at dan updated_at)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidates');
    }
}
