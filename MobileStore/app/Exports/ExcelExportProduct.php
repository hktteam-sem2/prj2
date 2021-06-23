<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Product;

class ExcelExportProduct implements FromCollection,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::all();
    }
    public function headings(): array {
        return [
            'Product ID',
            'Product Name',
            'Category ID',
            'Brand ID',
            'Description',
            'Price',
            'Image',
            'Status',
        ];
    }

    public function map($pro): array {
        return [
            $pro->product_id,
            $pro->product_name,
            $pro->category_id,
            $pro->brand_id,
            $pro->product_desc,
            $pro->product_price,
            $pro->product_image,
            $pro->product_status,
        ];
    }
}
