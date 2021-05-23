<?php

namespace App\Http\Controllers;

use App\Model\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $items = Item::orderBy('item_id', 'asc')->paginate($perPage);
        return response($items);
    }
}
