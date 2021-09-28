<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 1; $i <= 20; ++$i) {
            $city = ['Cairo', 'Giza', 'El Minya'];

            $region = [
                'Cairo' => ['Shubra', 'Ramsis', 'Madent Nasr'],
                'Giza' => ['Fesal', 'Doki'],
                'El Minya' => ['Beni Mazar', 'Maghagha'],
            ];

            $city = $city[array_rand($city)];

            $region = $region[$city][array_rand($region[$city])];

            $title = [
                'Project Manager, Digital Experiences',
                'Technical Project Manager',
                'Digital Project Manager',
            ];

            $job_type = ["Freelance", "Full Time", "Part Time"];

            $location = Location::create([
                "country" => 'Egypt',
                "city" => $city,
                "region" => $region,
                "building" => 120,
                "street" => 'El Gomhorya',
            ]);

            $job = Job::create([
                "title" => $title[array_rand($title)],
                "description" => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque, nisi Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
                "location_id" => $location->id,
                "min_salary" => rand(3000, 5000),
                "max_salary" => rand(6500, 7000),
                "type" => $job_type[array_rand($job_type)],
                "user_id" => rand(7, 11),
                "career_id" => rand(1, 8),
                "image" => 'default_' . rand(1, 2) . '.jpg',
            ]);

        }

        $status = ['pending', 'accepted', 'refused'];

        for($i = 1; $i <= 50; ++$i) {

            $job = Job::find(rand(1,20));

            $employee_id = $job->user_id;

            $job->candidates()->attach(rand(1,5), ['status' => $status[array_rand($status)], 'employee_id' => $employee_id]);
        }
    }
}
