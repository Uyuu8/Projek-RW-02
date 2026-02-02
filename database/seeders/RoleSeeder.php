<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $role = [
            [
                'name'          => 'Admin',
                'guard_name'    => 'web'
            ],
            [
                'name'          => 'Ketua RW',
                'guard_name'    => 'web'
            ],
            [
                'name'          => 'Sektetaris',
                'guard_name'    => 'web'
            ],
            [
                'name'          => 'Bendahara',
                'guard_name'    => 'web'
            ],
            [
                'name'          => 'Tarka',
                'guard_name'    => 'web'
            ]
        ];

        foreach ($role as $value) {
            Role::firstOrCreate(
                ['name' => $value['name']],
                ['guard_name' => $value['guard_name']]
            );

            $this->command->info('Data Role '.$value['name'].' has been checked.');
        }
    }
}
