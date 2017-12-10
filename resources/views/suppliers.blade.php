@extends('layouts.app')

@section('content')
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Light Bootstrap Dashboard by Creative Tim</title>

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
                        <a href="{{ route('usrprofile') }}"
                            <i class="pe-7s-user"></i>
                            <p>User Profile</p>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('term') }}">
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
                        <a href="{{ route('logs') }}">
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
                        <a class="navbar-brand" href="#">Supplier Management</a>
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
                        <!-- TABLE OF USERS -->
                        <div class="col-md-12">      
                            <div class="card">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="header">
                                            <h4 class="title">Suppliers</h4> 
                                        </div> 
                                    </div>

                                    <form method="GET" action="{{ route('searchSuppliers') }}">
                                        <div class="col-md-4" style="margin-top:10px">
                                            <input type="text" name="titlesearch" class="form-control" placeholder="Search . . ." value="{{ old('titlesearch') }}"">
                                        </div>
                                    
                                        <div class="col-md-2" style="margin-top:10px">
                                            <button style="height: 40px;"; class="btn btn-success pe-7s-search"></button>
                                        </div>
                                    </form>

                                    <div class="col-md-2" style="margin-top:8px;">
                                        <button type="button" data-target="#addModal" data-toggle="modal" class="btn btn-success btn-fill" id="add-btn"> 
                                            Add Supplier
                                        </button>
                                    </div> 
                                </div>

                                <div class="content table-responsive table-full-width">
                                    <table id="suppliers-table" class="table table-hover table-striped" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>@sortablelink('supplier_id', 'ID')</th>
                                                <th>@sortablelink('supplier_name', 'Name')</th>
                                                <th>@sortablelink('supplier_addr', 'Address')</th>
                                                <th>E-Mail</th>
                                                <th>Contact Number</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($suppliers as $supplier)
                                                <tr class="clickable-row" data-href="{{ route('supplies.show', ['supply' => $supplier->supplier_id]) }}">    
                                                  <td>{{$supplier->supplier_id}}</td>
                                                  <td>{{$supplier->supplier_name}}</td>
                                                  <td>{{$supplier->supplier_addr}}</td>
                                                  <td>{{$supplier->supplier_email}}</td>
                                                  <td>{{$supplier->supplier_cnum}}</td>
                                                  <td> 
                                                    <button data-target="#editModal" data-toggle="modal" data-id='{{$supplier->supplier_id}}' class="edit-btn btn btn-primary btn-fill">
                                                        Edit
                                                    </button>
                                                   </td>
                                                  <td>
                                                    <button data-target="#editModal" data-toggle="modal" data-id='{{$supplier->supplier_id}}' class="del-btn btn btn-danger btn-fill">
                                                        Remove
                                                    </button>
                                                  </td>
                                                </tr>
                                            @empty
                                                <h1> No suppliers stored. </h1>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div style="margin-left: 1%"> 
                                    {{$suppliers->links()}} 
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
                    <h4 class="modal-title">New Supplier</h4>
                </div>
                                    
                <div class="modal-body">
                    <div class="row">
                        <!-- USER ADD FORM -->
                        <div class="col-md-12"> 
                            <form class="form-horizontal" method="POST" action="/suppliers">
                                {{ csrf_field() }}

                                <!-- SUPPLIER NAME & ADDR DETAILS-->                                    
                                <div class="row form-group">   
                                    <div class="{{$errors->has('supplier_name') ? ' has-error' : ''}}"> 
                                        <div class="col-md-12">    
                                            <label>Supplier Name</label>
                                            <input type="text" id="supplier_name" class="form-control"  name="supplier_name" required value="{{old('supplier_name')}}"> 
                                            @if ($errors->has('supplier_name'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{ $errors->first('supplier_name') }}
                                                    </strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>    

                                <div class="row form-group">
                                    <div class="{{$errors->has('supplier_addr') ? ' has-error' : ''}}"> 
                                        <div class="col-md-12"> 
                                            <label>Supplier Address</label>
                                            <textarea id="supplier_addr" class="form-control" required name="supplier_addr" rows='3' cols="30" value="{{ old('supplier_addr')}}"> </textarea>
                                            @if ($errors->has('supplier_addr'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{ $errors->first('supplier_addr') }}
                                                    </strong>
                                                </span>
                                            @endif                   
                                        </div>      
                                    </div> 
                                </div>                           

                                <!-- USER CONTACT DETAILS -->
                                <div class="row form-group">
                                    <div class="{{ $errors->has('supplier_email') ? ' has-error' : '' }}">
                                        <div class="col-md-12">  
                                            <label>Email</label>
                                            <input type="text" required name="supplier_email" id="supplier_email" class="form-control" value="{{ old('supplier_email') }}">
                                                                                
                                            @if ($errors->has('supplier_email'))
                                                <span class="help-block">
                                                    <strong>{{$errors->first('supplier_email')}}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="{{ $errors->has('supplier_cnum') ? ' has-error' : '' }}">
                                        <div class="col-md-12">  
                                            <label>Contact Number</label>
                                            <input type="number" required name="supplier_cnum" id="supplier_cnum" class="form-control" value="{{ old('supplier_cnum') }}">
                                                                                
                                            @if ($errors->has('supplier_cnum'))
                                                <span class="help-block">
                                                    <strong>{{$errors->first('supplier_cnum')}}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- IN-SYSTEM USER DETAILS -->

                                <div class="row form-group">
                                    <input type="hidden" value="1" name="supplier_status" id="supplier_status">
                                </div>

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
                    <h4 class="modal-title">Supplier Profile</h4>
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
                                    <div class="{{$errors->has('supplier_name') ? ' has-error' : ''}}"> 
                                        <div class="col-md-12">    
                                            <label>Supplier Name</label>
                                            <input type="text" id="supplier_name" class="form-control"  name="supplier_name" required> 
                                            @if ($errors->has('supplier_name'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{ $errors->first('supplier_name') }}
                                                    </strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>    

                                <div class="row form-group">
                                    <div class="{{$errors->has('supplier_addr') ? ' has-error' : ''}}"> 
                                        <div class="col-md-12"> 
                                            <label>Supplier Address</label>
                                            <textarea id="supplier_addr" class="form-control" required name="supplier_addr" rows="2"> </textarea>
                                            @if ($errors->has('supplier_addr'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{ $errors->first('supplier_addr') }}
                                                    </strong>
                                                </span>
                                            @endif                   
                                        </div>      
                                    </div> 
                                </div>                           

                                <!-- USER CONTACT DETAILS -->
                                <div class="row form-group">
                                    <div class="{{ $errors->has('supplier_email') ? ' has-error' : '' }}">
                                        <div class="col-md-12">  
                                            <label>Email</label>
                                            <input type="text" required name="supplier_email" id="supplier_email" class="form-control" >
                                                                                
                                            @if ($errors->has('supplier_email'))
                                                <span class="help-block">
                                                    <strong>{{$errors->first('supplier_email')}}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="{{ $errors->has('supplier_cnum') ? ' has-error' : '' }}">
                                        <div class="col-md-12">  
                                            <label>Contact Number</label>
                                            <input type="supplier_number" required name="supplier_cnum" id="supplier_cnum" class="form-control">
                                                                                
                                            @if ($errors->has('supplier_cnum'))
                                                <span class="help-block">
                                                    <strong>{{$errors->first('supplier_cnum')}}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- IN-SYSTEM USER DETAILS -->
                                <input type="hidden" value="1" name="supplier_status" id="supplier_status">
                            
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
                        <p> You are about to remove a supplier. Do you want to proceed?</p>
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

    <script>
        $(document).on("click", ".clickable-row", function () {
                window.location = $(this).data("href");
        });
    </script>

    <!--PASS ID OF SUPPLIER TO MODAL, MANIPULATE INPUT FIELDS, & DISPLAY USER INFO-->
    <script>
        //EDIT USER
        $(document).on("click", ".edit-btn", function () {
            var id = $(this).data('id');

            //VIEW USER
            $.ajax({
                url: "getSupplier/" + id,
                type: 'GET',             
                data: { 'id' : id },
                success: function(response){
                    // DEBUGGING
                    console.log(response.supplier_id);

                    // SET FORM INPUTS
                    $('#supplier_name').val(response.supplier_name);
                    $('#supplier_addr').val(response.supplier_addr); 
                    $('#supplier_email').val(response.supplier_email);
                    $('#supplier_cnum').val(response.supplier_cnum);

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
            $("#view-edit-profile").attr("action", "/suppliers/" +id);
            
            //MODAL
            $(".modal-title").text = "Edit Supplier";; 
            $("#delete-content").hide();
            $("#delete-modal-footer").hide();
            $('#form-button-edit').show(); 
        });

        //DELETE SUPPLIER
        $(document).on("click", ".del-btn", function () {
            var id = $(this).data('id');

            //FORM
            $("#delete-profile").attr("action", "/suppliers/" +id);

            //MODAL
            $(".modal-title").html = "Remove Supplier";
            $("#view-edit-content").hide();
            $("#delete-content").show();
            $("#delete-modal-footer").show();
        });  
    </script>
@endsection
