<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Exception;

class ProductController extends Controller
{

    function ProductPage(Request $request)
    {
        $user_id=$request->header('id');
        $list=Product::where('user_id',$user_id)->with('categories')->get();
        return Inertia::render('ProductPage',['list'=>$list]);
    }

    function ProductSavePage(Request $request)
    {
        // $product_id=$request->query('id');
        // $user_id=$request->header('id');
        // $list=Product::where('id',$product_id)->where('user_id',$user_id)->first();
        $user_id=$request->header('id');
        $product_id=$request->input('id');
        $category_list= Category::where('user_id',$user_id)->get();
        $product = Product::where('id',$product_id)->where('user_id',$user_id)->first();
        if($product_id !=0){
            $product->load('categories'); 
        }
        
        return Inertia::render('ProductSavePage',['list'=>$product,'category_list'=>$category_list]);
    }

    function CreateProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'unit' => 'required',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $user_id=$request->header('id');
        $product = Product::create([
            'name'=>$request->input('name'),
            'price'=>$request->input('price'),
            'unit'=>$request->input('unit'),
            'user_id'=>$user_id
        ]);

        $product->categories()->attach($request->categories);
        $data =['message'=>'Create Successful','status'=>true,'error'=>''];
        return  redirect()->route('ProductPage')->with($data);

        // return response()->json([
        //     'message' => 'Product created successfully', 
        //     'product' => $product->load('categories')
        // ], 201);
    }

    function ProductByID(Request $request)
    {
        $user_id=$request->header('id');
        $product_id=$request->input('id');
        $product = Product::where('id',$product_id)->where('user_id',$user_id)->first();
        $product->load('categories'); 
        return response()->json($product);
    }

    function ProductList(Request $request)
    {
        $user_id=$request->header('id');
        return Product::where('user_id',$user_id)->with('categories')->get();
    }

    function UpdateProduct(Request $request)
    {
        $user_id=$request->header('id');
        $product_id=$request->input('id');

        $product = Product::where('id',$product_id)
            ->where('user_id',$user_id)
            ->firstOrFail();
        
        $product->update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'unit' => $request->input('unit'),
        ]);

        $product->categories()->sync($request->categories);

        $data =['message'=>'Update Successful','status'=>true,'error'=>''];
        return  redirect()->route('ProductPage')->with($data);

        // return response()->json([
        //     'message' => 'Product updated successfully', 
        //     'product' => $product->load('categories')
        // ]);     
    }

    function DeleteProduct(Request $request)
    {
         try {
            $user_id=$request->header('id');
            $product_id=$request->id;
            $product = Product::where('id',$product_id)
                ->where('user_id',$user_id)
                ->firstOrFail();

            $product->categories()->detach();
            $product->delete();
            $data =['message'=>'Delete Successful','status'=>true,'error'=>''];
            return  redirect()->route('ProductPage')->with($data);
        }catch (Exception $e){
            $data =['message'=>'Delete Fail','status'=>false,'error'=>''];
            return  redirect()->route('ProductPage')->with($data);
        }

        // $user_id=$request->header('id');
        // $product_id=$request->input('id');
        // $product = Product::where('id',$product_id)
        //     ->where('user_id',$user_id)
        //     ->firstOrFail();

        // $product->categories()->detach();
        // $product->delete();

        // return response()->json(['message' => 'Product deleted successfully']);
    }
}
