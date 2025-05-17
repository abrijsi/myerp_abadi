@extends('layouts/contentLayoutMaster')

@section('title', 'Input Sales Order')

@section('content')
<section id="sales-order-layout">
  <div class="row">
    <!-- Bagian 1: Informasi Umum -->
    <div class="col-md-6 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Informasi Karyawan & Penjualan</h4>
        </div>
        <div class="card-body">
          <form class="form form-horizontal">
            <div class="col-12">
              <div class="mb-1 row">
                <div class="col-sm-3">
                  <label class="col-form-label" for="employeeid">Kode Karyawan</label>
                </div>
                <div class="col-sm-9">
                  <div class="input-group">
					  <input type="text" id="employeeid" name="employeeid" class="form-control">
					  <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalCariKaryawan">
						Cari
					  </button>
					</div>
                </div>
              </div>
              <div class="mb-1 row">
                <div class="col-sm-3">
                  <label class="col-form-label" for="employeename">Nama Karyawan</label>
                </div>
                <div class="col-sm-9">
                  <input type="text" id="employeename" name="employeename" class="form-control" readonly />
                </div>
              </div>
              <div class="mb-1 row">
                <div class="col-sm-3">
                  <label class="col-form-label" for="deliverydate">Tanggal Kirim</label>
                </div>
                <div class="col-sm-9">
                  <input type="date" id="deliverydate" name="deliverydate" class="form-control" />
                </div>
              </div>
              <div class="mb-1 row">
                <div class="col-sm-3">
                  <label class="col-form-label" for="shippingmethod">Alat Pengiriman</label>
                </div>
                <div class="col-sm-9">
                  <input type="text" id="shippingmethod" name="shippingmethod" class="form-control" />
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Informasi Pelanggan</h4>
        </div>
        <div class="card-body">
          <form class="form form-horizontal">
            <div class="col-12">
              <div class="mb-1 row">
                <div class="col-sm-3">
                  <label class="col-form-label" for="customerid">Kode Pelanggan</label>
                </div>
                <div class="col-sm-9">
                  <div class="input-group">
					  <input type="text" id="customerid" name="customerid" class="form-control">
					  <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalCariPelanggan">
						Cari
					  </button>
					</div>
                </div>
              </div>
              <div class="mb-1 row">
                <div class="col-sm-3">
                  <label class="col-form-label" for="customername">Nama Pelanggan</label>
                </div>
                <div class="col-sm-9">
                  <input type="text" id="customername" name="customername" class="form-control" readonly />
                </div>
              </div>
              <div class="mb-1 row">
                <div class="col-sm-3">
                  <label class="col-form-label" for="alamat">Alamat</label>
                </div>
                <div class="col-sm-9">
                  <input type="text" id="alamat" name="alamat" class="form-control" readonly />
                </div>
              </div>
              <div class="mb-1 row">
                <div class="col-sm-3">
                  <label class="col-form-label" for="kota">Kota</label>
                </div>
                <div class="col-sm-9">
                  <input type="text" id="kota" name="kota" class="form-control" readonly />
                </div>
              </div>
              <div class="mb-1 row">
                <div class="col-sm-3">
                  <label class="col-form-label" for="telepon">Telepon</label>
                </div>
                <div class="col-sm-9">
                  <input type="text" id="telepon" name="telepon" class="form-control" readonly />
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bagian 2: Tabel Produk -->
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h4 class="card-title">Produk Dipesan</h4>
      <button
        type="button"
        class="btn btn-primary btn-sm"
        data-bs-toggle="modal"
        data-bs-target="#modalCariProduk"
      >
        <i data-feather="plus"></i> Tambah Produk
      </button>
    </div>
    <div class="card-datatable">
      <table class="table datatables-basic table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Produk</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Subtotal</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody id="order-items">
          <!-- Dinamis -->
        </tbody>
      </table>
    </div>
  </div>
  <div class="container">
  <div class="row justify-content-end">
    <div class="col-md-4">
      <div class="card mt-2">
        <div class="card-body">
          <div class="d-flex justify-content-between mb-1">
            <span>Subtotal</span>
            <strong id="subtotal-text">Rp 0</strong>
          </div>
          <div class="d-flex justify-content-between mb-1">
            <span>PPN (11%)</span>
            <strong id="ppn-text">Rp 0</strong>
          </div>
          <hr>
          <div class="d-flex justify-content-between">
            <span>Total</span>
            <strong id="total-text">Rp 0</strong>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- Modal Tambah Produk -->
