<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function add_cart(Request $request, $id)
    {
        if(Auth::id()){
            $user_id = Auth::id();
            $food_id = $id;
            $quantity = $request->quantity;

            $cart = new Cart();
            $cart->user_id = $user_id;
            $cart->food_id = $food_id;
            $cart->quantity = $quantity;

            $cart->save();

            return redirect()->back();
        }

    }


    public function show_cart($id)
    {

        $count = Cart::where('user_id',$id)->count();

        $orders = Cart::select('*')->where('user_id','=',$id)->get();

        $foods = Cart::where('user_id',$id)->join('food','carts.food_id','=','food.id')->get();

        $totalPriceForAll = 0;

        foreach ($foods as $food) {
            $totalPriceForAll += $food->price * $food->quantity;
        }

        return view('show_cart',compact('count','foods','orders','totalPriceForAll'));
    }


    public function delete_cart($id)
    {
        $cart = Cart::findOrFail($id);

        $cart->delete();

        Session::flash('delete_cart', "Cart removed.");

        return redirect()->back();
    }

}
