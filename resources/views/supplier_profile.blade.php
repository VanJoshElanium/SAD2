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
                        <a href="/html/user.html">
                            <i class="pe-7s-user"></i>
                            <p>User Profile</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('terms') }}">
                            <i class="pe-7s-graph"></i>
                            <p>Term Management</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('inventory') }}">
                            <i class="pe-7s-drawer"></i>
                            <p>Inventory</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="{{route('suppliers') }}">
                            <i class="pe-7s-box1"></i>
                            <p>Supplier Management</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('usrmgmt') }}">
                            <i class="pe-7s-users"></i>
                            <p>User Management</p>
                        </a>
                    </li>
                                        <li>
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
                        <a class="navbar-brand" href="#"><img src="{{URL::asset('images/supplier-management.png')}}" alt=""/></a>
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
                                    <div class="row">
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
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Price</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($supplies as $supply)
                                                    <tr>    
                                                        <td>{{$supply->inventory_id}}</td>
                                                        <td>{{$supply->inventory_name}}</td>
                                                        <td>&#8369; {{$supply->inventory_price}}</td>
                                                        <td> 
                                                        <button data-target="#editModal" data-toggle="modal" id="view-edit-{{$supply->inventory_id}}" data-id='{{$supply->inventory_id}}' class="edit-btn btn btn-primary btn-fill">
                                                            View
                                                        </button>
                                                       </td>
                                                      <td>
                                                        <button data-target="#editModal" data-toggle="modal" data-id='{{$supply->inventory_id}}' class="del-btn btn btn-danger btn-fill">
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
                                         <a href="#">
                                        <img class="avatar border-gray" src="/images/faces/face-3.jpg" alt="..."/>

                                          <h4 class="title">{{$supplier->supplier_name}}<br />
                                             <small>{{$supplier->supplier_addr}}</small>
                                          </h4>
                                        </a>
                                    </div>
                                    <hr>
                                    <h4 class="title text-center"> 
                                        {{$supplier->supplier_email}} <br>
                                        {{$supplier->supplier_cnum}}
                                    </h4>
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
                            <form class="form-horizontal" method="POST" action="/supplies">
                                {{ csrf_field() }}

                                <!-- SUPPLIER NAME & ADDR DETAILS-->       

                                <div class="row form-group">   
                                    <div class="{{$errors->has('supply_name') ? ' has-error' : ''}}"> 
                                        <div class="col-md-8">    
                                            <label>Item Name</label>
                                            <input type="text" id="supply_name" class="form-control"  name="supply_name" required> 
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
                                        <div class="col-md-4">    
                                            <label>Item Price</label>
                                            <input type="number" id="supply_price" class="form-control"  name="supply_price" required> 
                                            @if ($errors->has('supply_price'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{ $errors->first('supply_price') }}
                                                    </strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>   

                                <div class="row form-group">   
                                    <div class="{{$errors->has('supply_desc') ? ' has-error' : ''}}"> 
                                        <div class="col-md-12">    
                                            <label>Item Description</label>
                                            <textarea rows='2' id="supply_desc" class="form-control"  name="supply_desc" required></textarea>
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

                                <!-- IN-SYSTEM USER DETAILS -->
                                <input type="hidden" value="{{$supplier->supplier_id}}" name="supply_supplier_id" id="supply_supplier_id">

                                <!-- SUBMIT BUTTON -->
                                <button type="submit" class="btn btn-info btn-fill pull-right" id="form-button-add">
                                    Create
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
                                    
                <div class="modal-body">
                    <div id="view-edit-content" class="row">
                        <!-- USER Edit FORM -->
                        <div class="col-md-12"> 
                            <form method="POST" class="form-horizontal" id="view-edit-profile">
                                {{ csrf_field() }}
                                {{ method_field('PUT')}}
                                <!-- SUPPLIER NAME & ADDR DETAILS-->                                    
                                <div class="row form-group">   
                                    <div class="{{$errors->editSupply->has('supply_name') ? ' has-error' : ''}}"> 
                                        <div class="col-md-8">    
                                            <label>Item Name</label>
                                            <input type="text" id="edit_supply_name" class="form-control"  name="edit_supply_name" required> 
                                            @if ($errors->editSupply->has('supply_name'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{ $errors->editSupply->first('supply_name') }}
                                                    </strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="{{$errors->editSupply->has('supply_price') ? ' has-error' : ''}}"> 
                                        <div class="col-md-4">    
                                            <label>Item Price</label>
                                            <input type="number" id="edit_supply_price" class="form-control"  name="edit_supply_price" required> 
                                            @if ($errors->editSupply->has('supply_price'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{ $errors->editSupply->first('supply_price') }}
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
                                            <textarea rows='2' id="edit_supply_desc" class="form-control"  name="edit_supply_desc" required></textarea>
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

                                <!-- IN-SYSTEM USER DETAILS -->
                                <input type="hidden" value="{{$supplier->supplier_id}}" name="supply_supplier_id" id="supply_supplier_id">
                            
                                <!-- SUBMIT BUTTON -->
                                <button type="submit" class="btn btn-info btn-fill pull-right" id="form-button-edit">
                                    Edit
                                </button>

                                <button  data-dismiss="modal" aria-hidden="true" class="btn btn-basic pull-right" style="margin-right: 2%">
                                    Cancel
                                </button>             
                                <div class="clearfix"></div>
                                     
                            </form>   
                                        
                        </div>
                    </div>

                    <!-- DELETE PROFILE MODAL -->
                    <div id="delete-content">
                        <p> You are about to remove a supplied item. Do you want to proceed?</p>
                    </div>
                </div>

                <div class="modal-footer" id="delete-modal-footer">
                    <form method="POST" class="form-horizontal" id="delete-profile">
                        {{ csrf_field()}}
                        <input type="hidden" name="_method" value="DELETE">
                        <button  data-dismiss="modal" aria-hidden="true" class="btn btn-basic">
                            No
                        </button>
                        <button type="submit" id="form-button-delete" class="btn btn-info btn-fill pull-right">    Yes 
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<!--   Core JS Files   -->
    <script src="/js/jquery.3.2.1.min.js" type="text/javascript"></script>
    <script src="/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Charts Plugin -->
    <script src="/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="/js/bootstrap-notify.js"></script>

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
            
            
            if({!!count($errors->editSuppy)!!} > 0)
                $("#view-edit-{{ session()-> get( 'error_id' ) }}").click();
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

                    // MODAL
                    $("#editModal").modal('show'); 
                    $("#view-edit-content").show();
                    $("#delete-content").hide();
                    $("#delete-modal-footer").hide();
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

        //DELETE SUPPLIER
        $(document).on("click", ".del-btn", function () {
            var id = $(this).data('id');

            //FORM
            $("#delete-profile").attr("action", "/supplies/" +id);

            //MODAL
            $(".modal-title").html = "Remove Supplied Item";
            $("#view-edit-content").hide();
            $("#delete-content").show();
            $("#delete-modal-footer").show();
        });  
    </script>
@endsection