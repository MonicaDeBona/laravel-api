<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = ['HTML5', 'CSS3', 'JS', 'Vue 3', 'PHP', 'Laravel 9', 'Bootstrap 5', 'Vite', 'Node.js', 'SCSS', 'Composer', 'Python'];

        foreach ($technologies as $technology) {
            $newTechnology = new Technology();
            $newTechnology->name = $technology;
            $newTechnology->slug = Str::slug($technology);
            $newTechnology->save();
            $newTechnology->slug = $newTechnology->slug . "-$newTechnology->id";
            $newTechnology->update();
        }
    }
}
