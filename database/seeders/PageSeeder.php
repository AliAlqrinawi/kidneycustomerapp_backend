<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $pages = [
            [
                'slug' => 'terms_and_conditions',
                'title' => 'الشروط والاحكام',
            ],
            [
                'slug' => 'privacy_policy',
                'title' => 'سياسة الخصوصية',
            ]
        ];

        foreach ($pages as $page) {
            $is_found = Page::where('slug', $page['slug'])->first();
            if (!$is_found) {
                $new_page = new Page();
                $new_page->slug = $page['slug'];
                $new_page->can_delete = 0;
                $new_page->{'title' . ':' . 'ar'} = $page['title'];
                $new_page->{'text' . ':' . 'ar'} = $page['title'];
                $new_page->save();
            }
        }
    }
}