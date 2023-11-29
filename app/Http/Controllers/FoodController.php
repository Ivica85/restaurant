<?php

namespace App\Http\Controllers;

use App\Http\Requests\FoodRequest;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FoodController extends Controller
{
    public function food_admin_menu()
    {
        $foods = Food::all();
        return view('admin/food_admin_menu',compact('foods'));
    }


    public function upload_food(FoodRequest $request)
    {

        // Čuvanje hrane
        $food = new Food;
        $food->name = $request->input('name');
        $food->price = $request->input('price');
        $food->description = $request->input('description');

        // Čuvanje slike
        $image = $request->file('image');
        $imagename = time().'.'.$image->getClientOriginalExtension();
        $request->image->move('food_images',$imagename);
        $food->image = $imagename;

        $food->save();

        Session::flash('uploaded_food', "Food successfully added.");
        return redirect()->back();
    }

    public function delete_food($id)
    {
        $food = Food::findOrFail($id);
        $imagePath = public_path('food_images/' . $food->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $food->delete();

        Session::flash('deleted_food', "Food successfully deleted.");
        return redirect()->back();
    }


    public function edit_food($id)
    {
        $food = Food::findOrFail($id);
        return view('admin.update_food',compact('food'));
    }


    public function update_food(FoodRequest $request, $id)
    {

        $food = Food::findOrFail($id);
        $food->name = $request->input('name');
        $food->price = $request->input('price');
        $food->description = $request->input('description');


        if ($request->hasFile('image')) {
            // Brisanje stare slike
            $oldImagePath = public_path('food_images/' . $food->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            // Postavljanje nove slike
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('food_images', $imagename);
            $food->image = $imagename;
        }

        $food->save();

        Session::flash('updated_food', "Food successfully updated.");
        return redirect()->back();
    }

}
