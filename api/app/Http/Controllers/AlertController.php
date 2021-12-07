<?php

namespace App\Http\Controllers;

use App\Model\Alert;
use Illuminate\Http\Response;
use App\Http\Requests\Alert\CreateRequest;
use App\Http\Requests\Alert\UpdateRequest;

class AlertController extends Controller
{

    public function index(): Response
    {
        $alerts = Alert::with('item', 'matches')->get();
        return response($alerts);
    }

    public function store(CreateRequest $request): Response
    {
        $data = $request->all();
        $alert = Alert::create($data);
        return response($alert);
    }

    public function update(UpdateRequest $request, Alert $alert): Response
    {
        $data = $request->all();
        $result = $alert->update($data);
        return response(['updated' => $result]);
    }

    public function destroy(Alert $alert): Response
    {
        $result = $alert->delete();
        return response(['deleted' => $result]);
    }
}
