<?php

use Illuminate\Database\Seeder;
use App\Level;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Level::create([ // 1
        	'name' => 'Atención por teléfono',
        	'project_id' => 1
    	]);
    	Level::create([ // 2
        	'name' => 'Envío de técnico',
        	'project_id' => 1
    	]);

    	Level::create([ // 3
        	'name' => 'Mesa de ayuda',
        	'project_id' => 2
    	]);
    	Level::create([ // 4
        	'name' => 'Consulta especializada',
        	'project_id' => 2
    	]);
    }
}
