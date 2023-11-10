@extends('layouts.vertical', ['title' => 'Dashboard Konveksi', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])
@php
use App\Models\Barang;
use App\Models\Category;
use App\Models\Mitra;
use App\Models\Rak;
use App\Models\Distribusi;


$brall = Barang::all();
$crkain = Category::where('product', 'Kain')->first();

if ($crkain) {
    $crkainId = $crkain ? $crkain->id : 0;
} else {
    $crkainId = 0;
}

if ($brall) {
    $jml = $crkain ? Barang::where('category_id', $crkain->id)->count() : 0;
} else {
    $jml = 0;
};
$mitra = Mitra::count(); // Get the count of 'Mitra' records
$distribusi = Distribusi::sum('kuantitas');


$rak = Rak::count(); // Get the count of 'Rak' records
$mitra = Mitra::all()->count();
$rak = Rak::all()->count();
@endphp
@section('content')
@include('layouts.shared/page-title', ['sub_title' => 'Menu', 'page_title' => 'Dashboard'])

    <div class="row">
        <div class="col-xxl-3 col-sm-6">
            <div class="card widget-flat text-bg-pink">
                <div class="card-body">
                    <div class="float-end">
                        <i class=" ri-file-paper-2-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">Jumlah Kain </h6>
                    <h2 class="my-2">{{$jml}}</h2>
                    <p class="mb-0">
                        <span class="text-nowrap">Roll</span>
                    </p>
                </div>
            </div>
        </div> <!-- end col-->

        <div class="col-xxl-3 col-sm-6">
            <div class="card widget-flat text-bg-purple">
                <div class="card-body">
                    <div class="float-end">
                        <i class=" ri-user-fill widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">Kain Yang Terdistribusi</h6>
                    <h2 class="my-2">{{ number_format($distribusi) }}</h2>
                    <p class="mb-0">
                        <span class="text-nowrap">Pcs</span>
                    </p>
                </div>
            </div>
        </div> <!-- end col-->

        <div class="col-xxl-3 col-sm-6">
            <div class="card widget-flat text-bg-info">
                <div class="card-body">
                    <div class="float-end">
                        <i class=" ri-user-3-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">Total Mitra/Penjahit</h6>
                    <h2 class="my-2">{{$mitra}}</h2>
                    <p class="mb-0">
                        <span class="text-nowrap">mitra</span>
                    </p>
                </div>
            </div>
        </div> <!-- end col-->

        <div class="col-xxl-3 col-sm-6">
            <div class="card widget-flat text-bg-primary">
                <div class="card-body">
                    <div class="float-end">
                        <i class=" ri-layout-row-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">Jumlah Rak</h6>
                    <h2 class="my-2">{{$rak}}</h2>
                    <p class="mb-0">
                        <span class="text-nowrap"></span>
                    </p>
                </div>
            </div>
        </div> <!-- end col-->
    </div>
    <div class="row">

        <div class="col-xl-11 mt-3 mx-4">
            <!-- Todo-->
            <div class="card">
                <div class="card-body p-0">
                    <div class="p-3">
                        <div class="card-widgets">
                            <a href="javascript:;" data-bs-toggle="reload"><i class="ri-refresh-line"></i></a>
                            <a data-bs-toggle="collapse" href="#yearly-sales-collapse" role="button" aria-expanded="false" aria-controls="yearly-sales-collapse"><i class="ri-subtract-line"></i></a>
                            <a href="#" data-bs-toggle="remove"><i class="ri-close-line"></i></a>
                        </div>
                        <h5 class="header-title mb-0">Proses Produksi</h5>
                    </div>

                    <div id="yearly-sales-collapse" class="collapse show">

                        <div class="table-responsive">
                            <table class="table table-nowrap table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Deadline</th>
                                        <th>Status</th>
                                        <th>Mitra</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Kaos singlet</td>
                                        <td>250</td>
                                        <td>09/09/2023</td>
                                        <td>26/12/2023</td>
                                        <td><span class="badge bg-info-subtle text-info">Released</span></td>
                                        <td>Nustra Group</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Hijab Motif</td>
                                        <td>523</td>
                                        <td>09/09/2023</td>
                                        <td>26/12/2023</td>
                                        <td><span class="badge bg-info-subtle text-info">Released</span></td>
                                        <td>Kediri App Group</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Ciput</td>
                                        <td>563</td>
                                        <td>09/05/2023</td>
                                        <td>10/05/2023</td>
                                        <td><span class="badge bg-pink-subtle text-pink">Pending</span></td>
                                        <td>Kediri App Group</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Celana Dalam</td>
                                        <td>365</td>
                                        <td>09/09/2023</td>
                                        <td>31/12/2023</td>
                                        <td><span class="badge bg-purple-subtle text-purple">Work in Progress</span></td>
                                        <td>Nustra Group</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>

    <!-- end row -->
@endsection

@section('script')
    @vite(['resources/js/pages/dashboard.js'])
@endsection
