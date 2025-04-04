<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\WorkCenter;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create(
            [
                'name'      => 'Aniruddha Banerjee',
                'email'     => 'banerjee_aniruddha@ongc.co.in',
                'password'  =>  Hash::make('ongc@123'),
                'username'  => '82287',
                'is_phone_verified' =>  '1',
                'cpfNo'     => '82287',
                'address'   => 'Address of the nodel officer',
                'phone'     => '9432020102',
            ]
        )->assignRole('fco');

        // User::create(
        //     [
        //         'name'      => 'Sunil Kumar',
        //         'email'     => 'sunil.kumar2@cipl.org.in',
        //         'password'  =>  Hash::make('ongc@123'),
        //         'username'  => '11111',
        //         'is_phone_verified' =>  '1',
        //         'cpfNo'     => '11111',
        //         'address'   => 'Address of the nodel officer',
        //         'phone'     => '9588519234',
        //     ]
        // )->assignRole('fco');
       
        $nodal = [
            ['name' => 'Shakeel Mohammed Raihan', 'username' => '78500', 'designation' => 'GM(Elec)', 'phone' => '7044601484', 'email' => 'raihan_shakeel@ongc.co.in', 'location' => 'MBA Basin- Kolkata'],
            ['name' => 'S.C Shukla', 'username' => '76421', 'designation' => 'GM (HR)', 'phone' => '9426614676', 'email' => 'shukla_sc@ongc.co.in', 'location' => 'Delhi'],
            ['name' => 'Partha Sengupta', 'username' => '70316', 'designation' => 'CGM(P)', 'phone' => '9969228912', 'email' => 'partha_sengupta@ongc.co.in', 'location' => 'C2-C3 Plant, Vadodara'],
            ['name' => 'S S Sodhi', 'username' => '82361', 'designation' => 'GM (MM)', 'phone' => '9868282220', 'email' => 'sodhi_ss@ongc.co.in', 'location' => 'IPEOT, Mumbai'],
            ['name' => 'Sanjeev V Kaushal', 'username' => '77724', 'designation' => 'GM (Chem.)', 'phone' => '9435744861', 'email' => 'KAUSHAL_SANJEEV@ongc.co.in', 'location' => 'KDMIPE'],
            ['name' => 'Sachin Konndvilkar', 'username' => '94171', 'designation' => 'DGM (F&A)', 'phone' => '9969229312', 'email' => 'kondvilkar_sachin@ongc.co.in', 'location' => 'Uran Plant'],
            ['name' => 'Christinus Ekka', 'username' => '82489', 'designation' => 'DGM (Prog)', 'phone' => '9436584096', 'email' => 'ekka_christinus@ongc.co.in', 'location' => 'IRS- Ahmedabad'],
            ['name' => 'K Mathivanan', 'username' => '82170', 'designation' => 'GM (MM)', 'phone' => '9445005485', 'email' => 'k_mathivanan@ongc.co.in', 'location' => 'Cauvery Basin- Chennai'],
            ['name' => 'Feroz Ghayas', 'username' => '90001', 'designation' => 'GM (HR)', 'phone' => '7042421905', 'email' => 'ghayas_feroz@ongc.co.in', 'location' => 'RKOEA- Jodhpur'],
            ['name' => 'G Chandrasekhar', 'username' => '82289', 'designation' => 'DGM (F&A)', 'phone' => '9445005059', 'email' => 'g_chandrasekar@ongc.co.in', 'location' => 'IPSHEM- Goa'],

            ['name' => 'Vijay Bokade', 'username' => '70915', 'designation' => 'GM (E&T)', 'phone' => '9969229320', 'email' => 'bokade_vijay@ongc.co.in', 'location' => 'SCOPE Minar- Delhi'],
            ['name' => 'Swati Kumar Nair', 'username' => '94556', 'designation' => 'DGM (HR)', 'phone' => '9427504421', 'email' => 'kumar_swati@ongc.co.in', 'location' => 'Assam Asset, Nazira'],
            ['name' => 'Uppuleti Venkata Ramana Rao', 'username' => '78423', 'designation' => 'GM (Geophy-W)', 'phone' => '9490168234', 'email' => 'vraman_raou@ongc.co.in', 'location' => 'CBM Asset- Bokaro'],
            ['name' => 'Priti Sureka', 'username' => '94540', 'designation' => 'GM (HR)', 'phone' => '7710091615', 'email' => 'sureka_priti@ongc.co.in', 'location' => 'A&AA Basin- Jorhat'],
            ['name' => 'Ghanshyam Das', 'username' => '94484', 'designation' => 'DGM (F&A)', 'phone' => '9428007209', 'email' => 'das_ghanshayam@ongc.co.in', 'location' => 'WOB- Vadodara'],
            ['name' => 'Sachin Shrivastava', 'username' => '96437', 'designation' => 'GM (Elect.)', 'phone' => '7506723326', 'email' => 'shrivastava_sachin@ongc.co.in', 'location' => 'Mehsana Asset'],
            ['name' => 'R Gnanavelu', 'username' => '94587', 'designation' => 'DGM (MM)', 'phone' => '9435715877', 'email' => 'gnanavelu_r@ongc.co.in', 'location' => 'Cauvery Asset'],
            ['name' => 'Om Prakash Gupta', 'username' => '82398', 'designation' => 'GM (P)', 'phone' => '9969221257', 'email' => 'gupta_op4@ongc.co.in', 'location' => 'Cambay Asset'],
            ['name' => 'P Suresh Babu', 'username' => '51528', 'designation' => 'CGM (D)', 'phone' => '9490168104', 'email' => 'babu_polisetty@ongc.co.in', 'location' => 'EOA- Kaninada'],
            ['name' => 'T R Joshi', 'username' => '59220', 'designation' => 'DGM (HR)', 'phone' => '9428514545', 'email' => 'joshi_tr1@ongc.co.in', 'location' => 'Ahmedabad Asset'],

            ['name' => 'V V K Mohan', 'username' => '71385', 'designation' => 'CGM(Mech.)', 'phone' => '9426614442', 'email' => 'mohan_vvk@ongc.co.in', 'location' => 'Rajahmundry Asset'],
            ['name' => 'Ajay Kumar Ekka', 'username' => '94334', 'designation' => 'GM (HR)', 'phone' => '9427504799', 'email' => 'ekka_ak@ongc.co.in', 'location' => 'Ankleshwar Asset'],
            ['name' => 'Neeraj Sharma', 'username' => '68775', 'designation' => 'GM(F&A)', 'phone' => '9428007790', 'email' => 'SHARMA2_NEERAJ@ongc.co.in', 'location' => 'Ankleshwar Asset'],
            ['name' => 'Vinay Verma', 'username' => '94591', 'designation' => 'DGM (F&A)', 'phone' => '9643301244', 'email' => 'verma_vinay@ongc.co.in', 'location' => 'RO- Mumbai'],
            ['name' => 'Sanjib Kumar Das', 'username' => '94166', 'designation' => 'GM (F&A) ', 'phone' => '9435744294', 'email' => 'das_sanjibkumar@ongc.co.in', 'location' => 'Hazira- Plant'],
            ['name' => 'Somai Mandi', 'username' => '83258', 'designation' => 'GM (E&T)', 'phone' => '9470591612', 'email' => 'mandi_somai@ongc.co.in', 'location' => 'Tripura Asset, Agartala'],
            ['name' => 'Rajesh Kumar', 'username' => '94170', 'designation' => 'DGM (F&A)', 'phone' => '7042196559', 'email' => 'janjuha_rajesh@ongc.co.in', 'location' => 'Silchar- Expl. Asset'],
            ['name' => 'T B Hashmi', 'username' => '94326', 'designation' => 'GM (HR)', 'phone' => '9410391251', 'email' => 'hashmi_tb@ongc.co.in', 'location' => 'Dehradun'],

            ['name' => 'Sunil Nodal', 'username' => '22222', 'designation' => 'GM(Elec)', 'phone' => '9588519234', 'email' => 'sunil.nodal@yopmail.com', 'location' => 'MBA Basin- Kolkata'],
        ];
        
        foreach ($nodal as $user) {
            $user   =   User::create([
                'name' => $user['name'],
                'username' => $user['username'],
                'email' => $user['email'],
                'password' => Hash::make('ongc@123'),
                'is_phone_verified' => '1',
                'cpfNo' => $user['username'],
                'address' => 'Address of the nodal officer',
                'phone' => $user['phone'],
            ])->assignRole('nodal');

        }


        $frmc_user = [
            ['name' => 'Sanjay Kumar Singh', 'username' => '53561', 'designation' => 'ED- CPO', 'phone' => '9968282347', 'email' => 'singh_sanjayk@ongc.co.in'],
            ['name' => 'Rajan Asthana', 'username' => '76425', 'designation' => 'ED (HR)- Chief ER', 'phone' => '9427504335', 'email' => 'asthana_r@ongc.co.in'],
            ['name' => 'Devendra Kumar', 'username' => '78659', 'designation' => 'GGM (F&A) -CCF', 'phone' => '9868393375', 'email' => 'kumar2_devendra@ongc.co.in'],
            ['name' => 'Balraj Kumar Kotta', 'username' => '77906', 'designation' => 'GGM (E&T)-Head ICE', 'phone' => '9427504072', 'email' => 'kotta_balrajkumar@ongc.co.in'],
            // ['name' => 'Aniruddha Banerjee', 'username' => '82287', 'designation' => 'CGM(F&A)- Chief IA', 'phone' => '9432020102', 'email' => 'banerjee_aniruddha@ongc.co.in'],
            ['name' => 'Sandhya Yadav', 'username' => '96645', 'designation' => 'CGM- Chief Legal Services', 'phone' => '9968282941', 'email' => 'yadav_sandhya@ongc.co.in'],
        ];

        foreach ($frmc_user as $user) {
            User::create([
                'name' => $user['name'],
                'username' => $user['username'],
                'email' => $user['email'],
                'password' => Hash::make('ongc@123'),
                'is_phone_verified' => '1',
                'cpfNo' => $user['username'],
                'address' => 'Address of the nodal officer',
                'phone' => $user['phone'],
            ])->assignRole('frmc_user');
        }

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
    }
}
