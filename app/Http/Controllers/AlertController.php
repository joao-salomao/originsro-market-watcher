<?php

namespace App\Http\Controllers;

use App\Model\Alert;
use Illuminate\Http\Request;

class AlertController extends Controller
{

    public function index()
    {
        $alerts = Alert::with('item', 'matches')->get();
        return response($alerts);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $alert = Alert::create($data);
        return response($alert);
    }
}
