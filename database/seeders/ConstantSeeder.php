<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Constant;

class ConstantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $constants = [
            [
                'key' => 'posts_categories',
            ],
            [
                'key' => 'products_categories',
            ],
            [
                'key' => 'blood_types'
            ],
            [
                'key' => 'types_health_insurance',
            ]

        ];

        foreach ($constants as $constant) {

            $is_found = Constant::where('key', $constant['key'])->first();
            if (!$is_found) {
                Constant::create([
                    'key' => $constant['key'],
                ]);
            }
        }





    }
}
