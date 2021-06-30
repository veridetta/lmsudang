<?php

namespace App\Imports;
use Session;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class StudentsImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Student([
            'name'=>$row[1],
            'grade_code'=>$row[3],
            'nis'=>$row[2],
            'address'=>$row[4],
            'hp'=>$row[5]
        ]);
    }
    public function startRow(): int
    {
        return 2;
    }
}
