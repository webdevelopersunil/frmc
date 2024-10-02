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

        $workCenters = [
            'A&AA Basin- Jorhat',
            'Ahmedabad Asset',
            'Ankleshwar Asset',
            'Assam Asset, Nazira',
            'C2-C3 Plant, Vadodara',
            'Cambay Asset',
            'Cauvery Asset',
            'Cauvery Basin, Chennai',
            'CBM Asset, Bokaro',
            'Dehradun',
            'Delhi - Other',
            'Delhi - Scope Minar',
            'EOA Kaninada',
            'Hazira Plant',
            'IPEOT, Mumbai',
            'IPSHEM- Goa',
            'IRS- Ahmedabad',
            'KDMIPE, Dehradun',
            'MBA Basin Kolkata',
            'Mehsana Asset',
            'Rajahmundry Asset',
            'RKOEA- Jodhpur',
            'RO, Mumbai',
            'Silchar- Expl. Asset',
            'Tripura Asset, Agartala',
            'Uran Plant',
            'WOB- Vadodara'
        ];
        
        $departments = ['HR', 'Finance', 'MM', 'Logistics', 'Other'];

        $non_departments = ['HR', 'Finance', 'MM', 'Other'];

        $centersToExclude   =   ['Delhi - Scope Minar', 'IPEOT, Mumbai', 'IRS- Ahmedabad', 'KDMIPE, Dehradun', 'RKOEA- Jodhpur'];
        
        foreach ($workCenters as $center) {

            // Static Nodal Officer ID's
            $nodal_officer_id   =   ($center == "WOB- Vadodara") ? 7 : 3;

            $workCenter = WorkCenter::create(['name' => $center, 'nodal_officer_id'=>$nodal_officer_id]);
            
            if (!in_array($center, $centersToExclude)) {
                
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
