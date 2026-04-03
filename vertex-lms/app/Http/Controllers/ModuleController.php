<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreModuleRequest;
use App\Http\Requests\UpdateModuleRequest;
use App\Models\Module;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($courseId)
    {
        return \App\Models\Course::findOrFail($courseId)->modules()->with('lessons')->paginate();
    }

    public function store(StoreModuleRequest $request)
    {
        $module = Module::create($request->validated());
        return response()->json($module, 201);
    }

    public function show(Module $module)
    {
        return $module->load('lessons');
    }

    public function update(UpdateModuleRequest $request, Module $module)
    {
        $module->update($request->validated());
        return response()->json($module);
    }

    public function destroy(Module $module)
    {
        $module->delete();
        return response()->noContent();
    }
}
