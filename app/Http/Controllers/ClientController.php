<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return response()->json(
            ClientResource::collection(Client::all()),
            Response::HTTP_OK
        );
    }

    public function show($id)
    {
        return response()->json(
            Client::find($id)->load('accesses.accessTemplate'),
            Response::HTTP_OK
        );
    }

    public function store(Request $request)
    {
        $client = Client::create($request->all());

        return response()->json(
            new ClientResource($client),
            Response::HTTP_CREATED
        );
    }

    public function update(Request $request, $id)
    {
        $client = Client::find($id);
        $client->update($request->all());

        return response()->json(
            new ClientResource($client),
            Response::HTTP_OK
        );
    }

    public function destroy($id)
    {
        Client::find($id)->delete();

        return response()->json(
            ["delete" => true],
            Response::HTTP_OK
        );
    }
}