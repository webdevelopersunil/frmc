<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\User;

class UserReportExport implements FromQuery, WithHeadings, WithMapping
{
    protected $query;
    private $index = 0; // Initialize the counter

    // Accept the query object via constructor
    public function __construct($query)
    {
        $this->query = $query;
    }

    // Return the query with the applied filters
    public function query()
    {
        return $this->query;
    }

    // Define custom headings for the Excel file
    public function headings(): array
    {
        return [
            'Index',
            'Name',
            'Email',
            'Username',
            'CPF No',
            'Address',
            'Phone',
            'DOB',
            'House Number',
            'Area',
            'Landmark',
            'City',
            'State',
            'Role',
            'Location of Nodal Officer',
            'Last Activity',
            'Active/Inactive Status'
        ];
    }

    // Map the fields from the query to match the custom headings
    public function map($user): array
    {
        return [
            ++$this->index,
            $user->name,
            $user->email ?? 'N/A',
            $user->username ?? 'N/A',
            $user->cpfNo ?? 'N/A',
            $user->address,
            $user->phone,
            $user->dob,
            $user->house_number,
            $user->area,
            $user->landmark,
            $user->city,
            $user->state,
            $user->state,
            $user->address,
            $user->address,
            $user->address,
        ];
    }
}
