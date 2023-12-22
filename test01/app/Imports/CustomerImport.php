<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;

class CustomerImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Customer([
            'customerName'=> $row[0],
            'customerCode'=> $row[1],
            'Address'=> $row[2],
            'contact'=> $row[3]
        ]);
    }
}
