<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produksi;
use App\Models\Mitra;
use App\Models\Barang;

class ProduksiController extends Controller
{
    public function index()
    {
        $produksi = Produksi::all();
        $role = auth()->user()->role;
        $mitras = Mitra::all();
        $barang = Barang::all();
        return view('admin.produksi.index', compact('produksi', 'role', 'mitras', 'barang'));

    }

    public function create()
    {
        $produksi = Produksi::all();
        $mitras = Mitra::all();
        $barang = Barang::all();
        return view('admin.produksi.create', compact('produksi', 'mitras', 'barang'));
    }

    public function store(Request $request)
    {

            $request->validate([
                'product' => 'required',
                'jumlah' => 'required',
                'mitra' => 'required',
                'status' => 'required',
                'mulai' => 'required',
                'deadline' => 'required',
            ]);

            $requestData = $request->all();

            Produksi::create($requestData);

            return redirect()->route('produksi.index')->with('success', 'Barang berhasil disimpan.');

    }

    public function show($id)
    {
        $produksi = Produksi::find($id);
        $mitras = Mitra::all();
        $barang = Barang::all();
        return view('admin.produksi.show', compact('produksi', 'mitras', 'barang'));
    }

    public function edit($id)
    {
        $produksi = Produksi::find($id);
        $mitras = Mitra::all();
        return view('admin.produksi.edit', compact('produksi', 'mitras'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product' => 'required',
            'jumlah' => 'required',
            'mulai' => 'required',
            'deadline' => 'required',
            'status' => 'required',
            'mitra' => 'required',
        ]);

        $produksi = Produksi::find($id);
        $produksi->update($request->except('_token'));

        return redirect()->route('produksi.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $produksi = Produksi::find($id);
        $produksi->delete();

        return redirect()->route('produksi.index')->with('success', 'Barang berhasil dihapus.');
    }
}
