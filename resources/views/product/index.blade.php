@extends('layouts.app-master')

@section('content')
    <div class="container mt-5">
        <h1>Create Product</h1>
        
        @if (auth()->user()->role == 'admin' || auth()->user()->role == 'manager')
        <a href="{{ route('products.create') }}" class="btn btn-success btn-md float-right">Create Product</a>  
        @endif
        
        
        @if(session()->has('success'))
            <label id="box" class="alert alert-success w-100">{{session('success')}}</label>
        @elseif(session()->has('error'))
            <label id="box" class="alert alert-danger w-100">{{session('error')}}</label>
        @endif
        
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Description</th>
                        @if (auth()->user()->role == 'admin' || auth()->user()->role == 'manager')
                        <th scope="col">Action</th>
                        @endif
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key=>$product)
                            <tr>
                                <th scope="row">{{++$key}}</th>
                                <td>{{$product->product_name}}</td>
                                <td>{{$product->price}}</td>
                                <td>{!! $product->product_description !!}</td>
                                @if (auth()->user()->role == 'admin' || auth()->user()->role == 'manager')
                                <td>
                                    <form action="{{ route('products.destroy',$product->id) }}" method="POST">
   
                                        <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>
                        
                                        <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
                                        
                                        @can('isAdmin')
                                        @csrf
                                        @method('DELETE')
                          
                                        <button type="submit" class="btn btn-danger">Delete</button> 
                                        @endcan
                                        
                                    </form>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                  {{$products->links()}}
            </div>
        </div>
    </div>
@endsection