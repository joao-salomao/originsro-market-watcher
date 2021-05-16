<?php

namespace App\Http\Controllers;

use App\Model\Item;
// use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return response($items);
    }
}
