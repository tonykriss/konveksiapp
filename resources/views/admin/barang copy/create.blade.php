@extends('layouts.vertical', ['title' => 'Tambah Barang', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
<div class="container">
    @include('layouts.shared/page-title', ['sub_title' => 'Tambah Barang', 'page_title' => 'Tambah Barang'])

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('barang.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="judul" class="form-label">Judul:</label>
                            <input type="text" name="judul" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="category_id" class="form-label">Category:</label>
                            <select name="supplier_id" class="form-control" required>
                                <option value="" disabled selected>Select Supplier</option>
                                @foreach($kategorys as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->product }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="supplier_id" class="form-label">Supplier:</label>
                            <select name="supplier_id" class="form-control" required>
                                <option value="" disabled selected>Select Supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->supplier }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="kode_barang" class="form-label">Kode Barang:</label>
                            <input type="text" name="kode_barang" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="harga_jual" class="form-label">Harga Jual:</label>
                            <input type="number" name="harga_jual" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group mb-3">
                            <label for="harga_pokok" class="form-label">Harga Pokok:</label>
                            <input type="number" name="harga_pokok" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="stok" class="form-label">Stok:</label>
                            <input type="number" name="stok" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="status" class="form-label">Status:</label>
                            <select name="status" class="form-select">
                                        <option value="Tersedia">Tersedia</option>
                                        <option value="Dibatalkan">Dibatalkan</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="keterangan" class="form-label">Keterangan:</label>
                            <select name="keterangan" class="form-select">
                                <option value="Barang Masuk">Barang Masuk</option>
                                <option value="Dibatalkan">Dari Client</option>
                    </select>                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection