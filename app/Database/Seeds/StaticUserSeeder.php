<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StaticUserSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        $userModel = new \App\Models\UserModel();

        $staticUsers = [
            [
                'name'      => 'Default Admin',
                'email'     => 'admin@example.com',
                'mobile'    => '081234567890',
                'password'  => 'admin1234',
                'role'      => 'admin',
                'is_active' => 1
            ],
            [
                'name'      => 'Default Customer',
                'email'     => 'customer@example.com',
                'mobile'    => '081234567891',
                'password'  => 'user1234',
                'role'      => 'customer',
                'is_active' => 1
            ]
        ];

        foreach ($staticUsers as $user) {
            // Check if user already exists by mobile
            if (!$userModel->where('mobile', $user['mobile'])->first()) {
                $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
                $db->table('users')->insert($user);
            }
        }
    }
}
