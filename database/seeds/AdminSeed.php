<?php

use Illuminate\Database\Seeder;

class AdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('admins')->insert([
          ['username' => 'bensomedAdmin',
          'name' => 'Bensomed Nig. Ent.',
         'email' => 'benesomed@gmail.com',
         'role' => 'C.E.O',
         'password' => Hash::make('bensomedAdmin/2021')
        ],
        ['username' => 'developerAfo',
        'name' => 'Developer Afo',
        'email' => 'admin@intellicsolutions.com',
        'role' => 'Software Architect/Web Developer',
        'password' => Hash::make('developerafo/2021')
        ]

        ]);
    }


}
