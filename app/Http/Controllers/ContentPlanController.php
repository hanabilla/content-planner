<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContentPlan;

class ContentPlanController extends Controller
{
    public function index()
    {
        $plans = ContentPlan::orderBy('tanggal_posting', 'asc')->get();
        return view('welcome', compact('plans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_konten' => 'required',
            'platform' => 'required',
            'tanggal_posting' => 'required|date',
            'status' => 'required'
        ]);

        ContentPlan::create($request->all());

        return redirect()->back()->with('success', 'Jadwal berhasil ditambahkan!');
    }
}