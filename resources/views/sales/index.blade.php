
@extends('layouts/contentLayoutMaster')

@section('title', 'Tabel Penjualan')

@section('vendor-style')
  {{-- vendor css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" type="text/css" href="{{asset('css/base/plugins/forms/pickers/form-flat-pickr.css')}}">
@endsection


@section('content')
<div class="row">
  <div class="col-12">
    <!--<p>Read full documnetation <a href="https://datatables.net/" target="_blank">here</a></p>-->
  </div>
</div>


<!-- Complex Headers -->
<section id="complex-header-datatable">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header border-bottom d-flex justify-content-between align-items-center">
		  <h4 class="card-title">Filter Data</h4>
		  <a href="" class="btn btn-primary">
			<i data-feather="plus"></i> Buat Faktur
		  </a>
		</div>
		
		<div class="card-body mt-2">
          <form class="dt_adv_search" method="POST">
            <div class="row g-1 mb-md-1">
              <div class="col-md-4">
				  <label class="form-label">No Faktur:</label>
				  <input
					type="text"
					class="form-control dt-input"
					data-column="1"
					placeholder="Cari No Faktur"
				  />
				</div>
				<div class="col-md-4">
				  <label class="form-label">Kode Pelanggan:</label>
				  <input
					type="text"
					class="form-control dt-input"
					data-column="6"
					placeholder="Cari Kode Pelanggan"
				  />
				</div>
				<div class="col-md-4">
				  <label class="form-label">Nama Pelanggan:</label>
				  <input
					type="text"
					class="form-control dt-input"
					data-column="7"
					placeholder="Cari Nama Pelanggan"
				  />
				</div>
            </div>
          </form>
        </div>
		<hr class="my-0" />
        <div class="card-datatable">
          <table class="dt-advanced-search table">
            <thead>
              <tr>
               
                <th>Tanggal</th>
                <th>No Faktur</th>
                <th>Jumlah Faktur</th>
                <th>Jumlah Pembayaran</th>
                <th>Paid ?</th>
                <th>Telat ?</th>
				<th>Kode Pelanggan</th>
				<th>Nama Pelanggan</th>
				<th>Action</th>
              </tr>
            </thead>

            <tfoot>
              <tr>          
                <th>Tanggal</th>
                <th>No Faktur</th>
                <th>Jumlah Faktur</th>
                <th>Jumlah Pembayaran</th>
                <th>Paid ?</th>
                <th>Telat ?</th>
				<th>Kode Pelanggan</th>
				<th>Nama Pelanggan</th>
				<th>Action</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ Complex Headers -->

@endsection


@section('vendor-script')
  {{-- vendor files --}}
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap4.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection



@section('page-script')
<script>
'use strict';

// Injeksi data langsung dari controller


// Normalize tanggal (untuk filter range)
function normalizeDate(dateString) {
  const date = new Date(dateString);
  return date.getFullYear() + '' + ('0' + (date.getMonth() + 1)).slice(-2) + '' + ('0' + date.getDate()).slice(-2);
}

// Filter berdasarkan range tanggal
function filterByDate(column, startDate, endDate) {
  $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
    const rowDate = normalizeDate(data[column]);
    const start = normalizeDate(startDate);
    const end = normalizeDate(endDate);
    return (start <= rowDate && rowDate <= end);
  });
}

// Event filter kolom
function filterColumn(i, val) {
  if (i === 5) {
    const startDate = $('.start_date').val();
    const endDate = $('.end_date').val();
    if (startDate !== '' && endDate !== '') {
      filterByDate(i, startDate, endDate);
    }
    $('.dt-advanced-search').DataTable().draw();
  } else {
    $('.dt-advanced-search').DataTable().column(i).search(val, false, true).draw();
  }
}

$(function () {
  // Inisialisasi DateRangePicker
  $('.flatpickr-range').flatpickr({
    mode: 'range',
    dateFormat: 'm/d/Y',
    onClose: function (selectedDates) {
      if (selectedDates.length === 2) {
        const start = selectedDates[0];
        const end = selectedDates[1];
        $('.start_date').val(`${start.getMonth() + 1}/${start.getDate()}/${start.getFullYear()}`);
        $('.end_date').val(`${end.getMonth() + 1}/${end.getDate()}/${end.getFullYear()}`);
        $(this).trigger('change').trigger('keyup');
      }
    }
  });

 //--
 //--
const table = $('.dt-advanced-search').DataTable({
  processing: true,
  serverSide: true,
  searching: false, 
  ajax: '{{ route("sales.tabel") }}', // ini akan ambil JSON dari controller getData()
  columns: [
    {
      data: 'transdate',
      title: 'Tanggal',
      render: function (data, type, row) {
        if (type === 'display' || type === 'filter') {
          const date = new Date(data);
          const day = String(date.getDate()).padStart(2, '0');
          const month = String(date.getMonth() + 1).padStart(2, '0');
          const year = date.getFullYear();
          return `${day}-${month}-${year}`;
        }
        return data;
      }
    },
    { data: 'nofaktur', title: 'No Faktur' },
    {
      data: 'totalsales',
      title: 'Jumlah Faktur',
      className: 'text-end',
      render: data => `Rp. ${new Intl.NumberFormat('id-ID').format(data)}`
    },
    {
      data: 'total',
      title: 'Jumlah Pembayaran',
      className: 'text-end',
      render: data => `Rp. ${new Intl.NumberFormat('id-ID').format(data)}`
    },
    {
      data: 'status',
      title: 'Paid?',
      render: data => data == 1 ? 'Ya' : 'Tidak'
    },
    {
      data: 'overdue',
      title: 'Telat?',
      render: data => data == 1 ? 'Ya' : 'Tidak'
    },
    { data: 'firstname', title: 'Kode Pelanggan' },
    { data: 'custcode', title: 'Nama Pelanggan' },
    {
      data: null,
      orderable: false,
      searchable: false,
      render: function (data, type, row) {
        return `
          <a href="/sales/${row.id}/edit" class="btn btn-sm btn-primary">Edit</a>
        `;
      }
    }
  ]
});

$('#search-box').on('keyup', function () {
  table.search(this.value).draw();
});

$('input.dt-input').on('keyup change', function () {
  table
    .column($(this).data('column'))
    .search(this.value)
    .draw();
});

//

  // Styling: Hilangkan size kecil
  $('.dataTables_filter .form-control').removeClass('form-control-sm');
  $('.dataTables_length .form-select').removeClass('form-select-sm').removeClass('form-control-sm');
});
</script>
@endsection
