<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function order_add(OrderRequest $request)
    {
        foreach($request->food_names as $key => $food_name){

            $order = new Order;
            $order->food_name = $food_name;
            $order->price = $request->price[$key];
            $order->quantity = $request->quantity[$key];
            $order->name = auth()->user()->name;
            $order->phone = $request->phone;
            $order->address = $request->address;

            $order->save();
        }
        Session::flash('order_confirmed', "The order has been successfully placed.");

        return redirect()->back();
    }


    public function orders(){

        $orders = Order::all();

        return view('admin.orders',compact('orders'));
    }

    public function delete_order($id)
    {
        $order = Order::findOrFail($id);

        $order->delete();

        Session::flash('order_deleted', "The order has been successfully removed.");

        return redirect()->back();

    }

    public function search(Request $request)
    {
        $search = $request->search;

        $orders = Order::where('name','Like','%'.$search.'%')->orWhere('food_name','Like','%'.$search.'%')->get();

        return view('admin.orders',compact('orders'));
    }

}
