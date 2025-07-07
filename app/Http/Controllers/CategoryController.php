<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function index(){
        
        if(auth()->user()->usertype >= 1){
           
        $data=category::all();
        $products = Product::all();

        return view('admin.dashboard' , ['category'=>$data , 'products'=>$products]);
        } else {
           abort(403, 'Access Denied'); // Return a 403 Forbidden response if the user does not have permission
        }
        
    }

    public function create(Request $request){
        if(auth()->user()->usertype >= 1){
        $data = new category;
        $data->Category = $request->caregory;
        $data->refundable = $request->refundable == '1' ? true : false; // Convert to boolean
        $data->save();
        

        return redirect()->back()->with('msg', 'تم إضافة التصنيف');
        } else {
            abort(403, 'Access Denied'); // Return a 403 Forbidden response if the user does not have permission
        }
    }


    public function delete($id){
        if(auth()->user()->usertype >= 1){
        $data = category::Findorfail($id);
        $data->delete();

        return redirect()->back()->with('msg', 'تم حذف التصنيف');
        } else {
            abort(403, 'Access Denied'); // Return a 403 Forbidden response if the user does not have permission
        }
    }


}
