<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index() {
        return ClientResource::collection(Client::all());
    }

    public function show($id) {
        return Client::find($id)->load('accesses.access_template.access_type');
    }

    public function store(Request $request){
        return new ClientResource(Client::create($request->all()));
    }

    public function update(Request $request, $id) {
        $client = Client::find($id);
        $client->update($request->all());
        return new ClientResource($client);
    }

    public function destroy($id) {
        Client::find($id)->delete();
        return response()->json(["delete" => true]);
    }
}
