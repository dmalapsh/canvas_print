<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Resources\AccessTypeResource;
use App\Models\AccessType;
use Illuminate\Http\Request;

class AccessTypeController extends Controller
{
    public function index()
    {
        return response()->json(
            AccessTypeResource::collection(AccessType::all()),
            Response::HTTP_OK
        );
    }

    public function show($id)
    {
        return response()->json(
            AccessType::find($id),
            Response::HTTP_OK
        );

    }

    public function store(Request $request)
    {
        $accessType = AccessType::create($request->all());

        return response()->json(
            new AccessTypeResource($accessType),
            Response::HTTP_CREATED
        );
    }

    public function update(Request $request, $id)
    {
        $accessType = AccessType::find($id);
        $accessType->update($request->all());

        return response()->json(
            new AccessTypeResource($accessType),
            Response::HTTP_OK
        );
    }

    public function destroy($id)
    {
        AccessType::find($id)->delete();

        return response()->json(
            ["delete" => true],
            Response::HTTP_OK
        );
    }
}