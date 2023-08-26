<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Auth;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $products = Product::paginate(10);
            return view('product.index', compact('products'));    
        }else {
            abort(401, 'Unauthorized');
        }
        
    }

    public function create()
    {
        if(Gate::allows('isManager') || Gate::allows('isAdmin')){
            return view('product.create');
        }else{
            abort(401, 'Unauthorized');
        }
    }

    public function store(Request $request)
    {
        if(Gate::allows('isManager') || Gate::allows('isAdmin')){
            $request->validate([
                'product_name' => 'required',
                'price' => 'required',
                'product_description' => 'required',
            ]);
            $product = Product::create([
                'product_name' => $request->product_name,
                'price' => $request->price,
                'product_description' => $request->product_description,
            ]);
            // dd($product);
           
            return redirect()->route('products.index')
                            ->with('success','Product created successfully.');
        }else{
            abort(401, 'Unauthorized');
        }
        
    }

    public function edit(Product $product)
    {
        if (Auth::check()) {
            if(Gate::allows('isManager') || Gate::allows('isAdmin')){
                return view('product.edit',compact('product'));
            }else{
                abort(401, 'Unauthorized');
            }
        } else {
            abort(401, 'Unauthorized');
        }
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_name' => 'required',
            'price' => 'required',
            'product_description' => 'required',
        ]);
      
        $product->update($request->all());
      
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();
       
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }

    public function show(Product $product)
    {
        if (Auth::check()) {
            return view('product.show',compact('product'));
        } else {
            abort(401, 'Unauthorized');
        }
    }
}
