<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Resources\AccessTemplateResource;
use App\Models\AccessTemplate;
use Illuminate\Http\Request;

class AccessTemplateController extends Controller
{
    public function index()
    {

        return response()->json(
            AccessTemplateResource::collection(AccessTemplateResource::all()),
            Response::HTTP_OK
        );
    }

    public function show($id)
    {
        return response()->json(
            AccessTemplate::find($id),
            Response::HTTP_OK
        );

    }

    public function store(Request $request)
    {
        $accessTemplate = AccessTemplate::create($request->all());

        return response()->json(
            new AccessTemplateResource($accessTemplate),
            Response::HTTP_CREATED
        );
    }

    public function update(Request $request, $id)
    {
        $accessTemplate = AccessTemplate::find($id);
        $accessTemplate->update($request->all());

        return response()->json(
            new AccessTemplateResource($accessTemplate),
            Response::HTTP_OK
        );
    }

    public function destroy($id)
    {
        AccessTemplate::find($id)->delete();

        return response()->json(
            ["delete" => true],
            Response::HTTP_OK
        );
    }
}