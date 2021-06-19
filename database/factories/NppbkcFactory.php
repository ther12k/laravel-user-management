<?php

namespace Database\Factories;

use App\Models\Nppbkc;
use Illuminate\Database\Eloquent\Factories\Factory;

class NppbkcFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Nppbkc::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_pemilik' => $this->faker->name,
            //'status_nppbkc' =>  $this->faker->randomElement(['Pengajuan', 'Pemeriksaan Lokasi', 'Ditolak','Disetujui']),
            'status_nppbkc' =>  $this->faker->randomElement([1,2,3,4]),
            'status_pemohon' =>  $this->faker->randomElement(['sendiri', 'dikuasakan']),
            'email_pemilik' => $this->faker->unique()->safeEmail,
            'alamat_pemilik' => $this->faker->address,
            
            'jenis_usaha_bkc'=>$this->faker->randomElement([
                'Pengusaha Pabrik',
                'Pengusaha Tempat Penyimpanan',
                'Importir',
                'Penyalur',
                'Pengusaha Tempat Penjualan Eceran'
            ]),
            
            'jenis_bkc'=>$this->faker->randomElement([
                'Hasil Tembakau',
                'Hasil Pengolahan Tembakau Lainnya',
                'Minuman Mengandung Etil Alkohol',
                'Etil Alkohol'
            ]),

            'nama_perusahaan' => $this->faker->name,
            'alamat_perusahaan' => $this->faker->address,
            'email_perusahaan' => $this->faker->unique()->safeEmail,
            'jenis_lokasi'=>$this->faker->randomElement([
                'Pabrik',
                'Tempat Penyimpanan',
                'Tempat Usaha Importir',
                'Tempat Penjualan Eceran'
            ]),

            'lokasi' => $this->faker->address,
            'kegunaan'=>$this->faker->randomElement([
                'Membuat Barang Kena Cukai',
                'Mengemas Barang Kena Cukai',
                'Menyimpan Bahan Baku atau Bahan Penolong',
                'Menimbun Barang Kena Cukai yang Selesai Dibuat',
                'Menimbun Barang Kena Cukai yang Sudah Dilunasi Cukainya'
            ]),

            'provinsi' => $this->faker->state,
            'kota' => $this->faker->city,
            'kecamatan' => $this->faker->city,
            'kelurahan' => $this->faker->city,
            'alamat' => $this->faker->address,
            'lokasi_latitude' => $this->faker->latitude,
            'lokasi_longitude' => $this->faker->latitude,

            'jenis_izin'=>$this->faker->randomElement([
                'Izin Usaha Industri',
                'Surat Izin Usaha Perdagangan'
            ]),
            'tanggal_izin_from'=>$this->faker->date,
            'tanggal_izin_to'=>$this->faker->date,
            'tanggal_kesiapan_cek_lokasi'=>$this->faker->date
        ];
    }
}
