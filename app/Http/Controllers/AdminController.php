<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChefRequest;
use App\Http\Requests\FoodRequest;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\ReservationRequest;
use App\Models\Cart;
use App\Models\Food;
use App\Models\FoodChef;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use function Termwind\renderUsing;

class AdminController extends Controller
{

    public function admin_home()
    {
        return view('admin.admin_home');
    }


}
