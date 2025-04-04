<?php

namespace Database\Seeders;

use App\Models\User;
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

        $workCenters = [

                ['name' => 'A&AA Basin- Jorhat', 'username' => '94540'],
                ['name' => 'Ahmedabad Asset', 'username' => '59220'],
                ['name' => 'Ankleshwar Asset', 'username' => '94334'],
                ['name' => 'Assam Asset, Nazira', 'username' => '94556'],
                ['name' => 'C2-C3 Plant, Vadodara', 'username' => '70316'],
                ['name' => 'Cambay Asset', 'username' => '82398'],
                ['name' => 'Cauvery Asset', 'username' => '94587'],
                ['name' => 'Cauvery Basin, Chennai', 'username' => '82170'],
                ['name' => 'CBM Asset, Bokaro', 'username' => '78423'],
                ['name' => 'Dehradun', 'username' => '94326'],
                ['name' => 'Delhi - Other', 'username' => '76421'],
                ['name' => 'Delhi - Scope Minar', 'username' => '70915'],
                ['name' => 'EOA Kaninada', 'username' => '51528'],
                ['name' => 'Hazira Plant', 'username' => '94166'],
                ['name' => 'IPEOT, Mumbai', 'username' => '82361'],
                ['name' => 'IPSHEM- Goa', 'username' => '82289'],
                ['name' => 'IRS- Ahmedabad', 'username' => '82489'],
                ['name' => 'KDMIPE, Dehradun', 'username' => '77724'],
                ['name' => 'MBA Basin Kolkata', 'username' => '78500'],
                ['name' => 'Mehsana Asset', 'username' => '96437'],
                ['name' => 'Rajahmundry Asset', 'username' => '71385'],
                ['name' => 'RKOEA- Jodhpur', 'username' => '90001'],
                ['name' => 'RO, Mumbai', 'username' => '94591'],
                ['name' => 'Silchar- Expl. Asset', 'username' => '94170'],
                ['name' => 'Tripura Asset, Agartala', 'username' => '83258'],
                ['name' => 'Uran Plant', 'username' => '94171'],
                ['name' => 'WOB- Vadodara', 'username' => '94484']
            ];
        
        $departments        =   ['HR', 'Finance', 'MM', 'Logistics', 'Other'];
        $non_departments    =   ['HR', 'Finance', 'MM', 'Other'];
        $centersToExclude   =   ['Delhi - Scope Minar', 'IPEOT, Mumbai', 'IRS- Ahmedabad', 'KDMIPE, Dehradun', 'RKOEA- Jodhpur'];
        
        foreach ($workCenters as $center) {

            $user   =   User::where('username', $center['username'])->pluck('id')->first();
            $workCenter = WorkCenter::create(['name' => $center['name'], 'nodal_officer_id' => $user]);
            
            if (!in_array($center['name'], $centersToExclude)) {
                
                foreach ($departments as $department) {
                    CenterDepartment::create(
                        [ 'name' => $department, 'work_center_id' => $workCenter->id ]
                    );
                }
            }else{
                foreach ($non_departments as $department) {
                    CenterDepartment::create(
                        [ 'name' => $department, 'work_center_id' => $workCenter->id ]
                    );
                }
            }
        }

    }
}
