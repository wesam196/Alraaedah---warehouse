<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\Product;


class CategoryController extends Controller
{
    public function index(){
        $data=category::all();
        $products = Product::all();

        return view('admin.dashboard' , ['category'=>$data , 'products'=>$products]);
    }

    public function create(Request $request){
        $data = new category;
        $data->Category = $request->caregory;
        $data->refundable = $request->refundable == '1' ? true : false; // Convert to boolean
        $data->save();

        return redirect()->back()->with('msg', 'تم إضافة التصنيف');
    }


    public function delete($id){
        $data = category::Findorfail($id);
        $data->delete();

        return redirect()->back()->with('msg', 'تم حذف التصنيف');

    }


}
