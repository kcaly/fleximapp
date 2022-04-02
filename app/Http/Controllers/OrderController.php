<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    
    public function create(Request $request)
    {
        
        $order = new Order();
        $order->name = $request->name;
        $order->date_order = $request->date;
        $order->save();

        return redirect()->route('order.list')->with('message', 'Pomyślnie dodano nowe zamówienie.');

    }


    public function orders_products_show($id)
    {
        
            $order = Order::find($id);
            $order_products = $order->products;
            
            return view('order-details', compact('order_products'), compact('order'));

    }


    public function orders_products_new($order_id)
    {
            $order = Order::find($order_id);
            


            return view('order-product-add', compact('order'));

    }


    public function orders_products_add(Request $request)
    {

        $order = Order::find($request->order_id);
        
        $order->products()->attach($request->product_id, array('amount' => $request->amount));



        $order_products = $order->products;
        


        return view('order-details', compact('order_products'), compact('order'));

    }

    
    public function order_product_delete($order_id, $product_id, $amount)
    {


        $order = Order::find($order_id);
        $order->products()->where('id', $product_id)->wherePivot('product_id', $product_id)->wherePivot('amount', $amount)->detach();


        $order_products = $order->products;
        return view('order-details', compact('order_products'), compact('order'));

    }


    public function order_delete($id)
    {
      
        Order::where('id', $id)->delete();

        return view('order-list')->with('message', 'Usunięto zamówienie.');

    }

    public function update(Request $request)
    {
        
        $order = Order::find($request->id);
        $order->name = $request->name;
        if (!$request->date_order == null){
        $order->date_order = $request->date_order;
        }
        if (!$request->date_production == null)
        {
            $order->date_production = $request->date_production;
        }
        else
        {
            $order->date_production = null;
        }
        $order->save();

        return redirect()->route('order.list')->with('message', 'Pomyślnie zapisano zamówienie.');

    }

    public function edit($id)
    {
        $order = Order::find($id);
        return view('order-edit', compact('order'));
    }
    
}






