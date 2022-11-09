<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'ADMIN',
            'email' => 'tokoku@gmail.com',
        ]);

        \App\Models\Account::create([
            'saldo' => 0,
            "kredit" => 0,
            "debit" => 0,
            "nama" => "Inisiasi",
            "tanggal" => date("Y-m-d"),
        ]);
    }
}
