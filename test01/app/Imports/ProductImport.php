<?php

namespace App\Imports;

use App\Models\product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new product([
            'productName'   => $row[0],
            'product_code'  => $row[1],
            'productPrice'  => $row[2],
            'discount'      => $row[3],
            'expiryDate'    => $row[4],
            'stock'         => $row[5]
        ]);
    }
}
