<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class NodalUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(
            [
                'name'      => 'Nodal Officer 2',
                'email'     => 'nodal2@gmail.com',
                'password'  =>  Hash::make('password'),

                'username'  => 'nodal_officer2',

                'is_phone_verified' =>  '1',
                'cpfNo'     => 'nodal_officer2',
                'address'   => 'Address of the nodel officer',
                'phone'     => '9400988999',
            ]
        )->assignRole('nodal');
    }
}
