@extends('layouts.auth-master')

@section('content')
<h1>Login User</h1>
    <form action="/login" method="post">
        @csrf
        <div class="form-group mb-2">
            <label for="">Email</label>
            <input type="email" name="email" id="" class="form-control">
        </div>

        <div class="form-group mb-2">
            <label for="">Password</label>
            <input type="password" name="password" id="" class="form-control">
        </div>

        <button type="submit" class="btn btn-md btn-primary">Login</button>
    </form>
@endsection