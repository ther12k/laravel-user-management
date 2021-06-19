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
            $table->tinyInteger('status_nppbkc')->default('1');
            
            $table->string('status_pemohon');
            $table->string('nama_pemilik');
            $table->string('alamat_pemilik');
            $table->string('npwp_pemilik')->nullable();
            $table->string('telp_pemilik')->nullable();
            $table->string('email_pemilik');

            $table->string('jenis_usaha_bkc');
            $table->string('jenis_bkc');

            $table->string('nama_perusahaan');
            $table->string('alamat_perusahaan');
            $table->string('npwp_perusahaan')->nullable();
            $table->string('telp_perusahaan')->nullable();
            $table->string('email_perusahaan');
            $table->string('jenis_lokasi');

            $table->string('lokasi');
            $table->string('kegunaan');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->string('rt_rw')->nullable();
            $table->string('alamat');
            $table->double('lokasi_latitude')->nullable();
            $table->double('lokasi_longitude')->nullable();


            $table->string('jenis_izin');
            $table->string('no_izin')->nullable();
            $table->date('tanggal_izin_from');
            $table->date('tanggal_izin_to');
            $table->string('no_induk_usaha')->nullable();


            $table->date('tanggal_kesiapan_cek_lokasi');

            $table->string('file_denah_bangunan')->nullable();
            $table->string('file_denah_lokasi')->nullable();
            $table->string('file_izin_instansi')->nullable();
            $table->string('file_surat_kuasa')->nullable();
            $table->string('file_nib')->nullable();
            $table->string('file_npwp_perusahaan')->nullable();
            $table->string('file_ktp_pemilik')->nullable();
            $table->string('file_npwp_pemilik')->nullable();
            $table->string('file_surat_pernyataan')->nullable();
            $table->string('file_data_registrasi')->nullable();
            
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
