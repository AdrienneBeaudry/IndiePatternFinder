<?php

namespace App\Http\Controllers;

use App\Pattern;
use DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PatternController extends Controller
{
    public function index(Request $request)
    {
        $patterns = DB::table('patterns')->get();
        $query = trim($request->query('query'));
        $patterns = ($query != "") ? $this->searchPatterns($query) : DB::table('patterns')->get();

        return view('welcome', ['patterns' => $patterns, 'query' => $query]);
    }

//    public function search(Request $request)
//    {
//        $query = $request->query('query');
//        $patterns = DB::table('patterns')
//            ->where('description', 'like', "%" . $query . "%")
//            ->orWhere('name', 'like', "%" . $query . "%")
//            ->get();
//
//        return view('patterns.search', ['query' => $query, 'patterns' => $patterns]);
//
//    }

    public function searchResults(Request $request)
    {
        $query = $request->query('query');
        $patterns = DB::table('patterns')
            ->where('description', 'like', "%" . $query . "%")
            ->orWhere('name', 'like', "%" . $query . "%")
            ->get();

        return view('patterns.searchResults', ['query' => $query, 'patterns' => $patterns]);
    }

    private function searchPatterns($query) {
        return DB::table('patterns')
            ->where('description', 'like', "%" . $query . "%")
            ->orWhere('name', 'like', "%" . $query . "%")
            ->get();
    }
}
