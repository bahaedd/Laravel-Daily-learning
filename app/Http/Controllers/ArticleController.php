<?php

namespace App\Http\Controllers;

use App\Article;
use App\QueryFilters\Active;
use App\QueryFilters\Sort;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class ArticleController extends Controller
{
    public function index()
    {
        //without pipeline
        // $articles = Article::query();

        // if(request()->has('active')) {
        //     $articles->where('active', request('active'));
        // }

        // if(request()->has('sort')) {
        //     $articles->orderBy('title', request('sort'));
        // }
        // $articles = $articles->get();

        //with pipeline

        // $articles = app(Pipeline::class)
        // ->send(Article::query())
        // ->through([
        //     Active::class,
        //     Sort::class
        // ])
        // ->thenReturn()
        // ->get();

        //method 3

        $articles = Article::allArticles();



        return view('articles.index', compact('articles'));
    }
}
