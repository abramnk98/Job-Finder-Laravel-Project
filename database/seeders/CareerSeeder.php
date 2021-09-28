<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Career;
class CareerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $careers_item = array(
                'Accounting / Finanace' => 'flaticon-calculator',
                'Automotive Jobs' => 'flaticon-wrench',
                'Construction / Facilities' => 'flaticon-worker',
                'Telecommunications' => 'flaticon-telecommunications',
                'Healthcare' => 'flaticon-stethoscope',
                'Design, Art & Multimedia' => 'flaticon-computer-graphic',
                'Transportation & Logistics' => 'flaticon-trolley',
                'Restaurant / Food Service' => 'flaticon-restaurant',
        );

        foreach ($careers_item as $career => $icon) {
            Career::create([
                'name' => $career,
                'icon_class' => $icon,
            ]);
        }
    }
}
