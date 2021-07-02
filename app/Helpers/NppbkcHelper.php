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
        $names = [
            '0'=>'Draft',
            '1'=>'Aju Cek Lokasi',
            '2'=>'Setuju Cek Lokasi',
            '3'=>'Permohonan NPPBKC',
            '4'=>'Keputusan',
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
            'file_denah_bangunan'=>'Denah Lokasi sekitar bangunan',
            'file_denah_lokasi'=>'Denah',
            'file_siup_mb'=>'SIUP MB',
            'file_itp_mb'=>'ITP MB',
            'file_nib'=>'NIB',
            'file_npwp_pemilik'=>'NPWP Pemilik',
            'file_ktp_pemilik'=>'KTP Pemilik',
            'file_surat_pernyataan'=>'Surat Pernyataan',
            'file_data_registrasi'=>'Data Registrasi',
            'file_surat_kuasa'=>'Surat Kuasa'
        ];
        if($name==null) return $captions;
        return $captions[$name];
    }
}


