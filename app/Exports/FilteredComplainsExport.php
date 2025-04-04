<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\Complain;

class FilteredComplainsExport implements FromQuery, WithHeadings, WithMapping
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
            'Complain No',
            'Work Center',
            'Department Section',
            'Status',
            'Against Persons',
            'Created At',
        ];
    }

    // Map the fields from the query to match the custom headings
    public function map($complain): array
    {
        return [
            ++$this->index,
            $complain->complain_no,
            $complain->workCenter->name ?? 'N/A',
            $complain->centerDepartment->name ?? 'N/A',
            $complain->ComplaintStatus->status ?? 'N/A',
            $complain->against_persons,
            $complain->created_at->format('Y-m-d'),
        ];
    }
}
