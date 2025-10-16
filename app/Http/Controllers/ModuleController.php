<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\User_module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User_module::all();
    }

    /**
     * Activate the asked module.
     */
    public function activate($moduleId, Request $request)
    {
        $module = Module::find($moduleId);
        $userId = Auth::user()->id;

        if(!$module) {
            return response()->json([
                "message" => "Module not found"
            ], 404);
        }

        User_module::updateOrCreate(
            [
                'user_id' => $userId,
                'module_id' => $moduleId
            ],
            [
                'user_id' => $userId,
                'module_id' => $moduleId,
                'active' => true
            ]
        );

        return response()->json([
            "message" => "Module activated"
        ]);
    }

    /**
     * Deactivate the asked module.
     */
    public function deactivate($moduleId, Request $request)
    {
        $module = Module::find($moduleId);
        $userId = Auth::user()->id;

        if(!$module) {
            return response()->json([
                "message" => "Module not found"
            ], 404);
        }

        User_module::updateOrCreate(
            [
                'user_id' => $userId,
                'module_id' => $moduleId
            ],
            [
                'user_id' => $userId,
                'module_id' => $moduleId,
                'active' => false
            ]
        );

        return response()->json([
            "message" => "Module deactivated"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Module $module)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Module $module)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module)
    {
        //
    }
}
