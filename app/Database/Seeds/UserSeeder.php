<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UserModel;

class UserSeeder extends Seeder
{
    public function run()
    {
        //
        $user_object = new UserModel();

        $user_object->insertBatch([
            [
                "name" => "Afdal Zikri Amanda",
                "username" => "2020190799",
                "password" => password_hash("190799", PASSWORD_DEFAULT),
                "role" => "admin"
            ],
        ]);
    }
}
