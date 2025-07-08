<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product ;
use App\Models\Category;


class ProductController extends Controller
{

    public function index()
    {
        $data = Product::all();
        $category = Category::all(); // Get all categories for the dropdown
        return view('welcome', ['products' => $data, 'category' => $category]);
    }


   public function create(Request $request)
   {
    if(auth()->user()->usertype >= 1){
    
    $category = Category::findOrFail($request->category);
         // Validate the request data
       $data = new Product;
       $data->productName = $request->productName;
       $data->quantity = $request->quantity;
       $data->category = $request->category; 
        $data->pledge = 0;       
       $data->save();

       return redirect()->back()->with('msg', 'تم إضافة المنتج');
    }
    else {
        abort(403, 'Access Denied'); // Return a 403 Forbidden response if the user does not have permission
    }
   
   }

    public function delete($id)
    {
        if(auth()->user()->usertype >= 1){
         $data = Product::findOrFail($id);
         $data->delete();
    
         return redirect()->back()->with('msg', 'تم حذف المنتج');
        } else {
            abort(403, 'Access Denied'); // Return a 403 Forbidden response if the user does not have permission
    }
    }

    public function edit($id)
    {
        if(auth()->user()->usertype >= 1){
        $data = Product::findOrFail($id);
        $categories = Category::all(); // Get all categories for the dropdown
        return view('admin.edit_product', ['product' => $data, 'categories' => $categories]);
        } else {
            abort(403, 'Access Denied'); // Return a 403 Forbidden response if the user does not have permission
        }
    }

    public function update(Request $request, $id)
    {
        if(auth()->user()->usertype >= 1){
        $category = Category::findOrFail($request->category);
        $data = Product::findOrFail($id);
        $data->productName = $request->productName;
        $data->quantity = $request->quantity;
        $data->category = $request->category; 
        if($category->refundable==true) {
            $data->pledge = $request->pledge; // Update the pledge field only if the category is refundable
        } else {
            $data->pledge = 0; // Set pledge to 0 if the category is not refundable
        }
        $data->save();

        return redirect('/dashboard')->with('msg', 'تم تحديث المنتج');
    }
    else {
        abort(403, 'Access Denied'); // Return a 403 Forbidden response if the user does not have permission
    }
    }



    public function editPledge($id)
    {
        $data = Product::findOrFail($id);
        $category = Category::findOrFail($data->category);

        if($category->refundable==true) {
            $data->pledge +=1; // Update the pledge field only if the category is refundable
        } else {
            $data->quantity -=1; // Set pledge to 0 if the category is not refundable
        }
        $data->save();



        return redirect()->back()->with('msg', 'تم تسجيل العهدة بنجاح');
    
}


    public function returnPledge($id)
    {
        $data = Product::findOrFail($id);
        $category = Category::findOrFail($data->category);

        if($category->refundable==true && $data->pledge > 0) {
            $data->pledge -=1; // Update the pledge field only if the category is refundable
        $data->save();
        
        
        return redirect()->back()->with('msg', 'تم ارجاع العهدة بنجاح');
         
    }
    else {
        abort(404); // Return a 403 Forbidden response if the user does not have permission
    }
}
    
    



}
