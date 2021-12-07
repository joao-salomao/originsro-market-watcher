<?php

namespace App\Http\Controllers;

use App\Model\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::query();

        foreach (['name', 'item_id', 'type'] as $key) {
            $filterValue = $request->get($key);

            if (isset($filterValue)) {
                $query->where($key, 'like', '%' . $filterValue . '%');
            }
        }

        $perPage = $request->get('per_page', 10);
        $items = $query->paginate($perPage);

        return response($items);
    }
}
