<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DonorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('donors')->insert([
            [
                'first_name' => 'Muhammad',
                'last_name' => 'Hidayat',
                'phone' => '085245880001',
                'email' => 'dayat@mail.test',
                'location' => 'Maros',
                'donation' => '500000',
                'donation_category' => 'Infak',
                'message' => null,
                'bank_payment' => 'Bank Muamalat',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'first_name' => 'Aldy',
                'last_name' => 'Jabir',
                'phone' => '085245888888',
                'email' => 'aldy@mail.test',
                'location' => 'Maros',
                'donation' => '900000',
                'donation_category' => 'Zakat',
                'message' => null,
                'bank_payment' => 'Bank BRI',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'first_name' => 'Syaiful',
                'last_name' => 'Haq',
                'phone' => '085245555555',
                'email' => 'ipul@mail.test',
                'location' => 'Maros',
                'donation' => '200000',
                'donation_category' => 'Wakaf',
                'message' => null,
                'bank_payment' => 'Bank BSI',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]
        ]);
    }
}
