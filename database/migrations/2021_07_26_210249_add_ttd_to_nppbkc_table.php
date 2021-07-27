<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTtdToNppbkcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nppbkcs', function (Blueprint $table) {
            //
            $table->string('ttd_permohonan_nppbkc')->after('catatan_petugas')->nullable();
            $table->string('ttd_permohonan_lokasi')->after('no_permohonan_nppbkc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nppbkcs', function (Blueprint $table) {
            //
        });
    }
}
