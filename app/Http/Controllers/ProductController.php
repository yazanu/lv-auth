<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Auth;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:product.index|product.create|proudct.edit|product.show|product.destroy', ['only' => ['index']]);
        $this->middleware('permission:product.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product.show', ['only' => ['show']]);
        $this->middleware('permission:product.destroy', ['only' => ['destroy']]);
    }
    
    public function index()
    {
        $products = Product::paginate(10);
        return view('product.index', compact('products'));  
        
    }

    public function create()
    {
        // if(Gate::allows('isManager') || Gate::allows('isAdmin')){
        //     return view('product.create');
        // }else{
        //     abort(401, 'Unauthorized');
        // }
        return view('product.create');
    }

    public function store(Request $request)
    {
        
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
    }

    public function edit(Product $product)
    {
        return view('product.edit',compact('product'));
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
        return view('product.show',compact('product'));
    }
}
