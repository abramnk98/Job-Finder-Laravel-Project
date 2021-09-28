<?php

namespace Database\Factories;

use App\Models\EmployeeProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmployeeProfile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
//            "company_name" => "Eraa Soft",
//            "first_name" => "mohamed",
//            "last_name" => "hassan",
//            "phone" => "1257823490",
//            "logo" => "company_logo_blank.png",
        ];
    }
}
