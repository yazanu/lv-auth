@extends('layouts.app-master')

@section('content')

    @can('isAdmin')
        <div class="bg-light p-5 rounded">
            <h1>{{__('labels.home')}}</h1>
            <p>{{__('labels.logged_in')}}</p>
        </div>
    @elsecan('isManager')
        <div class="bg-light p-5 rounded">
            <h1>{{__('labels.home')}}</h1>
            <p>You are in home page & You have Manager Access.</p>
        </div>
    @else
    <div class="bg-light p-5 rounded">
        <h1>{{__('labels.home')}}</h1>
        <p>You are in home page & You have User Access</p>
    </div>
    @endcan
@endsection