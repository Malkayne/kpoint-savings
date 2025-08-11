<?php

use Illuminate\Database\Seeder;

class schoolsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('schools')->insert([
        [
        'name' => "Pre College",

     ],
        [
        'name' => "Junior Secodary School",

     ],
        [
        'name' => "Senior Secondary schoolsSeeder",
     ],
        [
        'name' => "Preversity",
     ]
      ]);

    }
}
