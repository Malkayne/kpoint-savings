<?php

use Illuminate\Database\Seeder;

class RepSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('reps')->insert([
        ['username' => 'BS/100/M',
        'name' => 'Bensomed',
       'password' => Hash::make('password')
      ],
      ['username' => 'BS/200/M',
      'name' => 'Opeyemi',
     'password' => Hash::make('password')
    ],
      ['username' => 'BS/700/M',
      'name' => 'Hamed',
     'password' => Hash::make('password')
    ],
      ['username' => 'BS/800/M',
      'name' => 'Temitope',
     'password' => Hash::make('password')
    ],
      ['username' => 'BS/110/M',
      'name' => 'Boluwatife',
     'password' => Hash::make('password')
    ],
      ['username' => 'BS/120/M',
      'name' => 'Folakemi',
     'password' => Hash::make('password')
    ],


      ]);
    }
}
