<?php

namespace App\Imports;
use Session;
use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
class TeacherImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Teacher([
                'name'=>$row[1],
                'academic_code'=>$row[3],
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
