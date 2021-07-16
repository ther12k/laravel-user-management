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
            $table->tinyInteger('status_nppbkc')->default(1);
            //last no permohonan
            $table->string('no_permohonan');
            $table->string('no_permohonan_lokasi');
            $table->string('no_permohonan_nppbkc')->nullable();
            $table->string('catatan_petugas')->nullable();
            $table->string('no_ba_cek_lokasi')->nullable();
            $table->date('tanggal_ba_cek_lokasi')->nullable();
            //step1      
            $table->string('status_pemohon');
            $table->string('nama_pemilik');
            $table->string('alamat_pemilik');
            $table->string('npwp_pemilik')->nullable();
            $table->string('telp_pemilik')->nullable();
            $table->string('email_pemilik');
            //step2
            $table->string('jenis_usaha_bkc');
            $table->string('jenis_bkc');
            //step3
            $table->string('nama_usaha');
            $table->string('alamat_usaha');
            $table->string('npwp_usaha')->nullable();
            $table->string('telp_usaha')->nullable();
            $table->string('email_usaha');
            $table->string('jenis_lokasi');
            //step4
            $table->string('kegunaan');
            $table->string('province_id');
            $table->string('regency_id');
            $table->string('district_id');
            $table->string('village_id');
            $table->string('rt_rw')->nullable();
            $table->string('alamat');
            $table->double('lokasi_latitude')->nullable();
            $table->double('lokasi_longitude')->nullable();


        //     'no_siup_mb','masa_berlaku_siup_mb_from','masa_berlaku_siup_mb_to','no_itp_mb',
        // 'masa_berlaku_itp_mb_from','masa_berlaku_itp_mb_to','no_izin_nib',
        // 'tanggal_nib','tanggal_kesiapan_cek_lokasi'
            $table->string('no_siup_mb')->nullable();
            $table->date('masa_berlaku_siup_mb_from');
            $table->date('masa_berlaku_siup_mb_to');
            $table->string('no_itp_mb')->nullable();
            $table->date('masa_berlaku_itp_mb_from');
            $table->date('masa_berlaku_itp_mb_to');
            $table->string('no_izin_nib')->nullable();
            $table->date('tanggal_nib');

            $table->date('tanggal_kesiapan_cek_lokasi');

            // $table->string('file_denah_bangunan')->nullable();
            // $table->string('file_denah_lokasi')->nullable();
            // $table->string('file_izin_instansi')->nullable();
            // $table->string('file_surat_kuasa')->nullable();
            // $table->string('file_nib')->nullable();
            // $table->string('file_npwp_usaha')->nullable();
            // $table->string('file_ktp_pemilik')->nullable();
            // $table->string('file_npwp_pemilik')->nullable();
            // $table->string('file_surat_pernyataan')->nullable();
            // $table->string('file_data_registrasi')->nullable();
            $table->blameable();
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
        Schema::dropIfExists('nppbkc_files');
        Schema::dropIfExists('nppbkc_annotations');
        Schema::dropIfExists('nppbkcs');
    }
}
