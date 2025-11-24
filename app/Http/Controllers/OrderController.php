<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
        ]);
        
        $menu = Menu::findOrFail($request->menu_id);
        
        $cart = session()->get('cart', []);
        
        if (isset($cart[$menu->id])) {
            $cart[$menu->id]['quantity'] += $request->quantity;
        } else {
            $cart[$menu->id] = [
                'menu_id' => $menu->id,
                'name' => $menu->name,
                'price' => $menu->price,
                'quantity' => $request->quantity,
                'merchant_id' => $menu->merchant_id,
                'merchant_name' => $menu->merchant->company_name,
            ];
        }
        
        session()->put('cart', $cart);
        
        return redirect()->back()->with('success', 'Menu added to cart');
    }
    
    public function cart()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return view('customer.cart', compact('cart', 'total'));
    }
    
    public function removeFromCart($menuId)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$menuId])) {
            unset($cart[$menuId]);
            session()->put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'Item removed from cart');
    }
    
    public function checkout(Request $request)
    {
        $request->validate([
            'delivery_date' => 'required|date|after_or_equal:today',
            'delivery_address' => 'required|string',
        ]);
        
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Cart is empty');
        }
        
        try {
            DB::beginTransaction();
            
            // Group cart items by merchant
            $merchantGroups = [];
            foreach ($cart as $item) {
                $merchantGroups[$item['merchant_id']][] = $item;
            }
            
            // Create order for each merchant
            foreach ($merchantGroups as $merchantId => $items) {
                $total = 0;
                
                $order = Order::create([
                    'user_id' => auth()->id(),
                    'merchant_id' => $merchantId,
                    'delivery_date' => $request->delivery_date,
                    'delivery_address' => $request->delivery_address,
                    'total' => 0,
                ]);
                
                foreach ($items as $item) {
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                    
                    OrderItem::create([
                        'order_id' => $order->id,
                        'menu_id' => $item['menu_id'],
                        'quantity' => $item['quantity'],
                        'unit_price' => $item['price'],
                        'subtotal' => $subtotal,
                    ]);
                }
                
                $order->update(['total' => $total]);
                
                // Create invoice
                Invoice::create([
                    'order_id' => $order->id,
                    'invoice_number' => 'INV-' . date('Ymd') . '-' . str_pad($order->id, 6, '0', STR_PAD_LEFT),
                    'amount' => $total,
                    'status' => 'unpaid',
                    'issued_at' => now(),
                ]);
            }
            
            DB::commit();
            
            session()->forget('cart');
            
            return redirect()->route('customer.orders')->with('success', 'Order placed successfully');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to place order: ' . $e->getMessage());
        }
    }

    public function downloadInvoice(Order $order)
    {
        $order->load([
            'invoice',
            'merchant',
            'orderItems.menu',
        ]);

        $pdf = Pdf::loadView('customer.orders.invoice-pdf', compact('order'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('Invoice-'.$order->invoice->invoice_number.'.pdf');
    }
}