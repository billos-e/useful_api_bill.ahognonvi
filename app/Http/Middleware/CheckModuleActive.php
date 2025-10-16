<?php

namespace App\Http\Middleware;

use App\Models\User_module;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckModuleActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, String $moduleId): Response
    {
        $module_line = User_module::where('user_id', '=', Auth::user()->id)
            ->where('module_id', '=', $moduleId)
            ->get()
            ->first();

        if($module_line->active) return $next($request);


        return response()->json([
                "error" => "Module inactive. Please activate this module to use it."
            ], 403);
    }
}
