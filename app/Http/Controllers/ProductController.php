<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product ;
use App\Models\Category;


class ProductController extends Controller
{
   public function create(Request $request)
   {
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

    public function delete($id)
    {
         $data = Product::findOrFail($id);
         $data->delete();
    
         return redirect()->back()->with('msg', 'تم حذف المنتج');
    }

    public function edit($id)
    {
        $data = Product::findOrFail($id);
        $categories = Category::all(); // Get all categories for the dropdown
        return view('admin.edit_product', ['product' => $data, 'categories' => $categories]);
    }

    public function update(Request $request, $id)
    {
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



}
