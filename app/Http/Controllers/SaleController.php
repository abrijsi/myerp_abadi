<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function getDatatables(Request $request)
{
    $query = DB::table('salesinfo')
        ->join('customers', 'salesinfo.customerid', '=', 'customers.id')
        ->join('employee', 'salesinfo.employeeid', '=', 'employee.id')
        ->where('salesinfo.status', 0)
        ->where('salesinfo.saletype', '<>', 'pos')
        ->select(
            'salesinfo.id',
            'salesinfo.transdate',
            'salesinfo.nofaktur',
            'salesinfo.totalsales',
            'salesinfo.total',
            'salesinfo.status',
            'salesinfo.overdue',
            'customers.firstname',
            'customers.custcode'
        );

    // === FILTER PER KOLOM ===
    $columns = $request->get('columns');

    if (!empty($columns[1]['search']['value'])) {
        $query->where('salesinfo.nofaktur', 'like', '%' . $columns[1]['search']['value'] . '%');
    }

    if (!empty($columns[6]['search']['value'])) {
        $query->where('customers.firstname', 'like', '%' . $columns[6]['search']['value'] . '%');
    }

    if (!empty($columns[7]['search']['value'])) {
        $query->where('customers.custcode', 'like', '%' . $columns[7]['search']['value'] . '%');
    }

    // === HITUNG ===
    $recordsFiltered = $query->count();
    $recordsTotal = DB::table('salesinfo')->where('status', 0)->where('saletype', '<>', 'pos')->count();

    // === ORDER & PAGINATION ===
    $orderColIndex = $request->input('order.0.column', 0);
    $orderDir = $request->input('order.0.dir', 'asc');
    $columnsOrder = [
        'salesinfo.transdate',
        'salesinfo.nofaktur',
        'salesinfo.totalsales',
        'salesinfo.total',
        'salesinfo.status',
        'salesinfo.overdue',
        'customers.firstname',
        'customers.custcode'
    ];
    $query->orderBy($columnsOrder[$orderColIndex] ?? 'salesinfo.transdate', $orderDir);

    $start = $request->input('start', 0);
    $length = $request->input('length', 10);
    $data = $query->skip($start)->take($length)->get();

    return response()->json([
        'draw' => intval($request->input('draw')),
        'recordsTotal' => $recordsTotal,
        'recordsFiltered' => $recordsFiltered,
        'data' => $data,
    ]);
}

public function index()
{
    return view('sales.index'); // tanpa ambil data
}
public function input()
{
    return view('sales.input'); // tanpa ambil data
}

}
	