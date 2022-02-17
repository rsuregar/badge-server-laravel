<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['SuperAdmin', 'User', 'Partner', 'PartnerAdmin'];
        foreach ($data as $key => $value) {
            Role::firstOrCreate(['name' => $value]);
        }
    }
}
