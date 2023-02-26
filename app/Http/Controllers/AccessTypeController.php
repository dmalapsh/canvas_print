<?php

namespace App\Http\Controllers;

use App\Http\Resources\AccessTypeResource;
use App\Models\AccessType;
use Illuminate\Http\Request;

class AccessTypeController extends Controller
{
    public function index() {
        return AccessTypeResource::collection(AccessType::all());
    }

    public function show($id) {
        return AccessType::find($id);
    }

    public function store(Request $request){
        return new AccessTypeResource(AccessType::create($request->all()));
    }

    public function update(Request $request, $id) {
        $AccessType = AccessType::find($id);
        $AccessType->update($request->all());
        return new AccessTypeResource($AccessType);
    }

    public function destroy($id) {
        AccessType::find($id)->delete();
        return response()->json(["delete" => true]);
    }
}
