<?php

namespace App\Http\Controllers;

use App\Model\Alert;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        $alert = Alert::create($data);
        return response($alert);
    }
}
