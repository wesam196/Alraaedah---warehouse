<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;



class CategoryController extends Controller
{
    public function index(){
        $data=category::all();


        return view('admin.dashboard' , ['data'=>$data]);
    }

    public function create(Request $request){
        $data = new category;
        $data->Category = $request->caregory;
        $data->save();

        return redirect()->back()->with('msg', 'تم إضافة التصنيف');
    }


    public function delete($id){
        $data = category::Findorfail($id);
        $data->delete();

        return redirect()->back()->with('msg', 'تم حذف التصنيف');

    }


}
