<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Billing;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');
    }

    public function dashboard()
    {
        return view('backend.dashboard');
    }

    public function Orders(){
        return view('backend.order.order',[
            'orders' => Order::latest()->simplepaginate(),
        ]);
    }

    public function OrderSearch(Request $request){

        $start = $request->start;
        $end = $request->end;
        return Order::whereBetween('created_at', [$start, $end])->get();
        // return $request->all();
    }
}
