<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        $validated = $request->validate([
            'title' => 'required|string',
            'type'  => 'required|in:card,phone',
        ]);

        auth()->user()->orders()->create($validated);

        return redirect()->route('orders.index');
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'type' => [
                'required',
                Rule::in(['card', 'phone']),
            ],
            'status' => [
                'required',
                Rule::in(['new', 'process', 'succsess', 'canceled']),
            ],
        ]);

        $order->update($validated);

        return redirect()->route('admin.index');
    }

    public function destroy(Order $order)
    {
        if (auth()->user()->id !== $order->user_id && !auth()->user()->isAdmin()) {
            abort(403);
        }
        $order->delete();
        return redirect()->back();
    }
}
