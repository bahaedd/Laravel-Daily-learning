<?php

namespace App;

use App\QueryFilters\Active;
use App\QueryFilters\MaxCount;
use App\QueryFilters\Sort;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;

class Article extends Model
{
    public static function allArticles()
    {
       return  $articles = app(Pipeline::class)
        ->send(Article::query())
        ->through([
            Active::class,
            Sort::class,
            MaxCount::class
        ])
        ->thenReturn()
        ->paginate(5);
    }
}
