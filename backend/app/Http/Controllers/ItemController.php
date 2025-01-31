<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $title = $request->input('title'); 
    
        $items = Item::query();
    
        if ($title) {
            $items->where('title', 'like', '%' . $title . '%'); 
        }

        // inspecionar os dados antes de retornar
        // dd($items->toSql(), $items->getBindings());    
    
        $items = $items->paginate(10); 
    
        return $items; 
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $item = Item::create($request->only(['title', 'body']));

        return response()->json($item, 201);
    }
}
