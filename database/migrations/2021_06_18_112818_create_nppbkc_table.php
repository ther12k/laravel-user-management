<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNppbkcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nppbkcs', function (Blueprint $table) {
            $table->id();
            $table->string('status_nppbkc');
            $table->string('status_pemohon');
            $table->string('nama_pemilik');

            //remove theses
            $table->string('lokasi');
            $table->string('email_pemilik');
            $table->string('email_perusahaan');
            //end remove

            // $table->string('alamat_pemilik');
            // $table->string('npwp_pemilik');
            // $table->string('telp_pemilik');
            // $table->string('email_pemilik');

            // $table->string('nama_perusahaan');
            // $table->string('alamat_perusahaan');
            // $table->string('npwp_perusahaan');
            // $table->string('telp_perusahaan');
            // $table->string('email_perusahaan');
            // $table->string('lokasi');


            // $table->string('file_denah_bangunan');
            // $table->string('file_denah_lokasi');
            // $table->string('file_izin_instansi');
            // $table->string('file_surat_kuasa');
            // $table->string('file_nib');
            // $table->string('file_npwp_perusahaan');
            // $table->string('file_ktp_pemilik');
            // $table->string('file_npwp_pemilik');
            // $table->string('file_surat_pernyataan');
            // $table->string('file_data_registrasi');
            
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
        Schema::dropIfExists('nppbkcs');
    }
}
