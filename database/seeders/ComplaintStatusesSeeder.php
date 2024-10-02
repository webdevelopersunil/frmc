<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ComplaintStatus;

class ComplaintStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() : void
    {
        $statuses = [
            'With FCO',
            'With Nodal Officer',
            'Under FRMC deliberations for Closure/Investigation',
            'Under Investigation',
            'Fraud Not Established – Complaint archived',
            'Fraud Established – Complaint archived',
            'Withdrawn – to be ignored'
        ];

        foreach ($statuses as $status) {
            ComplaintStatus::create([
                'name' => $status,
                'status' => true // Default status is true
            ]);
        }
    }
}
