<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_produksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_id');
            $table->foreignId('proses_id');
            $table->string('jenis_kain');
            $table->string('warna');
            $table->string('quantity_awal');
            $table->string('quantity_jadi');
            $table->enum('jenis_proses', ['Bagus', 'Jelek']);
            $table->string('waktu_mulai');
            $table->string('waktu_selesai');
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_produksi');
    }
}
