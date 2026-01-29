<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'name'      => 'Super Admin',
            'email'     => 'admin@foodapp.com',
            'mobile'    => '0000000000',
            'password'  => password_hash('admin123', PASSWORD_DEFAULT),
            'role'      => 'admin',
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Check if admin already exists
        $userModel = new \App\Models\UserModel();
        if ($userModel->where('email', 'admin@foodapp.com')->first()) {
            return;
        }

        $this->db->table('users')->insert($data);
    }
}
