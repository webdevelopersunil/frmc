<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(
            [
                'name'      => 'User',
                'email'     => 'user@gmail.com',
                'password'  =>  Hash::make('password'),

                'username'  => '8259950403',

                'is_phone_verified' =>  '1',
                'cpfNo'     => 'A004629',
                'address'   => 'Address of the user',
                'phone'     => '8259950403',
            ]
        )->assignRole('user');
        
        User::create(
            [
                'name'      => 'Nodal Officer',
                'email'     => 'nodal@gmail.com',
                'password'  =>  Hash::make('password'),

                'username'  => 'nodal_officer',

                'is_phone_verified' =>  '1',
                'cpfNo'     => 'nodal_officer',
                'address'   => 'Address of the nodel officer',
                'phone'     => '9400888999',
            ]
        )->assignRole('nodal');

        User::create(
            [
                'name'      => 'FCO Officer',
                'email'     => 'fco@gmail.com',
                'password'  =>  Hash::make('password'),

                'username'  => 'fco_officer',
                
                'is_phone_verified' =>  '1',
                'cpfNo'     => 'fco_officer',
                'address'   => 'Address of the nodel officer',
                'phone'     => '9400777888',
            ]
        )->assignRole('fco');
        
    }
}
