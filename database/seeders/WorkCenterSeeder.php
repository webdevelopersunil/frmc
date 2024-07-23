<?php

namespace Database\Seeders;

use App\Models\WorkCenter;
use Illuminate\Database\Seeder;
use App\Models\CenterDepartment;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WorkCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dl     =   WorkCenter::create( ['name' => 'Delhi'] );
                        CenterDepartment::create(['name'=>'Delhi Department 1', 'work_center_id'=>  $dl->id]);
                        CenterDepartment::create(['name'=>'Delhi Department 2', 'work_center_id'=>  $dl->id]);
                        CenterDepartment::create(['name'=>'Delhi Department 3', 'work_center_id'=>  $dl->id]);

        $mb     =   WorkCenter::create( ['name' => 'Mumbai'] );
                        CenterDepartment::create(['name'=>'Mumbai Department 1', 'work_center_id'=> $mb->id]);
                        CenterDepartment::create(['name'=>'Mumbai Department 2', 'work_center_id'=> $mb->id]);
                        CenterDepartment::create(['name'=>'Mumbai Department 3', 'work_center_id'=> $mb->id]);

        $dh     =   WorkCenter::create( ['name' => 'Dehradun'] );
                        CenterDepartment::create(['name'=>'Dehradun Department 1', 'work_center_id'=> $dh->id]);
                        CenterDepartment::create(['name'=>'Dehradun Department 2', 'work_center_id'=> $dh->id]);
                        CenterDepartment::create(['name'=>'Dehradun Department 3', 'work_center_id'=> $dh->id]);

        $ah     =   WorkCenter::create( ['name' => 'Ahmedabad'] );
                        CenterDepartment::create(['name'=>'Ahmedabad Department 1', 'work_center_id'=> $ah->id]);
                        CenterDepartment::create(['name'=>'Ahmedabad Department 2', 'work_center_id'=> $ah->id]);
                        CenterDepartment::create(['name'=>'Ahmedabad Department 3', 'work_center_id'=> $ah->id]);
    }
}
