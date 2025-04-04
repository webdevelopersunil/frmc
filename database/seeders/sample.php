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
                'name'      => 'Sunil',
                'email'     => 'sunikumar300@gmail.com',
                'password'  =>  Hash::make('password'),

                'username'  => '7876976192',

                'is_phone_verified' =>  '1',
                'cpfNo'     => 'A004628',
                'address'   => 'Address of the user',
                'phone'     => '7876976192',
            ]
        )->assignRole('user');
        
        User::create(
            [
                'name'      => 'Nodal Officer',
                'email'     => 'boobaebub@gmail.com',
                'password'  =>  Hash::make('password'),

                'username'  => 'nodal_officer',

                'is_phone_verified' =>  '1',
                'cpfNo'     => 'nodal_officer',
                'address'   => 'Address of the nodel officer',
                'phone'     => '9588519234',
            ]
        )->assignRole('nodal');

        User::create(
            [
                'name'      => 'FCO Officer',
                'email'     => 'he.kingsmen@gmail.com',
                'password'  =>  Hash::make('password'),

                'username'  => 'fco_officer',
                
                'is_phone_verified' =>  '1',
                'cpfNo'     => 'fco_officer',
                'address'   => 'Address of the nodel officer',
                'phone'     => '8076442848',
            ]
        )->assignRole('fco');

        // FRMC USER

        User::create(
            [
                'name'              => 'FRMC USER 1',
                'email'             => 'frmc_one@gmail.com',
                'password'          =>  Hash::make('password'),
                'username'          => 'frmc_one',
                'is_phone_verified' =>  '1',
                'cpfNo'             => 'frmc_one',
                'address'           => 'Address of the nodel officer',
                'phone'             => '7867564545',
            ]
        )->assignRole('frmc_user');

        User::create(
            [
                'name'              => 'FRMC USER 2',
                'email'             => 'frmc_two@gmail.com',
                'password'          =>  Hash::make('password'),
                'username'          => 'frmc_two',
                'is_phone_verified' =>  '1',
                'cpfNo'             => 'frmc_two',
                'address'           => 'Address of the nodel officer',
                'phone'             => '7867564455',
            ]
        )->assignRole('frmc_user');


        User::create(
            [
                'name'      => 'Nodal 2 Officer',
                'email'     => 'boobaebub2@gmail.com',
                'password'  =>  Hash::make('password'),

                'username'  => 'nodal_officer2',

                'is_phone_verified' =>  '1',
                'cpfNo'     => 'nodal_officer2',
                'address'   => 'Address of the nodel officer',
                'phone'     => '9588519235',
            ]
        )->assignRole('nodal');
        
    }
}
