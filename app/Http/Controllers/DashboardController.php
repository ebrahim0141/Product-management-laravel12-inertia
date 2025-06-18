<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Inertia\Inertia;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function Summary(Request $request){
        $user_id=$request->header('id');
        $product= Product::where('user_id',$user_id)->count();
        $Category= Category::where('user_id',$user_id)->count();
        return[
            'product'=> $product,
            'category'=> $Category,
        ];
    }

    function DashboardPage(Request $request)
    {
        
        $user_id=$request->header('id');
        $product= Product::where('user_id',$user_id)->count();
        $Category= Category::where('user_id',$user_id)->count();
        $data=[
            'product'=> $product,
            'category'=> $Category,
        ];

        return Inertia::render('DashboardPage',['list'=>$data]);
    }

}
