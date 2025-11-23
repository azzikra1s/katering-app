<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Models\Order;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    public function dashboard()
    {
        $merchant = auth()->user()->merchant;
        
        if (!$merchant) {
            return redirect()->route('merchant.profile')->with('info', 'Please complete your merchant profile first');
        }
        
        $totalOrders = Order::where('merchant_id', $merchant->id)->count();
        $totalRevenue = Order::where('merchant_id', $merchant->id)->sum('total');
        $totalMenus = $merchant->menus()->count();
        
        return view('merchant.dashboard', compact('merchant', 'totalOrders', 'totalRevenue', 'totalMenus'));
    }
    
    public function profile()
    {
        $merchant = auth()->user()->merchant;
        return view('merchant.profile', compact('merchant'));
    }
    
    public function updateProfile(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string|max:20',
            'description' => 'nullable|string',
        ]);
        
        $merchant = auth()->user()->merchant;
        
        if (!$merchant) {
            $merchant = Merchant::create([
                'user_id' => auth()->id(),
                'company_name' => $request->company_name,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'description' => $request->description,
            ]);
        } else {
            $merchant->update($request->only(['company_name', 'address', 'phone_number', 'description']));
        }
        
        return redirect()->route('merchant.dashboard')->with('success', 'Profile updated successfully');
    }
    
    public function orders()
    {
        $merchant = auth()->user()->merchant;
        
        if (!$merchant) {
            return redirect()->route('merchant.profile')->with('error', 'Please setup merchant profile first');
        }
        
        $orders = Order::where('merchant_id', $merchant->id)
            ->with(['user', 'orderItems.menu', 'invoice'])
            ->latest()
            ->paginate(10);
        
        return view('merchant.orders', compact('orders'));
    }
    
    public function orderDetail(Order $order)
    {
        $merchant = auth()->user()->merchant;
        
        if (!$merchant || $order->merchant_id !== $merchant->id) {
            abort(403);
        }
        
        $order->load(['user', 'orderItems.menu', 'invoice']);
        
        return view('merchant.order-detail', compact('order'));
    }
}