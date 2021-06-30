<?php

namespace App\Imports;

use App\Models\Academic;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;
class AcademicImport implements ToModel,WithStartRow,WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Academic([
            'name'=>$row[1],
            'code'=>$row[2]
        ]);
    }
    public function startRow(): int
    {
        return 2;
    }
    public function rules(): array
    {
        return [
            'code' => Rule::unique('academic', 'code'), // Table name, field in your db
        ];
    }

    public function customValidationMessages()
    {
        return [
            'code.unique' => 'Kode Pelajaran sudah ada',
        ];
    }
}
