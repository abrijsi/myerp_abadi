<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    // Tampilkan halaman view Blade
    public function index()
    {
        return view('sales.index'); // <-- jangan return JSON di sini
    }

    // Berikan data untuk DataTables
    public function getDatatables()
    {
        $sales = DB::table('salesinfo')
            ->join('customers', 'salesinfo.customerid', '=', 'customers.id')
            ->join('employee', 'salesinfo.employeeid', '=', 'employee.id')
            ->where('salesinfo.status', 0)
            ->where('salesinfo.saletype', '<>', 'pos')
            ->select(
                'salesinfo.id',
                'salesinfo.transdate',
                'salesinfo.ticketnumber',
                'salesinfo.nofaktur',
                'salesinfo.totalsales',
                DB::raw('(salesinfo.realsales + salesinfo.shippingcost) as realandship'),
                DB::raw('(salesinfo.totalsales + salesinfo.shippingcost) as totandship'),
                DB::raw('(salesinfo.totalsales + salesinfo.shippingcost - salesinfo.total) as sisahutang'),
                'salesinfo.total',
                'salesinfo.status',
                'salesinfo.overdue',
                'salesinfo.paymentdue',
                'customers.firstname',
                'customers.custcode',
                'employee.employeefname',
                'employee.empcode'
            )
            ->get();

        return response()->json(['data' => $sales]); // <--- hanya di sini
    }
}
