<?php

namespace App\Http\Controllers;

use App\Models\Target;
use Illuminate\Http\Request;
use App\Models\Saving;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TargetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {
        $targets = Auth::user()->targets()->latest()->get();
        return view('index', compact('targets'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('target.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'amount' => 'required|numeric|min:1',
    ]);

    $path = null;
    if ($request->hasFile('gambar')) {
        $path = $request->file('gambar')->store('targets', 'public');
    }

    // Ambil saving user
    $saving = \App\Models\Saving::where('user_id', Auth::id())->first();

    // Jika belum ada saving → buat otomatis
    if (!$saving) {
        $saving = \App\Models\Saving::create([
            'user_id' => Auth::id(),
            'name' => Auth::user()->name,
            'amount' => 0
        ]);
    }

    // Sekarang dijamin sudah ada $saving->id
    Target::create([
        'user_id' => Auth::id(),
        'savings_id' => $saving->id,
        'name' => $request->name,
        'gambar' => $path,
        'amount' => $request->amount,
        'collected' => 0,
        'status' => 'belum tercapai',
    ]);

    return redirect()->route('index')->with('success', 'Target berhasil ditambahkan');
}


    /**
     * Display the specified resource.
     */
    public function show(Target $target)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Target $target)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Target $target)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Ambil target dulu
        $target = Target::findOrFail($id);

        // Hapus file gambar jika ada
        if ($target->gambar && Storage::disk('public')->exists($target->gambar)) {
            Storage::disk('public')->delete($target->gambar);
        }

        // Hapus record target
        $target->forceDelete(); // pakai soft delete jika model menggunakan SoftDeletes

        return redirect()->route('index')->with('success', 'Target berhasil dihapus sementara');
    }
}
