<?php

namespace App\Http\Controllers;

use App\Pattern;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PatternController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->query('query');

        $patterns = Pattern::all();
        //$patterns = Pattern::where('redirect_url', '=', "%$query%")->get();

        dd($patterns);
        return view('patterns.search', ['query' => $query, 'patterns' => $patterns]);

    }
}
