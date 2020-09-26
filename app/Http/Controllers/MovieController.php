<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(){
        return view('search');
    }

    public function selectSearch(Request $request)
    {
        $movies = [];

        if($request->has('q')) {
            $search = $request->q;
            $movies = Movie::select("id", "name")
                      ->where('name', 'LIKE', "%$search%")
                      ->get();
        }

        return response()->json($movies);
    }

}
