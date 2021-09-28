<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            "More Jobs Every Day" => "flaticon-worker",
            "Creative Jobs" => "flaticon-wrench",
            "Healthcare" => "flaticon-stethoscope",
            "Finance & Accounting" => "flaticon-calculator",
        ];

        foreach ($services as $service => $icon) {
            Service::create([
                "name" => $service,
                "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati reprehenderit explicabo quos fugit vitae dolorum.",
                "icon_class" => $icon,
                "status" => "on",
            ]);
        }
    }
}
