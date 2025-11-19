<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Box;

class BoxController extends Controller
{
     public function index()
    {
        return Box::all();
    }

     public function shuffleColors(Request $request)
    {
        $colors = ['red', 'yellow', 'green', 'blue', 'pink', 'grey'];
        shuffle($colors);
        
        return response()->json(['colors' => $colors]);
    }

    public function sortBoxes(Request $request)
    {
        $request->validate(['colorOrder' => 'required|array']);

        return response()->json(['message' => 'Boxes sorted according to color order']);
    }

}
