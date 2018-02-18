@extends('layouts.app')

@section('content')
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Inventory</title>

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

    <style type="text/css">
        .box{
            border: 0px solid #888888;
            box-shadow: 5px 5px 8px 5px #888888;
        }
        #exTab3 .nav-pills > li > a {
          border-radius: 4px 4px 0 0 ;
          border-width: 2px;
          border-style: solid;
          border-color:  #ffffff;
        }

        a:hover{
            color:#777;
        }
        .modal-title{
            text-align:center;
        }
        #exTab3 .tab-content {
          background-color: #ffffff;
          padding : 5px 15px;
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
                    <li class="active">
                        <a href="{{route('inventory') }}">
                            <i class="pe-7s-drawer"></i>
                            <p>Inventory</p>
                        </a>
                    </li>
                    <li>
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
                        </button>
                        <a class="navbar-brand" href="#">Inventory Management</a>
                        <a class="btn btn-sm btn-info btn-fill" href="{{ URL::previous() }}">Back</a>
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

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
                        <!-- TABLE OF UNDAMAGED ITEMS -->
                        <div class="col-md-12">      
                            <div class="card box"> 
                                <ul  class="nav nav-tabs">
                                    <li class="active">
                                        <a  href="#1b" data-toggle="tab">Undamaged Items</a>
                                    </li>
                                    <li>
                                        <a href="#2b" data-toggle="tab">Damaged Items</a>
                                        </li>
                                </ul>
                                <div class="tab-content clearfix">
                                    <!-- TAB #1 -->
                                    <div class="tab-pane active" id="1b">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="header">
                                                    <h4 class="title" style="margin-top:10px">Undamaged Inventory</h4> 
                                                </div> 
                                            </div>

                                            <form method="GET" action="{{ route('searchItems') }}">
                                                <div class="col-md-4" style="margin-top:10px">
                                                    <input type="text" name="titlesearch" class="form-control" placeholder="Search . . ." value="{{ old('titlesearch') }}">
                                                </div>
                                            
                                                <div class="col-md-2" style="margin-top:10px">
                                                    <button style="height: 40px;"; class="btn btn-success pe-7s-search"></button>
                                                </div>
                                            </form>

                                            <div class="col-md-2" style="margin-top:8px;">
                                                <button type="button" data-target="#addModal-un" data-toggle="modal" class="btn btn-success btn-fill" id="add-btn"> 
                                                    Update Item/s
                                                </button>
                                            </div> 
                                        </div>

                                        <div class="content table-responsive table-full-width">
                                            <table id="inventory-table" class="table table-hover table-striped" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        @if(count($items)>0)
                                                        <th>ID</th>
                                                        <th>Item Name</th>
                                                        <th>Supplier Name</th>
                                                        <th>Price</th>
                                                        <th>Quantity</th>
                                                        <!-- <th>@sortablelink('received_at', 'Received At')</th> -->
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @forelse($items as $item)
                                                        <tr data-target="profileModal" data-toggle="modal" class="view-edit-modal" data-id='{{$item->inventory_id}}'>    
                                                            <td>{{$item->inventory_id}}</td>
                                                            <td>{{$item->inventory_name}}</td>
                                                            <td>{{$item->supplier_name}}</td>
                                                            <td>{{$item->inventory_price}}</td>
                                                            <td>{{$item->inventory_qty}}</td>
                                                            
                                                            
                                                            <!-- <td>{{$item->received_at}}</td> -->
                                                            <td> 
                                                                <button data-target="#editModal-un" data-toggle="modal" data-id='{{$item->inventory_id}}' class="edit-btn-un btn btn-primary btn-fill">
                                                                    View
                                                                </button>
                                                            </td>
                                                            <td>
                                                                <button data-target="#editModal-un" data-toggle="modal" data-id='{{$item->inventory_id}}' class="del-btn-un btn btn-danger btn-fill">
                                                                    Remove
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <h3 style="text-align: center"> No items in undamaged inventory. </h3>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                        <div style="margin-left: 1%"> 
                                            {{$items->links()}} 
                                        </div>
                                    </div>

                                    <!-- TAB #2 -->
                                    <div class="tab-pane" id="2b">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="header">
                                                    <h4 class="title" style="margin-top:10px">Damaged Inventory</h4> 
                                                </div> 
                                            </div>

                                            <form method="GET" action="{{ route('searchItems') }}">
                                                <div class="col-md-4" style="margin-top:10px">
                                                    <input type="text" name="titlesearch" class="form-control" placeholder="Search . . ." value="{{ old('titlesearch') }}">
                                                </div>
                                            
                                                <div class="col-md-2" style="margin-top:10px">
                                                    <button style="height: 40px;"; class="btn btn-success pe-7s-search"></button>
                                                </div>
                                            </form>

                                            <div class="col-md-2" style="margin-top:8px;">
                                                <button type="button" data-target="#addModal" data-toggle="modal" class="btn btn-success btn-fill" id="add-btn"> 
                                                    Add Damages
                                                </button>
                                            </div> 
                                        </div>

                                        <div class="content table-responsive table-full-width">
                                            <table id="inventory-table" class="table table-hover table-striped" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        @if(count($items)>0)
                                                        <th>ID</th>
                                                        <th>Item Name</th>
                                                        <th>Supplier Name</th>
                                                        <th>Quantity</th>
                                                        <!-- <th>@sortablelink('received_at', 'Received At')</th> -->
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @forelse($repairs as $repair)
                                                        <tr data-toggle="modal" class="view-edit-modal" data-id='{{$repair->repair_id}}'>    
                                                            <td>{{$repair->repair_id}}</td>
                                                            <td>{{$repair->inventory_name}}</td>
                                                            <td>{{$repair->supplier_name}}</td>
                                                            <td>{{$repair->repair_qty}}</td>
                                                            <td> 
                                                                <button data-target="#viewModal-dm" data-toggle="modal" id="view-repair-btn" data-id='{{$repair->repair_id}}' class="view-repair-btn btn btn-primary btn-fill">
                                                                    View
                                                                </button>
                                                            </td>
                                                            <td> 
                                                                <button data-target="#editModal-dm" data-toggle="modal" id="edit-repair-btn" data-id='{{$repair->repair_id}}' class="edit-repair-btn btn btn-info btn-fill">
                                                                    Edit
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <h3 style="text-align: center"> No items in damaged inventory. </h3>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                        <div style="margin-left: 1%"> 
                                            {{$repairs->links()}}
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ADD MODAL UNDAMAGED-->
    <div class="modal fade" role="dialog" id="addModal-un">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Quantities</h4>
                </div>
                                    
                <div class="modal-body">
                    <div class="row">
                        <!-- USER ADD FORM -->
                        <div class="col-lg-12"> 
                            <form class="form-horizontal" method="POST" action="/inventory/-999">
                                {{ csrf_field() }}`
                                {{ method_field('PUT') }}
                                <div class="row form-group">   
                                    <div class="col-md-4">    
                                        <label for="sel1">Supplier Name</label>
                                        <select class="form-control" name="supplier_name" required id="supplier_name">
                                            <option value="" data-hidden="true" selected="selected">
                                            </option>
                                            @foreach($suppliers as $supplier)
                                                <option value="{{$supplier->supplier_id}}">
                                                    {{$supplier->supplier_name}}
                                                </option>
                                            @endforeach
                                        </select>         
                                    </div>
                               
                                    <div class="col-md-4">    
                                        <label for="sel1">Handler</label>
                                        <select class="form-control" name="inventory_user_id" required id="pic">
                                            <option value="" data-hidden="true" selected="selected">
                                            </option>
                                            @foreach($workers as $worker)
                                                <option value="{{$worker->user_id}}">
                                                    {{$worker->fname}} {{$worker->mname}}. {{$worker->lname}}
                                                </option>
                                            @endforeach
                                        </select>         
                                    </div>

                                    <div class="{{$errors->has('received_at') ? ' has-error' : ''}}">
                                        <div class="col-md-4">    
                                            <label>Date Received</label>
                                            <input type="datetime-local" id="received_at" class="form-control"  name="received_at" required value="{{App\Inventory::currdate()}}"> 
                                            @if ($errors->has('received_at'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{ $errors->first('received_at') }}
                                                    </strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>    

                                <div id="un-form">
                                    <div class="row form-group" style="margin-top: 5%">
                                        <div class="{{$errors->addUn->has('supply_name') ? ' has-error' : ''}}"> 
                                            <div class="col-md-4">              
                                                <label>Item Name</label>
                                                <select class="form-control item_name" name="supply_name[]" required>
                                                </select> 
                                                @if ($errors->addUn->has('supply_name'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{ $errors->addUn->first('supply_name') }}
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- 
                                        <div class="col-md-2">              
                                            <label>Item Price</label>
                                             <input type="number" class="form-control" required name="inventory_price[]"> 
                                        </div> 
                                        -->
                                        
                                        <div class="col-md-2">              
                                            <label>Item Quantity</label>
                                             <input type="number" class="form-control" required name="inventory_quantity[]"> 
                                        </div>
                                    </div>                           
                                </div>


                                <div class="modal-footer">
                                    <!-- SUBMIT BUTTON -->
                                    <button type="button" class="btn btn-info btn-fill pull-left" id="add-form">
                                        Add Item Form
                                    </button>

                                    <button type="submit" class="btn btn-success btn-fill pull-right" id="form-button-add">
                                        Add Item/s
                                    </button>

                                    <button  data-dismiss="modal" aria-hidden="true" class="btn btn-basic pull-right" style="margin-right: 2%">
                                        Cancel
                                    </button>             
                                    <div class="clearfix"></div>  
                                </div>   
                            </form>                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ADD MODAL DAMAGED-->
    <div class="modal fade" role="dialog" id="addModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">New Damaged Item</h4>
                </div>
                                    
                <div class="modal-body">
                    <div class="row">
                        <!-- USER ADD FORM -->
                        <div class="col-lg-12"> 
                            <form class="form-horizontal" method="POST" action="/repair">
                                {{ csrf_field() }}

                                <!-- SUPPLIER NAME & ADDR DETAILS--> 

                                <div class="form-group">
                                    <div class="{{$errors->addRepair->has('dm_supplier_name') ? ' has-error' : ''}}"> 
                                        <div class="col-md-8">    
                                            <label for="sel1">Supplier Name</label>
                                            <select class="form-control" id="dm_supplier_name" name="dm_supplier_name" required>
                                            <option value="" selected="selected"></option>
                                            @foreach($suppliers as $supplier)
                                                <option value="{{$supplier->supplier_id}}">
                                                    {{$supplier->supplier_name}}
                                                </option>
                                            @endforeach
                                            </select>         
                                            @if ($errors->addRepair->has('dm_supplier_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->addRepair->first('dm_supplier_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- <div class="col-md-4">    
                                        <label for="sel1">Handler</label>
                                        <select class="form-control" name="inventory_user_id" required id="pic">
                                            <option value="" data-hidden="true" selected="selected">
                                            </option>
                                            @foreach($workers as $worker)
                                                <option value="{{$worker->user_id}}">
                                                    {{$worker->fname}} {{$worker->mname}}. {{$worker->lname}}
                                                </option>
                                            @endforeach
                                        </select>         
                                    </div>

                                    <div class="{{$errors->addRepair->has('received_at') ? ' has-error' : ''}}">
                                        <div class="col-md-4">    
                                            <label>Date Received</label>
                                            <input type="datetime-local" id="received_at" class="form-control"  name="received_at" required value="{{App\Inventory::currdate()}}"> 
                                            @if ($errors->addRepair->has('received_at'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{ $errors->addRepair->first('received_at') }}
                                                    </strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div> -->

                                </div>

                                <div id="dm-form">                                
                                    <div class="row form-group">   
                                        <div class="{{$errors->addRepair->has('dm_item_name') ? ' has-error' : ''}}"> 
                                            <div class="col-md-4">    
                                                <label>Item Name</label>
                                                <select class="form-control dm_item_name" name="dm_item_name[]" required>
                                                </select>  
                                                @if ($errors->addRepair->has('dm_item_name'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{ $errors->addRepair->first('dm_item_name') }}
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="{{$errors->addRepair->has('dm_state') ? ' has-error' : ''}}"> 
                                            <div class='col-md-4'>  
                                                <label>Item State</label>
                                                    <select class='form-control'  name='dm_item_state[]' required>
                                                        <option value='' selected="selected"> </option>
                                                        <option value='1'> Repairable </option>
                                                        <option value='0'> Unrepairable </option>
                                                    </select>
                                                @if ($errors->addRepair->has('dm_state'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->addRepair->first('dm_state') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="{{$errors->addRepair->has('dm_qty') ? ' has-error' : ''}}"> 
                                            <div class="col-md-2">    
                                                <label for="sel1">Qty Damaged</label>
                                                <input type="number" class="form-control" required name="dm_qty[]">      
                                                @if ($errors->addRepair->has('dm_qty'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->addRepair->first('dm_qty') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>    
                                </div>
                               <!--  <div class="row form-group">   
                                    <div class="{{$errors->has('supply_desc') ? ' has-error' : ''}}"> 
                                        <div class="col-md-12">    
                                            <label>Term (Optional)</label>
                                            <select class="form-control" name="gender" required id="gender">
                                            <option value="" data-hidden="true" selected="selected">
                                            @foreach($workers as $worker)
                                                <option value="{{$worker->id}}">
                                                    {{$worker->fname}} {{$worker->mname}} {{$worker->lname}}
                                                </option>
                                            @endforeach
                                        </select> 
                                            @if ($errors->has('supply_desc'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{ $errors->first('supply_desc') }}
                                                    </strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div> -->

                                <!-- <div class="row form-group">   
                                    <div class="{{$errors->has('supply_desc') ? ' has-error' : ''}}"> 
                                        <div class="col-md-12">    
                                            <label>Damage Description</label>
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
                                </div> -->
                               
                                
                                <!-- SUBMIT BUTTON -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-info btn-fill pull-left" id="add-dm-form">
                                        Add Damage Form
                                    </button>

                                    <button type="submit" class="btn btn-success btn-fill pull-right" id="form-button-add">
                                        Add Damage/s
                                    </button>

                                    <button  data-dismiss="modal" aria-hidden="true" class="btn btn-basic pull-right" style="margin-right: 2%">
                                        Cancel
                                    </button>             
                                    <div class="clearfix"></div>
                                </div>
                                    
                            </form>                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- VIEW/EDIT MODAL UNDAMAGED -->
    <div class="modal fade" role="dialog" id="editModal-un">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Item Profile</h4>
                </div>
                                    
                <div class="modal-body">
                    <div id="view-edit-content" class="row">
                        <!-- USER Edit FORM -->
                        <div class="col-md-12"> 
                            <form method="POST" class="form-horizontal" id="view-edit-item">      
                                
                                {{ method_field('PUT') }}
                                {{ csrf_field() }}

                                <input type="hidden" class="form-control" name="si_id" id="si_id">

                                <div class="row form-group">   
                                    <div class="col-md-4">    
                                        <label for="sel1">Supplier Name</label>
                                        <input type="text" class="form-control" name="view_supplier_name" required id="view_supplier_name">   
                                    </div>
                                    <input type="hidden" class="form-control" name="supplier_id" id="supplier_id">  
                               
                                    <div class="col-md-4">    
                                        <label for="sel1">Handler</label>
                                        <select class="form-control" name="view_pic" required id="view_pic">
                                        <option value="" data-hidden="true" selected="selected">
                                            @foreach($workers as $worker)
                                                <option value="{{$worker->user_id}}">
                                                    {{$worker->fname}} {{$worker->mname}}. {{$worker->lname}}
                                                </option>
                                            @endforeach
                                        </select>         
                                    </div>

                                    <div class="{{$errors->has('received_at') ? ' has-error' : ''}}">
                                        <div class="col-md-4">    
                                            <label>Date Received</label>
                                            <input type="datetime-local" id="view_received_at" class="form-control"  name="view_received_at" required value="{{old('received_at')}}"> 
                                            @if ($errors->has('received_at'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{ $errors->first('received_at') }}
                                                    </strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>    

                                <div id="un-form">
                                    <div class="row form-group" style="margin-top: 5%">
                                        <div class="col-md-4">              
                                            <label>Item Name</label>
                                            <input type="text" class="form-control item_name" name="view_item_name" id="view_item_name" required> 
                                        </div>

                                            <input type="hidden" class="form-control" name="item_id" id="item_id">

                                        <!-- <div class="col-md-2">              
                                            <label>Item Price</label>
                                             <input type="number" id="view_item_price" class="form-control" required name="view_inventory_price"> 
                                        </div> -->
                                        
                                        <div class="col-md-2">              
                                            <label>Current Quantity</label>
                                             <input type="number" id="view_curr_quantity" class="form-control" disabled  name="view_curr_quantity"> 
                                        </div>

                                        <div class="col-md-2">              
                                            <label>Item Quantity</label>
                                             <input type="number" id="view_item_quantity" class="form-control" required name="view_inventory_quantity"> 
                                        </div>
                                    </div>                           
                                </div> 

                                <button type="submit" class="btn btn-success btn-fill pull-right" id="form-button-edit">
                                        Edit
                                    </button>

                                    <button  data-dismiss="modal" aria-hidden="true" class="btn btn-basic pull-right" style="margin-right: 2%">
                                        Cancel
                                    </button>  
                            </form>           
                        </div>
                    </div>

                    <!-- DELETE PROFILE MODAL -->
                    <div id="delete-content">
                        <p> You are about to remove an item. Do you want to proceed?</p>
                    </div>
                </div>

                <div class="modal-footer" id="delete-modal-footer">
                    <form method="POST" class="form-horizontal" id="delete-item">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="DELETE">
                        <button  data-dismiss="modal" aria-hidden="true" class="btn btn-basic">
                            No
                        </button>
                        <button type="submit" id="form-button-delete" class="btn btn-success btn-fill pull-right">    Yes 
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- ADD FIXED QTY MODAL DAMAGED -->
    <div class="modal fade" role="dialog" id="editModal-dm">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Damaged Item</h4>
                </div>
                             
                <form method="POST" class="form-horizontal" id="edit-repair-form">      
                                   
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                    <input type="hidden" value="fixed_qty" name="update_type">

                    <div class="modal-body">
                        <div class="row form-group">
                            <div class="col-sm-12">
                                <label>Item name: </label> 
                                    <span id="repair_name" class="repair_name"></span>
                                    <input type="hidden" value="" name="repair_id" id="repair_id">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="{{$errors->editRepair->has('qty_fixed') ? ' has-error' : ''}}">                        
                                <div class="col-sm-12">    
                                    <label>Quantity Fixed</label>
                                    <input type="number" id="qty_fixed" class="form-control" name="qty_fixed">
                                    @if ($errors->has('qty_fixed'))
                                        <span class="help-block">
                                            <strong>
                                                {{ $errors->editRepair->first('qty_fixed') }}
                                            </strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-bg btn-basic" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-bg btn-info btn-fill">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- VIEW/EDIT MODAL DAMAGED -->
    <div class="modal fade" role="dialog" id="viewModal-dm">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Damaged Item</h4>
                </div>
                <form class="form-horizontal" id="view-repair-form" method="POST" action="/repair">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <input type="hidden" value="damaged_item" name="update_type">      

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12"> 
                                <div class="form-group">
                                    
                                    <div class="col-md-8">    
                                        <label for="sel1">Supplier Name</label>
                                        <input type="text" required name="edit_supplier_name" class="form-control" id="edit_supplier_name" disabled="disabled"> 
                                    </div>

                                    <!-- <div class="col-md-4">    
                                        <label for="sel1">Handler</label>
                                        <select class="form-control" name="edit_handler" required id="pic" required>
                                            @foreach($workers as $worker)
                                                <option value="{{$worker->user_id}}">
                                                    {{$worker->fname}} {{$worker->mname}}. {{$worker->lname}}
                                                </option>
                                            @endforeach
                                        </select>         
                                    </div>

                                    <div class="{{$errors->editRepair->has('edit_received_at') ? ' has-error' : ''}}">
                                        <div class="col-md-4">    
                                            <label>Date Received</label>
                                            <input type="datetime-local" id="edit_received_at" class="form-control"  name="edit_received_at" required> 
                                            @if ($errors->has('edit_received_at'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{ $errors->editRepair->first('edit_received_at') }}
                                                    </strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div> -->
                                </div>
                               
                                <div class="row form-group">   
                                    <div class="col-md-4">   
                                        <label>Item Name</label> 
                                        <input type="text" required name="edit_item_name" class="form-control" id="edit_item_name" disabled="disabled"> 
                                    </div>
                                
                                    <div class='col-md-4'>  
                                        <label>Item State</label> 
                                        <select required name="edit_item_state" class="form-control" id="edit_item_state" disabled="disabled">
                                            <option value='1'> Repairable </option>
                                            <option value='0'> Unrepairable </option>
                                        </select>
                                    </div>

                                    <div class="col-md-2">    
                                        <label for="sel1">Qty Damaged</label>
                                        <input type="number" class="form-control" required name="edit_item_dmqty" id="edit_item_dmqty" disabled="disabled">      
                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div>

                    <!-- SUBMIT BUTTON -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-fill pull-right" id="form-button-add">
                            Edit
                        </button>

                        <button  data-dismiss="modal" aria-hidden="true" class="btn btn-basic pull-right" style="margin-right: 2%">
                            Cancel
                        </button>             
                        <div class="clearfix"></div>
                    </div>
                                    
                </form>                
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

    <!-- VALIDATION ERRORS -->
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            if ({!!count($errors->addRepair)!!} > 0)
                $("#addModal").modal();  

            if ({!!count($errors->addUn)!!} > 0)
                $("#addModal-un").modal();    
        });
    </script>

    <script>

        // LOAD LIST OF SUPPLIED ITEMS ONCE A SUPPLIER IS CHOSEN - UNDAMAGED//
        $(document).ready(function(){ 

            var i=1;
            var options = "";
            $('#supplier_name').click(function() {
                var id = document.getElementById("supplier_name");
                
                var options = "";
                $('.item_name').empty();
                if (id && id.value) {
                    var value = $('#supplier_name').val();
                    $.ajax({
                        url: "/getSupply/" +value,
                        type: "GET",
                        data: {'id' : value},
                        success: function(response){                      
                            for (i = 0; i < response.length; i++) {
                                options += "<option value='" + response[i].inventory_id + "'>" + response[i].inventory_name + "</option>";
                            }
                            $('.item_name').append(options);
                        },
                        error: function(data){
                            console.log(data);
                        }
                    });
                }
            });

            // CREATE ADDITIONAL ITEM FORM
            $('#add-form').click(function() {
                i++;
 
                $('#un-form').append(
                    "<div class='row form-group' id='row-" +i +"'>"+
                        "<div class='col-md-4'>"+           
                            // "<label>Item Name</label>"+
                            "<select class='form-control item_name' name='supply_name[]' id='item-row-"+i+"'  required>"+
                                
                            "</select>"+ 
                            "@if ($errors->addUn->has('supply_name'))"+
                                "<span class='help-block'>"+
                                    "<strong>"+
                                        "{{ $errors->addUn->first('supply_name') }}"+
                                    "</strong>"+
                                "</span>"+
                            "@endif"+
                        "</div>"+

                        // "<div class='col-md-2'>"+             
                        //     "<label>Item Price</label>"+
                        //      "<input type='number' class='form-control' required name='inventory_price[]'>"+
                        // "</div>"+
                        
                        "<div class='col-md-2'>"+             
                            // "<label>Item Quantity</label>"+
                             "<input type='number' class='form-control' required name='inventory_quantity[]'>"+ 
                        "</div>"+

                        "<div class='col-md-2'>"+ 
                            "<button id='"+i +"' type='button' class='btn_remove btn btn-danger btn-fill'> Remove </button>"+
                        "</div>"+
                    "</div>"
                );

                $('#item-row-'+i).append(options);
            });


            // REMOVE ITEM FORM
            $(document).on('click', '.btn_remove', function(){  
               var button_id = $(this).attr("id");   
               $('#row-'+button_id+'').remove();  
            });
        });

        // LOAD LIST OF SUPPLIED ITEMS ONCE A SUPPLIER IS CHOSEN - DAMAGED//
        $(document).ready(function(){ 
            var i=1;
            var options = "";
            $('#dm_supplier_name').click(function() {
                var id = document.getElementById("dm_supplier_name");
                
                options = "";
                $('.dm_item_name').empty();
                if (id && id.value) {

                    var value = $('#dm_supplier_name').val();
                    $.ajax({
                        url: "/getSupplyDamaged/" +value,
                        type: "GET",
                        data: {'id' : value},
                        success: function(response){                      
                            for (i = 0; i < response.length; i++) {
                                options += "<option value='" + response[i].inventory_id + "'>" + response[i].inventory_name + "</option>";
                            }
                            $('.dm_item_name').append(options);
                        },
                        error: function(data){
                            console.log(data);
                        }
                    });
                }
            });

            // CREATE ADDITIONAL ITEM FORM
            $('#add-dm-form').click(function() {
                i++;
 
                $('#dm-form').append(
                    "<div class='row form-group' id='dm-row-" +i +"'>"+   
                        "<div class='col-md-4'>"+    
                            // "<label>Item Name</label>"+
                                "<select class='form-control dm_item_name' id='dm-item-row-"+i+"' name='dm_item_name[]' required>"+
                                "</select> "+ 
                                "@if ($errors->addRepair->has('dm_item_name'))"+
                                "<span class='help-block'>"+
                                    "<strong>"+
                                        "{{ $errors->addRepair->first('dm_item_name') }}"+
                                    "</strong>"+
                                "</span>"+
                            "@endif"+
                        "</div>"+

                        "<div class='col-md-4'>"+    
                            // "<label>State</label>"+
                                "<select class='form-control dm_item_state' id='dm-item-row-"+i+"' name='dm_item_state[]' required>"+
                                    "<option value='' selected='selected'> </option>"+
                                    "<option value='1'> Repairable </option>" +
                                    "<option value='0'> Unrepairable </option>" +
                                "</select> "+ 
                        "</div>"+

                        "<div class='col-md-2'> "+   
                            // "<label for='sel1'>Quantity</label>"+
                            "<input type='number' class='form-control' required name='dm_qty[]'>  "+    
                        "</div>"+
                        

                        "<div class='col-md-2'>"+ 
                            "<button id='"+i +"' type='button' class='dm_btn_remove btn btn-danger btn-fill'> Remove </button>"+
                        "</div>"+
                    "</div>"
                );

                $('#dm-item-row-'+i).append(options);
            });


            // REMOVE ITEM FORM
            $(document).on('click', '.dm_btn_remove', function(){  
               var button_id = $(this).attr("id");   
               $('#dm-row-'+button_id+'').remove();  
            });
        });

        //EDIT UNDAMAGED ITEM
        $(document).on("click", ".edit-btn-un", function () {
            var id = $(this).data('id');

            $.ajax({
                url: "/getItem/" + id,
                type: 'GET',             
                data: {'id' : id },
                success: function(response){
                    // DEBUGGING
                    console.log(response);

                    // SET FORM INPUTS
                    $('#si_id').val(response[0].si_id);
                    $('#supplier_id').val(response[0].supplier_id);
                    $('#item_id').val(response[0].inventory_id);

                    $('#view_supplier_name').val(response[0].supplier_name);
                    $('#view_item_name').val(response[0].inventory_name); 
                    $('#view_curr_quantity').val(response[0].inventory_qty);


                    //DATE TIME FORMATTING
                    var to_erase = response[0].si_date.substr(response[0].si_date.length - 3);
                    var formatted_date = response[0].si_date.replace(to_erase, '');
                    formatted_date = formatted_date.replace(' ', 'T');
                    $('#view_received_at').val(formatted_date);

                    $("#view_pic option[value='"+response[0].user_id+"']").attr('selected', true)

                    // MODAL
                    $("#view-edit-content").show();
                    $("#delete-content").hide();
                    $("#delete-modal-footer").hide();
                },
                error: function(data){
                    console.log(data);
                }
            });

            //FORM
            $("#view-edit-item").attr("action", "/inventory/" +id);
       
            //MODAL
            $("#delete-content").hide();
            $("#delete-modal-footer").hide();
            $('#form-button-edit').show(); 
        });

        // DELETE UNDAMAGED ITEM
        $(document).on("click", ".del-btn-un", function () {
            var id = $(this).data('id');

            //FORM
            $("#delete-item").attr("action", "/inventory/" +id);

            //MODAL
            $(".modal-title").html = "Remove Item";
            $("#view-edit-content").hide();
            $("#delete-content").show();
            $("#delete-modal-footer").show();
        }); 

        // ADD QTY FIXED DAMAGED INVEN
        $(document).on("click", ".edit-repair-btn", function () {
            var id = $(this).data('id');

            $.ajax({
                url: "/getRepair/" + id,
                type: 'GET',             
                data: {'id' : id },
                success: function(response){
                    // DEBUGGING
                    console.log(response);

                    // SET FORM INPUTS
                    $('#repair_id').val(response[0].repair_id);
                    $('#repair_name').text(response[0].inventory_name);

                    //FORM
                    $("#edit-repair-form").attr("action", "/repair/" +id);
                },  
                error: function(data){
                    console.log(data);
                }
            });  
        }); 

        // EDIT ITEM DAMAGED INVEN
        $(document).on("click", ".view-repair-btn", function () {
            var id = $(this).data('id');

            $.ajax({
                url: "/getRepair/" + id,
                type: 'GET',             
                data: {'id' : id },
                success: function(response){
                    // DEBUGGING
                    console.log(response);

                    // SET FORM INPUTS
                    $('#edit_supplier_name').val(response[0].supplier_name);
                    $('#edit_item_name').val(response[0].inventory_name);
                    // $("#edit_handler option[value='"+response[0].repair_user_id+"']").attr('selected', true);

                    // //DATE TIME FORMATTING
                    // var to_erase = (response[0].repair_date).substr(response[0].repair_date.length - 3);
                    // var formatted_date = response[0].repair_date.replace(to_erase, '');
                    // formatted_date = formatted_date.replace(' ', 'T');
                    // $('#edit_received_at').val(formatted_date);
                    $("#edit_item_state option[value='"+response[0].repair_status+"']").attr('selected', true);

                    $('#edit_item_dmqty').val(response[0].repair_qty);

                    //FORM
                    $("#view-repair-form").attr("action", "/repair/" +id);
                },  
                error: function(data){
                    console.log(data);
                }
            });  
        }); 
    </script>
@endsection