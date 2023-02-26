<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Resources\AccessResource;
use App\Models\Access;
use Illuminate\Http\Request;

class AccessController extends Controller
{
    public function index()
    {
        return response()->json(
            AccessResource::collection(Access::all()),
            Response::HTTP_OK
        );
    }

    public function show($id)
    {
        return response()->json(
            Access::find($id)->load('accessTemplate'),
            Response::HTTP_OK
        );

    }

    public function store(Request $request)
    {
        $access = Access::create($request->all());

        return response()->json(
            new AccessResource($access),
            Response::HTTP_CREATED
        );
    }

    public function update(Request $request, $id)
    {
        $access = Access::find($id);
        $access->update($request->all());

        return response()->json(
            new AccessResource($access),
            Response::HTTP_OK
        );
    }

    public function destroy($id)
    {
        Access::find($id)->delete();

        return response()->json(
            ["delete" => true],
            Response::HTTP_OK
        );
    }
}