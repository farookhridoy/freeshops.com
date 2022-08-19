<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use DataTables;

class EarningController extends Controller
{
    public function all(Request $req)
    {
        $dateFrom = Carbon::now()->subDays(30);
        $dateTo = Carbon::now();

        $previousDateFrom = Carbon::now()->subDays(60);
        $previousDateTo = Carbon::now()->subDays(31);

        $list = Transaction::with('user', 'orders')->orderBy('created_at', 'DESC')->get();
        $total_earning = Transaction::sum('amount');
        $monthly = Transaction::whereBetween('created_at', [$dateFrom, $dateTo])->sum('amount');
        $previousMonthly = Transaction::whereBetween('created_at', [$previousDateFrom, $previousDateTo])->sum('amount');

        if ($previousMonthly < $monthly ) {
            if($previousMonthly > 0) {
                $percent_from = $monthly - $previousMonthly;
                $percent = array(
                    'dir' => 'up',
                    'fig' => $percent_from / $previousMonthly * 100,
                );
            } else {
                $percent = array(
                    'dir' => 'up',
                    'fig' => 100,
                );
            }
        } else {
            $percent_from = $previousMonthly - $monthly;
            $percent = array(
                'dir' => 'down',
                'fig' => $percent_from / $previousMonthly * 100,
            );
        }

        if ($req->ajax()) {
            return Datatables::of($list)
                ->addColumn('id', function($row) {
                    return $row->id;
                })
                ->addColumn('date', function($row) {
                    return $row->created_at->format('d/m/Y');
                })
                ->addColumn('buyer', function($row) {
                    return $row->user->name;
                })
                ->addColumn('amount', function($row) {
                    return "$".$row->amount;
                })
                ->addColumn('details', function($row) {
                    return '<a href="">View Orders</a>';
                })
                ->rawColumns(['date','buyer','amount','details'])
                ->make(true);
        } else {
            return view('admin.earnings.all', get_defined_vars());
        }
    }
}
