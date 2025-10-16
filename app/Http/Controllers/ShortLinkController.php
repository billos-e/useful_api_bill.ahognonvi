<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ShortLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $links_line = ShortLink::where('user_id', '=', Auth::user()->id)->get();
        return $links_line;
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
        $request->validate([
            'original_url' => 'required|string|starts_with:http,https',
            'custom_code' => 'string|max:10|unique:short_links,code',
        ]);

        $code = $request->filled('custom_code') ? $request->custom_code : $this->generate_code();

        $user = ShortLink::create([
            'user_id' => Auth::user()->id,
            'original_url' => $request->original_url,
            'code' => $code,
            'clicks' => 0
        ]);

        return response()->json($user, 201);
    }

    public function generate_code() {
        $code = Str::random(10);

        if (ShortLink::where('code', $code)->exists()) {
            return $this->generate_code();
        }

        return $code;
    }

    /**
     * Display the specified resource.
     */
    public function show(ShortLink $shortLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShortLink $shortLink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ShortLink $shortLink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShortLink $shortLink)
    {
        //
    }
}