<!-- Modal Cari Produk -->
<div class="modal fade" id="modalCariProduk" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cari Persediaan Barang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row mb-2">
          <div class="col-md-4">
            <label>Cari</label>
            <input type="text" id="search-barang" class="form-control" placeholder="Nama / Kode Barang">
          </div>
          <div class="col-md-3">
            <label>Kategori</label>
            <select id="kategori-barang" class="form-select">
              <option value="kode">Kode Barang</option>
              <option value="nama">Nama Barang</option>
            </select>
          </div>
        </div>
        <table id="tabel-barang" class="table table-bordered">
          <thead>
            <tr>
              <th>Kode Barang</th>
              <th>Nama Barang</th>
              <th>Jumlah</th>
              <th>Satuan</th>
              <th>Harga</th>
              <th>Pilih</th>
            </tr>
          </thead>
          <tbody>
            <!-- Data akan diisi dinamis -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Cari Pelanggan -->
<div class="modal fade" id="modalCariPelanggan" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cari Pelanggan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row mb-2">
          <div class="col-md-4">
            <label>Yang Dicari</label>
            <input type="text" id="search-pelanggan" class="form-control" placeholder="Kode / Nama / Kota">
          </div>
          <div class="col-md-3">
            <label>Kategori</label>
            <select id="kategori-pelanggan" class="form-select">
              <option value="all">ALL</option>
              <option value="kode">Kode</option>
              <option value="nama">Nama</option>
              <option value="kota">Kota</option>
            </select>
          </div>
        </div>
        <table id="tabel-pelanggan" class="table table-bordered">
          <thead>
            <tr>
              <th>Kode</th>
              <th>Nama Pelanggan</th>
              <th>Kota</th>
              <th>Pilih</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Cari Karyawan -->
<div class="modal fade" id="modalCariKaryawan" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cari Karyawan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row mb-2">
          <div class="col-md-4">
            <label>Yang Dicari</label>
            <input type="text" id="search-karyawan" class="form-control" placeholder="Kode / Nama">
          </div>
          <div class="col-md-3">
            <label>Kategori</label>
            <select id="kategori-karyawan" class="form-select">
              <option value="all">ALL</option>
              <option value="kode">Kode</option>
              <option value="nama">Nama</option>
            </select>
          </div>
        </div>
        <table id="tabel-karyawan" class="table table-bordered">
          <thead>
            <tr>
              <th>Kode Karyawan</th>
              <th>Nama Karyawan</th>
              <th>Pilih</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


@endsection

@section('page-script')
<script>
function openEmployeeSearch() {
  alert('Fitur pencarian karyawan belum diimplementasikan');
}

function openCustomerSearch() {
  alert('Fitur pencarian customer belum diimplementasikan');
}

function addOrderItem() {
  const tbody = document.getElementById('order-items');
  const row = document.createElement('tr');
  row.innerHTML = `
    <td></td>
    <td><input type="text" class="form-control" name="kode[]"></td>
    <td><input type="text" class="form-control" name="nama[]" readonly></td>
    <td><input type="number" class="form-control" name="qty[]"></td>
    <td><input type="number" class="form-control" name="harga[]"></td>
    <td><input type="number" class="form-control" name="subtotal[]" readonly></td>
    <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">Hapus</button></td>
  `;
  tbody.appendChild(row);
}
</script>
@endsection