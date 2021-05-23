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

    public function update(Request $request, Alert $alert)
    {
        $data = $request->all();
        $result = $alert->update($data);
        return response(['updated' => $result]);
    }

    public function destroy(Alert $alert)
    {
        $result = $alert->delete();
        return response(['deleted' => $result]);
    }
}
