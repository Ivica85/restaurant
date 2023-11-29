<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Food;
use App\Models\FoodChef;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{


    public function index()
    {
        $foods = Food::all();
        $chefs = FoodChef::all();
        $user_id = Auth::id();

        $count = Cart::where('user_id',$user_id)->count();

        return view('home',compact('foods','chefs','count'));
    }


}
