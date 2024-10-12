<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SectionText;
use Illuminate\Support\Facades\Hash;

class SectionTextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $sections = [
          
        ];

        foreach ($sections as $section) {

            $item = SectionText::where('section', $section['section'])->first();
            if (!$item) {
                $new_item = new SectionText();
                $new_item->section = $section['section'];
                $new_item->{'title' . ':' . 'ar'} = $section['title'];
                $new_item->{'text' . ':' . 'ar'} = $section['title'];
                $new_item->save();
            }
        }
    }
}

