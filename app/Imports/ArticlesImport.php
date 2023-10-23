<?php

namespace App\Imports;

use App\Models\Article;
use Maatwebsite\Excel\Concerns\ToModel;

class ArticlesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {    
        $article = new Article([
            "code" => $row['0'],
            "name" => $row['1'],
            
        ]);

        return $article;
    }
}
