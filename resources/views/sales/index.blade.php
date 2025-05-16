
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
        <div class="card-header border-bottom">
          <h4 class="card-title">Filter Data</h4>
        </div>
		<div class="card-body mt-2">
          <form class="dt_adv_search" method="POST">
            <div class="row g-1 mb-md-1">
              <div class="col-md-4">
                <label class="form-label">Name:</label>
                <input
                  type="text"
                  class="form-control dt-input dt-full-name"
                  data-column="1"
                  placeholder="Alaric Beslier"
                  data-column-index="0"
                />
              </div>
              <div class="col-md-4">
                <label class="form-label">Email:</label>
                <input
                  type="text"
                  class="form-control dt-input"
                  data-column="2"
                  placeholder="demo@example.com"
                  data-column-index="1"
                />
              </div>
              <div class="col-md-4">
                <label class="form-label">Post:</label>
                <input
                  type="text"
                  class="form-control dt-input"
                  data-column="3"
                  placeholder="Web designer"
                  data-column-index="2"
                />
              </div>
            </div>
            <div class="row g-1">
              <div class="col-md-4">
                <label class="form-label">City:</label>
                <input
                  type="text"
                  class="form-control dt-input"
                  data-column="4"
                  placeholder="Balky"
                  data-column-index="3"
                />
              </div>
              <div class="col-md-4">
                <label class="form-label">Date:</label>
                <div class="mb-0">
                  <input
                    type="text"
                    class="form-control dt-date flatpickr-range dt-input"
                    data-column="5"
                    placeholder="StartDate to EndDate"
                    data-column-index="4"
                    name="dt_date"
                  />
                  <input
                    type="hidden"
                    class="form-control dt-date start_date dt-input"
                    data-column="5"
                    data-column-index="4"
                    name="value_from_start_date"
                  />
                  <input
                    type="hidden"
                    class="form-control dt-date end_date dt-input"
                    name="value_from_end_date"
                    data-column="5"
                    data-column-index="4"
                  />
                </div>
              </div>
              <div class="col-md-4">
                <label class="form-label">Salary:</label>
                <input
                  type="text"
                  class="form-control dt-input"
                  data-column="6"
                  placeholder="10000"
                  data-column-index="5"
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
                <th></th>
                <th>Tanggal</th>
                <th>No Faktur</th>
                <th>Jumlah Faktur</th>
                <th>Jumlah Pembayaran</th>
                <th>Paid ?</th>
                <th>Telat ?</th>
				<th>Action</th>
              </tr>
            </thead>

            <tfoot>
              <tr>
                <th></th>
                <th>Tanggal</th>
                <th>No Faktur</th>
                <th>Jumlah Faktur</th>
                <th>Jumlah Pembayaran</th>
                <th>Paid ?</th>
                <th>Telat ?</th>
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
  {{-- Page js files --}}
  
  <script src="{{ asset(mix('js/scripts/tables/table-datatables-advanced.js')) }}"></script>
  
@endsection
