<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserListTableSeeder extends Seeder
{
    /**
     * Fake users
     *
     * @var array
     */
    private $users = [
        [
            'name'     => 'Alan',
            'lastname' => 'Gibson',
            'email'    => 'mpiotr@hotmail.com',
        ],
        [
            'name'     => 'Jessica',
            'lastname' => 'Clark',
            'email'    => 'cliffski@gmail.com',
        ],
        [
            'name'     => 'Blake',
            'lastname' => 'Cameron',
            'email'    => 'gregh@outlook.com@gmail.com',
        ],
        [
            'name'     => 'Julia',
            'lastname' => 'Anderson',
            'email'    => 'duchamp@yahoo.com',
        ],
        [
            'name'     => 'Colin',
            'lastname' => 'Dyer',
            'email'    => 'davel@hotmail.com',
        ],
        [
            'name'     => 'Karen',
            'lastname' => 'Greene',
            'email'    => 'claesjac@outlook.com',
        ],
        [
            'name'     => 'Thomas',
            'lastname' => 'Marshall',
            'email'    => 'jshearer@live.com',
        ],
        [
            'name'     => 'Fiona',
            'lastname' => 'Wilkins',
            'email'    => 'moinefou@aol.com@live.com',
        ],
        [
            'name'     => 'Abigail',
            'lastname' => 'Poole',
            'email'    => 'jemarch@yahoo.ca',
        ],
        [
            'name'     => 'Tracey',
            'lastname' => 'Lee',
            'email'    => 'aprakash@yahoo.ca',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->users as $user) {
            $now = Carbon::now()->toDateTimeString();

            DB::table('user_list')->insert($user + [
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
