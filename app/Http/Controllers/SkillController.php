<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:skills,name',
        ]);
        Skill::create($validated);
        return redirect()->back();
        // Türkçe: Yeni beceri ekler ve önceki sayfaya yönlendirir.
    }

    /**
     * Display the specified resource.
     */
    public function show(Skill $skill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skill $skill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:skills,name,' . $skill->id,
        ]);
        $skill->update($validated);
        return redirect()->back();
        // Türkçe: Mevcut beceriyi günceller ve önceki sayfaya yönlendirir.
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        $skill->delete();
        return redirect()->back();
        // Türkçe: Beceri kaydını siler ve önceki sayfaya yönlendirir.
    }
}
