<?php

namespace App\Http\Controllers;

use App\Model\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $items = Item::simplePaginate(10);
        return response($items);
    }
}
