<?php

namespace App\Imports;

use App\Models\Element;
use Maatwebsite\Excel\Concerns\ToModel;

class ElementsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {    
        $element = new Element([
            "code" => $row['0'],
            "name" => $row['1'],
            "length" => $row['2'],
            "width" => $row['3'],
            "height" => $row['4'],
            "import_material" => $row['5'],
            "import_status" => 1,
            
        ]);

        return $element;
    }
}
