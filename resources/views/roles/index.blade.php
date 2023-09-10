@extends('layouts.app-master')

@section('content')
    <div class="container">

        <div class="row mt-5">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
        </div>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            @foreach (config('constant.roles') as $key => $role)
                <li class="nav-item" role="presentation">
                    <button class="nav-link @if($key == 1) active @endif" id="nav{{$key}}-tab" data-bs-toggle="tab" data-bs-target="#nav{{$key}}" type="button" role="tab" aria-controls="nav{{$key}}" aria-selected="true">{{$role}}</button>
                </li>   
            @endforeach
        </ul>
        
        <div class="tab-content" id="myTabContent">
            @foreach (config('constant.roles') as $key => $role)
                <div class="tab-pane fade @if($key == 1) show active @endif" id="nav{{$key}}" role="tabpanel" aria-labelledby="nav{{$key}}-tab">
                    {{-- roles permissions --}}

                    <div class="row" style="margin: 1% 0;">
                        <div class="col-md-2 RS_all">
                            <input type="checkbox" name="selectAll" id="selectAll">&nbsp; Select All
                        </div>
                    </div>


                    <form action="/permissions" method="post">
                        @csrf
                        <input type="hidden" name="role_id" value="{{$key}}">
                        <div class="row" style="margin: 0;">
                            @if (auth()->user()->role == 1)
                            <div class="col-md-2 RS_role">
                                <h6 > <input type="checkbox" id="select_module"  name="select_module">Role Permission</h6>
                                <span> <input type="checkbox" name="permission-index" value="permission.index" >view-permission </span>
                                <span> <input type="checkbox" name="permission-edit" value="permission.edit" >update-permission </span>
                            </div>
                            @endif

                            <div class="col-md-2 RS_role">
                                <h6 > <input type="checkbox" id="select_module"  name="select_module">User</h6>
                                <span> <input type="checkbox" name="user-index" value="user.index" >user-list </span>
                                <span> <input type="checkbox" name="user-create" value="user.create" >user-approve </span>
                                <span> <input type="checkbox" name="user-edit" value="user.edit">user-edit </span>
                                <span><input type="checkbox" name="user-detail" value="user.show">user-detail </span>
                                <span> <input type="checkbox" name="user-delete" value="user.destroy">user-activate </span>
                            </div>

                            <div class="col-md-2 RS_role">
                                <h6 > <input type="checkbox" id="select_module"  name="select_module">Product</h6>
                                
                                <span> <input type="checkbox" name="product-index" value="product.index" >product-list </span>
                                
                                <span> <input type="checkbox" name="product-create" value="product.create">product-create </span>
                                <span> <input type="checkbox" name="product-edit" value="product.edit" >product-edit </span>
                                
                                <span> <input type="checkbox" name="product-delete" value="product.destroy">product-delete </span>
                                
                            </div>

                            <div class="col-md-2 RS_role">
                                <h6 > <input type="checkbox" id="select_module"  name="select_module">Reports</h6>
                                <span> <input type="checkbox" name="report-daily" value="report.daily" >daily-report </span>
                                <span> <input type="checkbox" name="report-weekly" value="report.weekly" >weekly-report </span>
                                <span> <input type="checkbox" name="report-monthly" value="report.monthly">monthly-report </span>
                                <span> <input type="checkbox" name="report-overall" value="report.overall">overall-report </span>
                            </div>
                        </div>

                        <div class="row" style=" margin: 0;">
                            <div class="col-md-6"></div>
                            <div class="col-md-6 text-end">
                                 <a class="btn btn-md btn-default cancal-btn" data-dismiss="modal">Cancel</a>
                                 <button type="submit" class="btn btn-primary btn-md dark-text save-btn">Save</button>
                            </div>
                         </div><br><br>
                    </form>

                    {{-- roles permissions --}}
                </div> 
            @endforeach
        </div>
    </div>

    <script>
        $(document).ready(function(){
            load();

            checkPermission();

            $('input[name=selectAll]').click(function(){
                if($(this).is(":checked"))
                    $(this).parent().parent().parent().find('input[type=checkbox]').prop('checked',true);
                else  $(this).parent().parent().parent().find('input[type=checkbox]').prop('checked',false);
            });

            $(document).on('click','.cancal-btn',function(){
                location.href = '/';
            });

            $('input[type=checkbox]').click(function(){
                    if(!$(this).is(":checked")){
                        $('input[name=selectAll]').prop('checked',false);
                        $(this).parent().parent().find('h6').find('input[type=checkbox]').prop('checked',false);
                    }else{
                           if($(this).parent().parent().find('input:checkbox:not(:checked):not(#select_module)').length ==0)
                              $(this).parent().parent().find('h6').find('input[type=checkbox]').prop('checked',true);
                    }
            });

            $(document).on('click','#select_module',function(){
                if($(this).is(':checked')){
                    $(this).parent().parent().find('input[type=checkbox]').prop('checked',true);
                }else{
                    $(this).parent().parent().find('input[type=checkbox]').prop('checked',false);
                }

                checkPermission();
            });
        });

        function load(){
              $.each($('input[name=select_module]'),function(i,e){
                  if($(e).parent().parent().find('input:checkbox:not(:checked):not(#select_module)').length ==0){
                        $(e).prop('checked',true);
                  }
              });

              checkPermission();
        }

        function checkPermission(){
            if($("#nav1").find('input[name=select_module]:not(:checked)').length==0)
               $("#nav1").find('#selectAll').prop('checked',true); 

            if($("#nav2").find('input[name=select_module]:not(:checked)').length==0)
               $("#nav2").find('#selectAll').prop('checked',true);

            if($("#nav3").find('input[name=select_module]:not(:checked)').length==0)
               $("#nav3").find('#selectAll').prop('checked',true);

        }
    </script>
@endsection