<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithStyles;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EnquiryExport implements FromCollection,WithHeadings,ShouldAutoSize,WithStyles
{
    public function __construct(Collection $enquires)
    {
        $this->enquires=$enquires;
    }
    public function headings():array{
        return [
            'Date',
            'From',
            'To',
            'Product',
            'Message',
            'Status'
        ];
    }
    public function styles(Worksheet $sheet)
    {

        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->enquires->map(function($enquiry){
            return [
                $enquiry->created_at->format('d/m/Y h:i A'),
                $enquiry->user->email,
                $enquiry->product->vendor->email,
                $enquiry->product->name,
                $enquiry->description,
                $enquiry->status_text
            ];
        });
    }
}
