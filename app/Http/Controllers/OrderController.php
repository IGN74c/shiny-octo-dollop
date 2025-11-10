<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->get();
        return view('orders', compact('orders'));
    }

    public function dashboard()
    {
        $orders = Order::all();
        return view('admin', compact('orders'));
    }

    public function store(Request $request)
    {
        auth()->user()->orders()->create($request->all());
        return redirect()->route('orders.index');
    }

    public function update(Request $request, Order $order)
    {
        $order->update(['status' => $request->type]);
        return redirect()->route('admin.index');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->back();
    }
}
