<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([[
            'username' => 'admin',
            'cn_name' => '管理员',
            'password' => Hash::make('admin'),
            'type' => 0,
            'created_at' => date('Y-m-d H:i:s')
        ],
        [
            'username' => 'david',
            'cn_name' => '大卫',
            'password' => Hash::make('david'),
            'type' => 0,
            'created_at' => date('Y-m-d H:i:s')
        ]
        ]);
    }
}
