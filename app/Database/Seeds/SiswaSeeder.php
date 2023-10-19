<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\SiswaModel;

class SiswaSeeder extends Seeder
{
    public function run()
    {
        //
        $siswa_object = new SiswaModel();

        $siswa_object->insertBatch([
            [
                "name" => "Amanah Ananda Salisa",
                "nis" => "1010190799",
                "kelas" => "I A",
                "tahunajaran" => "2022/2023",
                "tgl_lahir" => "190799",
                "biaya" => "250000",
                "role" => "siswa"
            ],
        ]);
    }
}
