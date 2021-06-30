<?php

namespace App\Imports;

use App\Models\Staff;
use Maatwebsite\Excel\Concerns\ToModel;
use Session;
use Maatwebsite\Excel\Concerns\WithStartRow;
class StaffImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Staff([
                'name'=>$row[1],
                'academic'=>$row[3],
                'nip'=>$row[2],
                'address'=>$row[4],
                'hp'=>$row[5]
        ]);
    }
     public function startRow(): int
    {
        return 2;
    }
}
