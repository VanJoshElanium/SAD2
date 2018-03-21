@extends('layouts.app')

@section('content')
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="/images/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Supplier Profile</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS 3.3.7    -->
    <link href="/css/bootstrap.min.css">

    <script src="/js/jquery.3.2.1.min.js" type="text/javascript"></script>

    <!-- Animation library for notifications   -->
    <link href="/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="/css/light-bootstrap-dashboard.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="/css/demo.css" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="/css/pe-icon-7-stroke.css" rel="stylesheet" />
    <style>
        .box{
            border: 0px solid #888888;
            box-shadow: 5px 5px 8px 5px #888888;
        }
        .modal-title{
            text-align:center;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- SIDEBAR -->
        <div class="sidebar" data-color="none" data-image="/images/lol.png">
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="{{ route('dashboard') }}" class="simple-text">
                        Prince & Princess
                    </a>
                </div>

                <ul class="nav">
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i class="pe-7s-note"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('terms') }}">
                            <i class="pe-7s-graph"></i>
                            <p>Terms</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('inventory') }}">
                            <i class="pe-7s-drawer"></i>
                            <p>Inventories</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('stockins') }}">
                            <i class="pe-7s-download"></i>
                            <p>Stock Ins</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('stockouts') }}">
                            <i class="pe-7s-upload"></i>
                            <p>Stock Outs</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="{{route('suppliers') }}">
                            <i class="pe-7s-box1"></i>
                            <p>Suppliers</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('usrmgmt') }}">
                            <i class="pe-7s-users"></i>
                            <p>Users</p>
                        </a>
                    </li>
                    <li >
                        <a href="{{ route('logs') }}">
                            <i class="pe-7s-note2"></i>
                            <p>Logs</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-panel bgd">
            <!-- NAVBAR -->
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                           <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Supplier Profile </a>
                   </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="/html/user.html">
                                    {{$curr_usr->fname}} {{$curr_usr->mname}} {{$curr_usr->lname}}  
                                    <!-- Full Name of currently logged in user -->
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="/users" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                            <li class="separator hidden-lg"></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- List of supplied items that the supplier supplies -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card box">
                                    <div class="col-md-12 row">
                                        <div class="col-md-4">
                                            <div class="header">
                                                <h4 class="title">Supplied Items</h4> 
                                            </div> 
                                        </div>

                                        <form method="GET" action="{{ route('searchSupplies') }}">
                                            <div class="col-md-4" style="margin-top:10px">
                                                <input type="text" name="titlesearch" class="form-control" placeholder="Search . . ." value="{{ old('titlesearch') }}">
                                            </div>
                                        
                                            <div class="col-md-2" style="margin-top:10px">
                                                <button style="height: 40px;"; class="btn btn-success pe-7s-search"></button>
                                            </div>
                                        </form>

                                        <div class="col-md-2" style="margin-top:1.7%;">
                                            <button type="button" data-target="#addModal" data-toggle="modal" class="btn btn-success btn-fill" id="add-btn"> 
                                                Add Item
                                            </button>
                                        </div> 
                                    </div>

                                    <div class="content table-responsive table-full-width">
                                        <table id="suppliers-table" class="table table-hover table-striped" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    @if(count($supplies)>0)
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Price</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $x=0; ?>
                                                @forelse($supplies as $supply)
                                                    <tr>    
                                                        <td>{{$x+=1}}</td>
                                                        <td>{{$supply->inventory_name}}</td>
                                                        <td>&#8369; {{$supply->inventory_price}}</td>
                                                        <td> 
                                                        <button data-target="#editModal" data-toggle="modal" id="view-edit-{{$supply->inventory_id}}" data-id='{{$supply->inventory_id}}' class="edit-btn btn btn-primary btn-fill">
                                                            View
                                                        </button>
                                                       </td>
                                                      <td>
                                                        <button data-target="#removeItem-modal" data-toggle="modal" data-id='{{$supply->inventory_id}}' class="del-btn btn btn-danger btn-fill">
                                                            Remove
                                                        </button>
                                                      </td>
                                                    </tr>
                                                @empty
                                                    <h3 style="text-align: center"> No supplied items stored. </h3>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <div style="margin-left: 1%"> 
                                        {{$supplies->links()}} 
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-user">
                                <div class="image">
                                    <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="..."/>
                                </div>
                                <div class="content">
                                    <div class="author">
                                        <img class="avatar border-gray" src="/images/faces/face-3.jpg" alt="..."/>

                                          <h4 class="title">{{$supplier->supplier_name}} </h4>
                                            <h5>{{$supplier->supplier_addr}}</h5>
                                   
                                        <hr>
                                        <h5 class="title text-center"> 
                                            {{$supplier->supplier_email}} <br>
                                            {{$supplier->supplier_cnum}}
                                        </h5>
                                         <button style="margin-top:5%; margin-bottom:5%" type="button" data-target="#editSupplierModal" data-toggle="modal" id="edit-supplier-btn" class="btn  btn-success btn-fill" data-id='{{$supplier->supplier_id}}'> 
                                            Edit Supplier
                                        </button>
                                    </div>
                                </div> 
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ADD MODAL -->
    <div class="modal fade" role="dialog" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">New Supplied Item</h4>
                </div>
                                    
                <div class="modal-body">
                    <div class="row">
                        <!-- USER ADD FORM -->
                        <div class="col-md-12"> 
                            <form class="form-horizontal" onsubmit="return validateAddSupply()" method="POST" action="/supplies">
                                {{ csrf_field() }}

                                <!-- SUPPLIER NAME & ADDR DETAILS-->       

                                <div id="dynamic-form">
                                    <div class="row form-group">   
                                        <div class="{{$errors->has('supply_name') ? ' has-error' : ''}}"> 
                                            <div class="col-md-4">    
                                                <label>Item Name</label>
                                                <input type="text" id="supply_name" class="add-supply-dynamic form-control"  name="supply_name[]" required> 
                                                @if ($errors->has('supply_name'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{ $errors->first('supply_name') }}
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="{{$errors->has('supply_price') ? ' has-error' : ''}}"> 
                                            <div class="col-md-2">    
                                                <label>Price</label>
                                                <input type="number" id="supply_price" class="add-supply-dynamic form-control"  min="1" name="supply_price[]" required> 
                                                @if ($errors->has('supply_price'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{ $errors->first('supply_price') }}
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    
                                        <div class="{{$errors->has('supply_desc') ? ' has-error' : ''}}"> 
                                            <div class="col-md-4">    
                                                <label>Description</label>
                                                <textarea rows='1' id="supply_desc[]" class="add-supply-dynamic form-control"  name="supply_desc[]" ></textarea>
                                                @if ($errors->has('supply_desc'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{ $errors->first('supply_desc') }}
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>  

                                <!-- IN-SYSTEM USER DETAILS -->
                                <input type="hidden" value="{{$supplier->supplier_id}}" name="supply_supplier_id" id="supply_supplier_id">

                                <button type="button" class="btn btn-info btn-fill pull-left" id="add-form">
                                    Add Item Form
                                 </button>


                                <!-- SUBMIT BUTTON -->
                                <button type="submit" class="btn btn-success btn-fill pull-right" id="form-button-add">
                                    Add
                                </button>

                                <button  data-dismiss="modal" aria-hidden="true" class="btn btn-basic pull-right" style="margin-right: 2%">
                                    Cancel
                                </button>             
                                <div class="clearfix"></div>
                                    
                            </form>                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- VIEW/EDIT/DELETE PROFILE MODAL -->
    <div class="modal fade" role="dialog" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Supplied Item Profile</h4>
                </div>
                         
                <form method="POST" class="form-horizontal" id="view-edit-profile">           
                    <div class="modal-body">
                        <div id="view-edit-content" class="row">
                            <!-- USER Edit FORM -->
                            <div class="col-md-12"> 
                                
                                {{ csrf_field() }}
                                {{ method_field('PUT')}}
                                <!-- SUPPLIER NAME & ADDR DETAILS-->                                    
                                <div class="row form-group">   
                                    <div class="{{$errors->editSupply->has('edit_supply_name') ? ' has-error' : ''}}"> 
                                        <div class="col-md-8">    
                                            <label>Item Name</label>
                                            <input type="text" id="edit_supply_name" class="form-control"  name="edit_supply_name" required> 
                                            @if ($errors->editSupply->has('edit_supply_name'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{ $errors->editSupply->first('edit_supply_name') }}
                                                    </strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="{{$errors->editSupply->has('edit_supply_price') ? ' has-error' : ''}}"> 
                                        <div class="col-md-4">    
                                            <label>Item Price</label>
                                            <input type="number" id="edit_supply_price" class="form-control" min="1" name="edit_supply_price" required> 
                                            @if ($errors->editSupply->has('edit_supply_price'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{ $errors->editSupply->first('edit_supply_price') }}
                                                    </strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>    

                                <div class="row form-group">   
                                    <div class="{{$errors->editSupply->has('edit_supply_desc') ? ' has-error' : ''}}"> 
                                        <div class="col-md-12">    
                                            <label>Item Description</label>
                                            <textarea rows='2' id="edit_supply_desc" class="form-control"  name="edit_supply_desc" ></textarea>
                                            @if ($errors->editSupply->has('edit_supply_desc'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{ $errors->editSupply->first('edit_supply_desc') }}
                                                    </strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div> 

                            </div>
                        </div>
                    </div>
                                     
                    <div class="modal-footer">
                        <input type="hidden" value="{{$supplier->supplier_id}}" name="supply_supplier_id" id="supply_supplier_id">
                                
                        <!-- SUBMIT BUTTON -->
                        <button type="submit" class="btn btn-success btn-fill pull-right" id="form-supplier-button-edit">
                            Edit
                        </button>

                        <button  data-dismiss="modal" aria-hidden="true" class="btn btn-basic pull-right" style="margin-right: 2%">
                            Cancel
                        </button>   
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- REMOVE ITEM -->
    <div class="modal fade" role="dialog" id="removeItem-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Remove Supplied Item</h4>
                </div>
                     
                <form method="POST" class="form-horizontal" id="removeItem">  
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="DELETE">

                    <div class="modal-body">
                        <div id="view-edit-content" class="row">
                            <div class="col-md-12"> 
                                <div class="row form-group">                       
                                    <div class=""> 
                                        <div class="col-md-12">   
                                            You are about to remove this supplier's item. Do you want to proceed?
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                            <button type="button" class="btn btn-bg btn-default" data-dismiss="modal">Cancel</button>
                          <!--ADD New Term button-->
                          <button type="submit" class="btn btn-bg btn-success btn-fill">Remove</button>   
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- VIEW/EDIT/DELETE PROFILE MODAL -->
    <div class="modal fade" role="dialog" id="editSupplierModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Supplier Profile</h4>
                </div>
                                    
                <div class="modal-body">
                    <div id="view-edit-supplier-content" class="row">
                        <!-- USER Edit FORM -->
                        <div class="col-md-12"> 
                            <form method="POST" class="form-horizontal" id="view-edit-supplier">
                                {{ csrf_field() }}
                                {{method_field('PUT')}}
                                <!-- SUPPLIER NAME & ADDR DETAILS-->                                    
                                <div class="row form-group">   
                                    <div class="{{$errors->editSupplier->has('edit_supplier_name') ? ' has-error' : ''}}"> 
                                        <div class="col-md-12">    
                                            <label>Supplier Name</label>
                                            <input type="text" id="edit_supplier_name" class="form-control"  name="edit_supplier_name" required> 
                                            @if ($errors->editSupplier->has('edit_supplier_name'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{ $errors->editSupplier->first('edit_supplier_name') }}
                                                    </strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>    

                                <div class="row form-group">
                                    <div class="{{$errors->editSupplier->has('edit_supplier_addr') ? ' has-error' : ''}}"> 
                                        <div class="col-md-12"> 
                                            <label>Supplier Address</label>
                                            <textarea id="edit_supplier_addr" class="form-control" required name="edit_supplier_addr" rows="2"> </textarea>
                                            @if ($errors->editSupplier->has('edit_supplier_addr'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{ $errors->editSupplier->first('edit_supplier_addr') }}
                                                    </strong>
                                                </span>
                                            @endif                   
                                        </div>      
                                    </div> 
                                </div>                           

                                <!-- USER CONTACT DETAILS -->
                                <div class="row form-group">
                                    <div class="{{ $errors->editSupplier->has('edit_supplier_email') ? ' has-error' : '' }}">
                                        <div class="col-md-12">  
                                            <label>Email</label>
                                            <input type="text" required name="edit_supplier_email" id="edit_supplier_email" class="form-control" >
                                                                                
                                            @if ($errors->editSupplier->has('edit_supplier_email'))
                                                <span class="help-block">
                                                    <strong>{{$errors->editSupplier->first('edit_supplier_email')}}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="{{ $errors->editSupplier->has('edit_supplier_cnum') ? ' has-error' : '' }}">
                                        <div class="col-md-12">  
                                            <label>Contact Number</label>
                                            <input type="number" required name="edit_supplier_cnum" id="edit_supplier_cnum" class="form-control">
                                                                                
                                            @if ($errors->editSupplier->has('edit_supplier_cnum'))
                                                <span class="help-block">
                                                    <strong>{{$errors->editSupplier->first('edit_supplier_cnum')}}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer" >
                     <!-- SUBMIT BUTTON -->
                    <button type="submit" class="btn btn-success btn-fill pull-right" id="form-button-edit">
                        Edit
                    </button>

                    <button  data-dismiss="modal" aria-hidden="true" class="btn btn-basic pull-right" style="margin-right: 2%">
                        Cancel
                    </button>             
                    <div class="clearfix"></div>  
                </div>
            </div>
        </div>
    </div>

    <!-- SUCCESS MESSAGES -->
    @if(session('update-profile-success'))
        <script> 
            jQuery(document).ready(function($){
                $.notify( "{{session()-> get('update-profile-success')}}", "success");
                {{session()->forget('update-success')}}
            });
        </script>
    @endif

    @if(session('store-item-success'))
        <script> 
            jQuery(document).ready(function($){
                $.notify( "{{session()-> get('store-item-success' )}}", "success");
                {{session()->forget('store-success')}}
            });
        </script>
    @endif

    @if(session('update-item-success'))
        <script> 
            jQuery(document).ready(function($){
                $.notify( "{{session()-> get('update-item-success' )}}", "success");
                {{session()->forget('update-success')}}
            });
        </script>
    @endif

    @if(session('destroy-item-success'))
        <script> 
            jQuery(document).ready(function($){
                $.notify( "{{session()-> get('destroy-item-success' )}}", "success");
                {{session()->forget('destroy-success')}}
            });
        </script>
    @endif
</body>
<!--   Core JS Files   -->
    <script src="/js/notify.js" type="text/javascript"></script>
    <script src="/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Charts Plugin -->
    <script src="/js/chartist.min.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

    <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
    <script src="/js/demo.js"></script>

    <!--KEEP CREATE/EDIT MODAL OPEN IF THERE ARE VALIDATION ERRORS-->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if ({!!count($errors)!!} > 0)
                $("#addModal").modal();    
            
            
            if({!!count($errors->editSupply)!!} > 0){
                $("#view-edit-{{ session()-> get( 'error_id' ) }}").on('click', function (e) {
                    e.preventDefault();

                    $('#edit_supply_name').val("{{old('edit_supply_name')}}");
                    $('#edit_supply_desc').val("{{old('edit_supply_desc')}}"); 
                    $('#edit_supply_price').val("{{old('edit_supply_price')}}");

                    var id = $(this).data('id');
                    $("#view-edit-profile").attr("action", "/supplies/" +id);
                });      
                    
                $("#view-edit-{{ session()-> get( 'error_id' ) }}").click();
            }

            if({!!count($errors->editSupplier)!!} > 0){
                $("#edit-supplier-btn").on('click', function (e) {
                    e.preventDefault();

                    $('#edit_supplier_name').val("{{old('edit_supplier_name')}}");
                    $('#edit_supplier_addr').val("{{old('edit_supplier_addr')}}"); 
                    $('#edit_supplier_cnum').val("{{old('edit_supplier_cnum')}}");
                    $('#edit_supplier_email').val("{{old('edit_supplier_email')}}");

                    var id = $(this).data('id');
                    $("#view-edit-supplier").attr("action", "/suppliers/" +id);
                });      
                    
                $("#edit-supplier-btn").click(); 
            }
        });
    </script>

    <!--PASS ID OF SUPPLIER TO MODAL, MANIPULATE INPUT FIELDS, & DISPLAY USER INFO-->
    <script>
        //EDIT USER
        $(document).on("click", ".edit-btn", function () {
            var id = $(this).data('id');
            //alert(id);
            //VIEW USER
            $.ajax({
                url: "/getSuppliedItem/" +id,
                type: 'GET',             
                data: { 'id' : id },
                success: function(response){
                    // DEBUGGING
                    console.log(response);

                    // SET FORM INPUTS
                    $('#edit_supply_name').val(response.inventory_name);
                    $('#edit_supply_price').val(response.inventory_price); 
                    $('#edit_supply_desc').val(response.inventory_desc); 
                },
                error: function(data){
                    console.log(data);
                }
            });
          
            //FORM
            $("#view-edit-profile").attr("action", "/supplies/" +id);
            
            //MODAL
            $(".modal-title").text = "Edit Supplied Item";; 
            $("#delete-content").hide();
            $("#delete-modal-footer").hide();
            $('#form-button-edit').show(); 
        });

        //DELETE SUPPLIES
        $(document).on("click", ".del-btn", function () {
            var id = $(this).data('id');

            //FORM
            $("#removeItem").attr("action", "/supplies/" +id);
        });  
    </script>
    

    <!--PASS ID OF SUPPLIER TO MODAL, MANIPULATE INPUT FIELDS, & DISPLAY USER INFO-->
    <script>
        //EDIT USER
        $(document).on("click", "#edit-supplier-btn", function () {
            var id = $(this).data('id');
           
            //VIEW USER
            $.ajax({
                url: "/getSupplier/" + id,
                type: 'GET',             
                data: { 'id' : id },
                success: function(response){
                    // DEBUGGING
                    console.log(response.supplier_name);

                    // SET FORM INPUTS
                    $('#edit_supplier_name').val(response.supplier_name);
                    $('#edit_supplier_addr').val(response.supplier_addr); 
                    $('#edit_supplier_email').val(response.supplier_email);
                    $('#edit_supplier_cnum').val(response.supplier_cnum);
                },
                error: function(data){
                    console.log(data);
                }
            });
          
            //FORM
            $("#view-edit-supplier").attr("action", "/suppliers/" +id);
            
        });  
    </script>

    <script>
        // ADD ITEM FORM
        $('#add-form').click(function() {
            i=1;
            i++;

            $('#dynamic-form').append(
                "<div class='row form-group' id='row-" +i +"'>"+
                    "<div class='col-md-4'>"+ 
                        "<input type='text' id='supply_name' id='item-row-"+i+"' class='add-supply-dynamic form-control'  name='supply_name[]' required>" +
                    "</div>"+

                    "<div class='col-md-2'>"+ 
                        "<input type='number' id='supply_price' class='add-supply-dynamic form-control'  min='1' name='supply_price[]' required>"+
                    "</div>"+

                    "<div class='col-md-4'>"+ 
                        "<textarea rows='1' id='supply_desc' class='add-supply-dynamic form-control'  name='supply_desc[]' > </textarea>"+
                    "</div>"+
                    
                    "<div class='col-md-2'>"+ 
                        "<button id='"+i +"' type='button' class='btn_remove btn btn-danger btn-fill'> - </button>"+
                    "</div>"+
                "</div>"
            );

        });

        // REMOVE ITEM FORM
        $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row-'+button_id+'').remove();  
        });
    </script>

    <script>
        // UPDATE QTY DYNAMIC FORM VALIDATION
        function validateAddSupply() {
            var item_inputs = $(".add-supply-dynamic");
            return hasDuplicates(item_inputs);
        }

        function hasDuplicates(array) {
            for (var i = 0; i < array.length; i++) {
                for (var j = 0; j < array.length; j++) {
                    if (i != j) {
                        if (array[i].value == array[j].value) {
                            // $("addModal-un").notify("Error! Duplicate items." ,"error");
                            alert ("Error! Duplicate items." ,"error");
                            return false;
                        }
                    }
                }
            }
            return true;
        }
    </script>
@endsection