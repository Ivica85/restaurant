<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function admin_home()
    {
        return view('admin.admin_home');
    }


    public function users()
    {
        $users = User::all();

        return view('admin.users',compact('users'));
    }

    public function delete_user($id)
    {
        $user = User::findOrFail($id);
        if ($user->user_type == 1) {
            Session::flash('access_denied', "You cannot delete an administrator.");
        } else {
            $user->delete();
            Session::flash('deleted_user', "The user has been deleted.");
        }

        return redirect()->back();
    }

}
