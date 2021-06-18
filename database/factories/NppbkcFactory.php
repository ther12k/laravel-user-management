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
            'status_nppbkc' =>  $this->faker->randomElement(['1', '2', '3',]),
            'status_pemohon' =>  $this->faker->randomElement(['sendiri', 'dikuasakan']),
            'email_pemilik' => $this->faker->unique()->safeEmail,
            'email_perusahaan' => $this->faker->unique()->safeEmail,
            'lokasi' => $this->faker->address
        ];
    }
}
