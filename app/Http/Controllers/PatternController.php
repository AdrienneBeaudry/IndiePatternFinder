<?php

namespace App\Http\Controllers;

use App\Pattern;
use DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PatternController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->query('query');
        $patterns = DB::table('patterns')
            ->where('description', 'like', "%".$query."%")
            ->orWhere('name', 'like', "%".$query."%")
            ->get();

        return view('patterns.search', ['query' => $query, 'patterns' => $patterns]);

    }
}
