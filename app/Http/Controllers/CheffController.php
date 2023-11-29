<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChefRequest;
use App\Models\FoodChef;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheffController extends Controller
{
    public function chefs()
    {
        $chefs = FoodChef::all();
        return view('admin.chefs',compact('chefs'));
    }


    public function upload_chef(ChefRequest $request)
    {
        $chef = new FoodChef;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('chef_images', $imagename);
            $chef->image = $imagename;
        }
        $chef->name = $request->name;
        $chef->speciality = $request->speciality;

        $chef->save();
        Session::flash('chef_uploaded', "Chef successfully added.");

        return redirect()->back();
    }


    public function edit_chef($id)
    {
        $chef = FoodChef::findOrFail($id);

        return view('admin/update_chef',compact('chef'));
    }

    public function update_chef(ChefRequest $request, $id)
    {
        $chef = FoodChef::findOrFail($id);
        $chef->name = $request->input('name');
        $chef->speciality = $request->input('speciality');

        if ($request->hasFile('image')) {
            // Brisanje stare slike
            $oldImagePath = public_path('chef_images/' . $chef->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            // Postavljanje nove slike
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move('chef_images', $imagename);
            $chef->image = $imagename;
        }


        $chef->save();

        Session::flash('updated_chef', "Chef successfully updated.");
        return redirect()->back();
    }

    public function delete_chef($id)
    {
        $chef = FoodChef::findOrFail($id);

        $imagePath = public_path('chef_images/' . $chef->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $chef->delete();

        Session::flash('delete_chef', "Chef successfully deleted.");

        return redirect()->back();
    }


}
