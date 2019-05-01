<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AddCategories extends Seeder {
    public function run() {
        DB::table('categories')->insert([
            ['name' => 'SEO & Search Engine Optimization', 'slug' => Str::slug('SEO / Search Engine Optimization')],
            ['name' => 'Online Marketing and Monetizing', 'slug' => Str::slug('Online Marketing and Monetizing')],
            ['name' => 'Programming', 'slug' => Str::slug('Online Marketing and Monetizing')],
        ]);
    }
}
