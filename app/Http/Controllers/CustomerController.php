<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display customer dashboard
     */
    public function dashboard()
    {
        return view('customer.dashboard');
    }

    /**
     * Display merchants list
     */
    public function merchants()
    {
        $merchants = Merchant::paginate(12);
        return view('customer.merchants', compact('merchants'));
    }

    /**
     * Display merchant detail with menu
     */
    public function merchantDetail(Merchant $merchant)
    {
        $merchant->load('menus');
        return view('customer.merchant-detail', compact('merchant'));
    }

    /**
     * Display customer orders list
     */
    public function orders()
    {
        $orders = auth()->user()
            ->orders()
            ->with(['merchant', 'invoice', 'orderItems'])
            ->latest()
            ->paginate(10);
        
        return view('customer.orders.index', compact('orders'));
    }

    /**
     * Display order detail
     */
    public function orderDetail($id)
    {
        $order = auth()->user()
            ->orders()
            ->with(['merchant', 'invoice', 'orderItems.menu'])
            ->findOrFail($id);
        
        return view('customer.orders.show', compact('order'));
    }
}