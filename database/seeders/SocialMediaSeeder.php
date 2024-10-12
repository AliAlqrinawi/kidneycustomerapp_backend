<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SocialMedia;
use Illuminate\Support\Facades\Hash;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $social_media = [
            [
                'key' => 'facebook',
                'name' => 'فيسبوك',
                'icon' => 'fab fa-facebook-f',
                'class' => 'fa'
            ],
            [
                'key' => 'instagram',
                'name' => 'انستغرام',
                'icon' => 'fa-brands fa-instagram',
                'class' => 'in'
            ],
            [
                'key' => 'linkedin',
                'name' => 'لينكدان',
                'icon' => 'fa-brands fa-linkedin-in',
                'class' => 'in'
            ],
            [
                'key' => 'twitter',
                'name' => 'تويتر',
                'icon' => 'fa-brands fa-x-twitter',
                'class' => 'in'
            ],
        ];

        foreach ($social_media as $sm) {

            $social = SocialMedia::where('key', $sm['key'])->first();
            if (!$social) {
                SocialMedia::create([
                    'key' => $sm['key'],
                    'name' => $sm['name'],
                    'icon' => $sm['icon'],
                    'class' => $sm['class'],
                ]);
            }
        }
    }
}

