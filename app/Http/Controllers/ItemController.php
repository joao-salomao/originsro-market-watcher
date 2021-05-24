<?php

namespace App\Http\Controllers;

use App\Model\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::orderBy('item_id', 'asc');

        foreach (['name', 'item_id', 'type'] as $filterKey) {
            $filterValue = $request->get($filterKey, null);
            $isNotEmpty = !empty($filterValue);
            if ($isNotEmpty) {
                $query->where($filterKey, 'like', '%' . $filterValue . '%');
            }
        }

        $perPage = $request->get('per_page', 10);
        $items = $query->paginate($perPage);
        return response($items);
    }
}
