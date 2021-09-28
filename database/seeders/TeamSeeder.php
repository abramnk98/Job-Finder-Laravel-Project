<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $members = [
            "Michelle Megan" => ['job' => 'CEO, Co-founder', 'photo' => 'person_1.jpg'],
            "Mike Stellar" => ['job' => 'CTO Co-founder', 'photo' => 'person_2.jpg'],
            "Gregg White" => ['job' => 'VP Producer', 'photo' => 'person_3.jpg'],
            "Rogie Knitt" => ['job' => 'Project Manager', 'photo' => 'person_4.jpg'],
            "Ben Koh" => ['job' => 'Project Manager', 'photo' => 'person_3.jpg'],
            "Chris Stanworth" => ['job' => 'Product Designer', 'photo' => 'person_2.jpg'],
        ];

        foreach ($members as $member => $info) {
            Team::create([
                "name" => $member,
                "job" => $info['job'],
                "photo" => $info['photo'],
                "status" => "on",
            ]);
        }
    }
}
