<?php

use Illuminate\Database\Seeder;
use App\ProjectUser;

class ProjectsUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectUser::create([
        	'project_id' => 1,
        	'user_id' => 3,
        	'level_id' => 1
		]);

		ProjectUser::create([
        	'project_id' => 1,
        	'user_id' => 4,
        	'level_id' => 2
		]);
    }
}
