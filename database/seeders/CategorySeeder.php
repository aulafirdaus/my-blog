<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            ['name' => $name = 'Blog', 'slug' => str($name)->slug()],
            ['name' => $name = 'Tutorials', 'slug' => str($name)->slug()],
            ['name' => $name = 'News', 'slug' => str($name)->slug()],
            ['name' => $name = 'Packages', 'slug' => str($name)->slug()],
        ])->each(fn ($category) => \App\Models\Category::create($category));
    }
}
