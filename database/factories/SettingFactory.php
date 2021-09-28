<?php

namespace Database\Factories;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Setting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => 'admin@example.net',
            'phone' => '01228734645',
            "logo" => "website_logo.jpg",
            "street" => "El Gomhorya",
            "building" => "120",
            "country" => "Egypt",
            "city" => "Giza",
            "region" => "Doki",

        ];
    }
}
