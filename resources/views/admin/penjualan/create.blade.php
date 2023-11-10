@extends('layouts.vertical', ['title' => 'Tambah Barang', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
<div class="container">
    @include('layouts.shared/page-title', ['sub_title' => 'Penjualan', 'page_title' => 'Tambah Penjualan'])

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('history.store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
<!-- Add this HTML code inside your form -->
                        <div class="form-group mb-3">
                            <label for="judul" class="form-label">Judul:</label>
                            <select class="select2 form-select" id="judulSelector" name="judul" id="product-name-input">
                                <option value="">Pilih barang</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="jumlah" class="form-label">Jumlah:</label>
                            <input type="number" class="jml form-control" name="supplier" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="category" class="form-label">Kategori:</label>
                            <input type="text" class="category form-control" name="category" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="supplier" class="form-label">Supplier:</label>
                            <input type="text" class="supplier form-control" name="supplier" required>
                        </div>
                        <div class="form-group mb-3">
                            <!-- Display the selected "Judul" here -->
                            <label for="selected-judul" class="form-label">Stok Sekarang:</label>
                            <span id="stok"></span>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="kode_produk" class="form-label">Kode Produk:</label>
                            <input type="text" class="kode_produk form-control" name="kode_produk" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="satuan" class="form-label">Harga Satuan:</label>
                            <input type="text" class="satuan form-control" name="satuan" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="total" class="form-label">Harga Total:</label>
                            <input type="text" class="total form-control" name="total" required>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <button id="simpanButton" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table id="temporary-table" class="table">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Jumlah</th>
                                    <th>Kategori</th>
                                    <th>Supplier</th>
                                    <th>Kode Produk</th>
                                    <th>Harga Satuan</th>
                                    <th>Harga Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data rows will be added here dynamically -->
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12">
                        <button id="kirimDataButton" class="btn btn-primary">Kirim Data</button>

                        <button id="hapusisitabel" class="btn btn-danger ms-3">Hapus Data</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    .logo-lg {
        display: none;
    }
    .logo-dark {
        display: none;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" />

<script>
var jsonData = null;
var selectedJudul = null;

function filterAndDisplayData() {
    var selectedItem = jsonData.data.find(function(item) {
        return item.judul == selectedJudul;
    });

    if (selectedItem) {
        var detailDiv = $('.detail');
        var categoryInput = $('.category');
        var supplierInput = $('.supplier');
        var satuan = $('.satuan');
        var kode_produk = $('.kode_produk');
        var total = $('.total');

        var jml = $('.jml').val();

        detailDiv.empty();
        var harga = parseInt(selectedItem.harga_jual);

        getCategoryName(selectedItem.category_id).then(function(categoryName) {
            categoryInput.val(categoryName);
        });

        getSupplierName(selectedItem.supplier_id).then(function(supplierName) {
            supplierInput.val(supplierName);
        });

        getSatuanName(selectedItem.satuan).then(function(satuanName) {
            $('#stok').text(selectedItem.stok + " " + satuanName);
        });

        satuan.val(harga);
        kode_produk.val(selectedItem.kode_barang);
        if (jml) {
            var totalHarga = harga * parseInt(jml);
            total.val(totalHarga);
        }
    }
}

function getCategoryName(categoryId) {
    return new Promise(function(resolve, reject) {
        $.ajax({
            url: '/api/kategori/' + categoryId,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                resolve(data.product);
            },
            error: function(error) {
                reject(error);
            }
        });
    });
}

function getSatuanName(satuanId) {
    return new Promise(function(resolve, reject) {
        $.ajax({
            url: '/api/satuan/' + satuanId,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log(data); // Add this line for debugging
                resolve(data.nama);
            },
            error: function(error) {
                reject(error);
            }
        });
    });
}

function getSupplierName(supplierId) {
    return new Promise(function(resolve, reject) {
        $.ajax({
            url: '/api/supplier/' + supplierId,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                resolve(data.supplier);
            },
            error: function(error) {
                reject(error);
            }
        });
    });
}

function generateRandomString() {
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var length = 10; // Adjust the length as needed
    var randomString = '';
    for (var i = 0; i < length; i++) {
        var randomIndex = Math.floor(Math.random() * characters.length);
        randomString += characters.charAt(randomIndex);
    }
    return randomString;
}

$(document).ready(function() {
    // Event handler for the "Kirim Data" button and Shift+Enter
    $('body').on('keydown', function(event) {
        if (event.key === 'Enter' && event.shiftKey) {
            event.preventDefault();
            $('#kirimDataButton').trigger('click');
        }
    });

    $('#hapusisitabel').on('click', function(event) {
    $('#temporary-table tbody').empty();
})

    $('#judulSelector').select2();
    var judulSelector = $('#judulSelector');
    var inputFields = $('.form-control');
    var temporaryTable = $('#temporary-table');

    $.ajax({
        url: '/api/barang',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            jsonData = data;
            $.each(data.data, function(index, item) {
                judulSelector.append($('<option>', {
                    value: item.judul,
                    text: item.judul
                }));
            });

            judulSelector.on('change', function() {
                selectedJudul = $('.select2').val();
                filterAndDisplayData();
                var selectedItem = null;
                console.log("Selected Judul: " + selectedJudul);
            });

            $('.jml').on('input', function() {
                filterAndDisplayData();
            });

            // Handle form submission
            // Event handler for the "Simpan" button
            $('#simpanButton').on('click', function(event) {
                event.preventDefault();

                // Save input data to the temporary table
                var rowData = [];
                inputFields.each(function(index, input) {
                    var value = $(input).val();
                    rowData.push(value);
                });

                // Add the selected "Judul" value to the data
                rowData.unshift(selectedJudul);

                var row = $('<tr></tr>');
                rowData.forEach(function(value) {
                    row.append($('<td>' + value + '</td>'));
                });
                temporaryTable.find('tbody').append(row);

                // Clear input fields and the selected "Judul"
                inputFields.val('');
                $('#selectedJudul').text('');
            });

            // Event handler for the "Kirim Data" button
// Event handler for the "Kirim Data" button
// Event handler for the "Kirim Data" button
$('#kirimDataButton').on('click', function(event) {
    event.preventDefault();
    var rowData = [];
    $('#temporary-table tbody tr').each(function() {
        var row = [];
        $(this).find('td').each(function() {
            row.push($(this).text());
        });
        rowData.push(row);
    });
    sendPenjualanDataToServer(rowData);
});

// Function to send data to the server
function sendPenjualanDataToServer(data) {
    var kode_transaksi = generateRandomString();
    var modifiedData = data.map(function(row) {
        return {
            kode_barang: row[4], // Kode Produk
            category_id: jsonData.data.find(item => item.judul === row[0]).category_id,
            supplier_id: jsonData.data.find(item => item.judul === row[0]).supplier_id,
            harga_pokok: row[5], // Harga Satuan
            harga_jual: row[6], // Harga Total
            stok: row[1], // Jumlah
            status: "jual",
            kode_transaksi: kode_transaksi, // Random string generation
            keterangan: "penjualan"
        };
    });

    Swal.fire({
        title: 'Transaksi Penjualan Berhasil',
        text: 'Unduh Bukti Transaksi?',
        icon: 'success',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirect to the new page with the transaction ID
            window.location.href = '/admin/cetakpdf/' + kode_transaksi + '?title=Nota Pembelian';
        }
    });

    // Loop through the modified data and send each array separately
    modifiedData.forEach(function(postData) {
        // Make an AJAX POST request for each row
        $.ajax({
            url: '/api/history', // Replace with the actual API endpoint URL
            type: 'POST',
            data: JSON.stringify(postData), // Convert the data to JSON format
            contentType: 'application/json', // Set the content type to JSON
            dataType: 'json',
            success: function(response) {
                // Handle the response from the server, e.g., show a success message
                console.log('Data sent successfully:', response);
            },
            error: function(error) {
                // Handle any errors that occur during the request
                console.error('Error sending data:', error);
            }
        });
    });

    // Clear the temporary table after successful submission
    $('#temporary-table tbody').empty();
}



        }
    });
});

</script>
