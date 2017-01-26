<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
			'name' => 'Categoría A1',
			'project_id' => 1
        ]);
        Category::create([
			'name' => 'Categoría A2',
			'project_id' => 1
        ]);

        Category::create([
			'name' => 'Categoría B1',
			'project_id' => 2
        ]);
        Category::create([
			'name' => 'Categoría B2',
			'project_id' => 2
        ]);
    }
}
