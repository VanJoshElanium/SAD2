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
</head>
<body>
    <div class="wrapper">
       <!-- SIDEBAR -->
        <div class="sidebar" data-color="purple" data-image="/images/sidebar-5.jpg">
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="{{ route('dashboard') }}" class="simple-text">
                        Prince &#38; Princess
                    </a>
                </div>

                <ul class="nav">
                    <li class="active">
                        <a href="{{ route('dashboard') }}">
                            <i class="pe-7s-graph"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a href="/public/html/user.html">
                            <i class="pe-7s-user"></i>
                            <p>User Profile</p>
                        </a>
                    </li>

                    <li>
                        <a href="/public/html/icons.html">
                            <i class="pe-7s-rocket"></i>
                            <p>Terms</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('inventory') }}">
                            <i class="pe-7s-box2"></i>
                            <p>Inventory</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('suppliers') }}">
                            <i class="pe-7s-box1"></i>
                            <p>Suppliers</p>
                        </a>
                    </li>
                    <li>
                        <a href="/public/html/template.html">
                            <i class="pe-7s-folder"></i>
                            <p>Logs</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('usrmgmt') }}">
                            <i class="pe-7s-users"></i>
                            <p>User Management</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-panel">
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
                        <a class="navbar-brand" href="#">Supplier Profile</a>
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

            <!-- CONTENT -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
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

                                        <div class="col-md-2" style="margin-top:8px;">
                                            <button type="button" data-target="#addModal" data-toggle="modal" class="btn btn-success btn-fill" id="add-btn"> 
                                                Add Item
                                            </button>
                                        </div> 
                                    </div>

                                    <div class="content table-responsive table-full-width">
                                        <table id="suppliers-table" class="table table-hover table-striped" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>@sortablelink('supplier_id', 'ID')</th>
                                                    <th>@sortablelink('supply_name', 'Name')</th>
                                                    <th>@sortablelink('supply_price', 'Price')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($supplies as $supply)
                                                    <tr>    
                                                        <td>{{$supply->supply_id}}</td>
                                                        <td>{{$supply->supply_name}}</td>
                                                        <td>{{$supply->supply_price}}</td>
                                                        <td> 
                                                        <button data-target="#editModal" data-toggle="modal" data-id='{{$supply->supply_id}}' class="edit-btn btn btn-primary btn-fill">
                                                            Edit
                                                        </button>
                                                       </td>
                                                      <td>
                                                        <button data-target="#editModal" data-toggle="modal" data-id='{{$supply->supply_id}}' class="del-btn btn btn-danger btn-fill">
                                                            Remove
                                                        </button>
                                                      </td>
                                                    </tr>
                                                @empty
                                                <div class="header">
                                                    <center><h3 class="title"> No suppliers stored. </h3></center>
                                                </div>
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
                                    <p class="description text-center"> 
                                        {{$supplier->supplier_email}} <br>
                                        {{$supplier->supplier_cnum}}
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    !-- ADD MODAL -->
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

                                <!-- IN-SYSTEM USER DETAILS -->
                                <input type="hidden" value="1" name="supply_status" id="supplier_status">
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
                                {{method_field('PUT')}}
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


                                <!-- IN-SYSTEM USER DETAILS -->
                                <input type="hidden" value="1" name="supply_status" id="supply_status">
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
                        {{csrf_field()}}
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
            if ({{(count($errors))}} > 0)
                $('#addModal').modal();
           });
    </script>

    <!--PASS ID OF SUPPLIER TO MODAL, MANIPULATE INPUT FIELDS, & DISPLAY USER INFO-->
    <script>
        //EDIT USER
        $(document).on("click", ".edit-btn", function () {
            var id = $(this).data('id');

            //VIEW USER
            $.ajax({
                url: "getSupply/" + id,
                type: 'GET',             
                data: { 'id' : id },
                success: function(response){
                    // DEBUGGING
                    console.log(response.supply_id);

                    // SET FORM INPUTS
                    $('#supply_name').val(response.supply_name);
                    $('#supply_price').val(response.supply_price); 

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
            $("#view-edit-profile").attr("action", "supplies/" +id);
            
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
            $("#delete-profile").attr("action", +id);

            //MODAL
            $(".modal-title").html = "Remove Supplied Item";
            $("#view-edit-content").hide();
            $("#delete-content").show();
            $("#delete-modal-footer").show();
        });  
    </script>
@endsection
