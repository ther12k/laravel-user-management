<?php

if (!function_exists('nppbkc_status_names')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function nppbkc_status_names($id)
    {
        //setiap change status, notifikasi ke email pemohon, khusus untuk status 1,3 kirim juga notifikasi ke telegram
        $names = [
            '0'=>'Revisi Permohonan Awal',//ketika status nppbkc ini, permohonan bisa diedit pemohon
            '1'=>'Aju Cek Lokasi',
            '2'=>'Setuju Cek Lokasi',
            '3'=>'Permohonan NPPBKC',
            '4'=>'Ditolak', //status 4 keatas tidak bisa diedit lagi
            '5'=>'Disetujui',
        ];
        return $names[$id];
    }
}

if (!function_exists('nppbkc_file_captions')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function nppbkc_file_captions($name=null)
    {
               
        $captions = [
            'file_denah_bangunan'=>'Denah di dalam Bangunan',
            'file_denah_lokasi'=>'Denah Situasi sekitar lokasi',
            'file_siup_mb'=>'SIUP-MB / SKMB',
            'file_itp_mb'=>'ITP-MB',
            'file_nib'=>'Nomor Induk Berusaha',
            'file_npwp_usaha'=>'NPWP Usaha',
            'file_npwp_pemilik'=>'NPWP Pemilik',
            'file_ktp_pemilik'=>'KTP Pemilik',
            'file_surat_pernyataan'=>'Surat Pernyataan',
            'file_surat_kuasa'=>'Surat Kuasa'
        ];
        if($name==null) return $captions;
        try{
            return $captions[$name];
        }catch (\Exception $e) {
            return $name;
        }
    }
}


