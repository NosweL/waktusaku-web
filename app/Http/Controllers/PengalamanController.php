<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pengalaman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePengalamanRequest;
use App\Http\Requests\UpdatePengalamanRequest;

class PengalamanController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        $pengalaman = Pengalaman::where('user_id', $userId)->get();
        return view('profile.pengalaman', compact('pengalaman'));
    }

    public function create()
    {
        return view('profile.index');
    }

    public function store(StorePengalamanRequest $request)
    {
        $userId = Auth::user()->id;

        $pengalaman = new Pengalaman($request->validated());
        $pengalaman->user_id = $userId;
        $pengalaman->save();

        return redirect()->route('pengalaman.index')->with('success', 'Pengalaman berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pengalaman = Pengalaman::findOrFail($id);
        return response()->json($pengalaman);
    }

    public function update(UpdatePengalamanRequest $request, Pengalaman $pengalaman)
    {
        $pengalaman->update($request->all());
        return redirect()->route('pengalaman.edit')->with('success', 'Pengalaman berhasil diperbarui.');
    }

    public function destroy(Pengalaman $pengalaman)
    {
        $pengalaman->delete();
        return redirect()->route('pengalaman.delete')->with('success', 'Pengalaman berhasil dihapus.');
    }
}
