<?php

namespace App\Http\Controllers;

use App\Http\Resources\AccessResource;
use App\Models\Access;
use Illuminate\Http\Request;

class AccessController extends Controller
{
    public function index() {
        return AccessResource::collection(Access::all());
    }

    public function show($id) {
        return Access::find($id);
    }

    public function store(Request $request){
        return new AccessResource(Access::create($request->all()));
    }

    public function update(Request $request, $id) {
        $Access = Access::find($id);
        $Access->update($request->all());
        return new AccessResource($Access);
    }

    public function destroy($id) {
        Access::find($id)->delete();
        return response()->json(["delete" => true]);
    }
}
