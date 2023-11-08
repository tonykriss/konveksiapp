<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distribusi;
use App\Models\Mitra;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;

class DistribusiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $distribusiData = Distribusi::all();
        $mitras= Mitra::all();
        return view('admin.distribusi.index', compact('distribusiData', 'mitras'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'mitra_id' => 'required',
            'kode_barang' => 'required',
            'kuantitas' => 'required|numeric',
        ]);

        Distribusi::create($request->all());
        return redirect()->route('distribusi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $distribusiData = Distribusi::where('mitra_id', $id)->get();
        $mitras = Mitra::all();
        $barangs = Barang::all();

        return view('admin.distribusi.history', compact('distribusiData', 'mitras', 'barangs'));
    }

    public function edit($id)
    {
        $barang = Barang::all();
        $mitra = Mitra::find($id);
        $distribusi = Distribusi::find($id);
        return view('admin.distribusi.edit', compact('distribusi', 'barang', 'mitra'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Distribusi $distribusi)
    {
        $request->validate([
            'mitra_id' => 'required',
            'kode_barang' => 'required',
            'kuantitas' => 'required|numeric',
        ]);

        $distribusi->update($request->all());
        return redirect()->route('distribusi.index');    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $distribusi->delete();
        return redirect()->route('distribusi.index');
    }
}
