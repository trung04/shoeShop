<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name=ucwords($this->faker->word);
        $datetime=$this->faker->dateTimeBetween('-1 month',endDate:'now');

        return [
            //
            'name'=> $name,
            'logo_path'=>basename($this->faker->image(storage_path('app/public/images/brand/logo'))),
            'created_at'=>$datetime,
            'updated_at'=>$datetime

        ];

    }
}
