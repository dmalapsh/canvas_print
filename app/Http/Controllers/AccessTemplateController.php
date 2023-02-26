<?php

namespace App\Http\Controllers;

use App\Http\Resources\AccessTemplateResource;
use App\Models\AccessTemplate;
use Illuminate\Http\Request;

class AccessTemplateController extends Controller
{
    public function index() {
        return AccessTemplateResource::collection(AccessTemplate::all());
    }

    public function show($id) {
        return AccessTemplate::find($id);
    }

    public function store(Request $request){
        return new AccessTemplateResource(AccessTemplate::create($request->all()));
    }

    public function update(Request $request, $id) {
        $AccessTemplate = AccessTemplate::find($id);
        $AccessTemplate->update($request->all());
        return new AccessTemplateResource($AccessTemplate);
    }

    public function destroy($id) {
        AccessTemplate::find($id)->delete();
        return response()->json(["delete" => true]);
    }
}
