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
    <script src="/js/jquery.3.2.1.min.js" type="text/javascript"></script>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="/css/light-bootstrap-dashboard.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="/css/demo.css" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="/css/pe-icon-7-stroke.css" rel="stylesheet" />

    <script type="text/javascript">
        $(document).ready(function(){ 
            var nv_collectors = document.getElementsByClassName("nv-collector");
            var sidebar = document.getElementById("sidebar");
            var inven2 = document.getElementById("2b");
            var inven3 = document.getElementById("3b");

            //Current User => Collector
            @if(\Auth::user() -> user_type == "Collector")
                inven2.style.display = "none";
                inven3.style.display = "none";
                sidebar.remove(); 
                for (var x = 0; x < nv_collectors.length; x++){
                    nv_collectors[x].style.display = "none";
                }
                $("#main-panel").removeClass("main-panel");
        
             @endif
        });

        $(document).on("click", ".toLocation", function () {
            window.location = $(this).data("href");
        }); 
    </script>


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

        .red-dot{
            height: 15px;
            width: 15px;
            background-color: #801515;
            border-radius: 50%;
            display: inline-block;
        }

        .green-dot{
            height: 15px;
            width: 15px;
            background-color: #1E6912;
            border-radius: 50%;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- SIDEBAR -->
        <div id="sidebar" class="sidebar" data-color="none" data-image="/images/lol.png">
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
                    <li class="active">
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
                    <li>
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
                    <li>
                        <a href="{{ route('logs') }}">
                            <i class="pe-7s-note2"></i>
                            <p>Logs</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>


        <div id="main-panel" class="main-panel bgd">

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
                        <a class="navbar-brand" href="#">Inventories</a>
                   </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="/html/user.html">
                                    {{$curr_usr->fname}} {{$curr_usr->mname}}. {{$curr_usr->lname}}  
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
                                    <li class="active" id="inven1">
                                        <a  href="#1b" data-toggle="tab">Undamaged Items</a>
                                    </li>
                                    <li id="inven2" class="nv-collector">
                                        <a href="#2b" data-toggle="tab">Repairable Items</a>
                                    </li>
                                    <li id="inven3" class="nv-collector">
                                        <a href="#3b" data-toggle="tab">Irreparable Items</a>
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
                                                <button type="button" data-target="#addModal-un" data-toggle="modal" class="nv-collector btn btn-success btn-fill" id="add-btn"> 
                                                    Stock In
                                                </button>
                                            </div> 
                                        </div>

                                        <div class="content table-responsive table-full-width">
                                            <table id="inventory-table" class="table table-hover table-striped" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        @if(count($items)>0)
                                                        <th>#</th>
                                                        <th>Item Name</th>
                                                        <th>Supplier</th>
                                                        <th>Price</th>
                                                        <th>Quantity</th>
                                                        <th>Status</th>
                                                        <!-- <th>@sortablelink('received_at', 'Received At')</th> -->
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $x = 0; ?>
                                                    @forelse($items as $item)
                                                        <tr data-target="profileModal" data-toggle="modal" class="view-edit-modal" data-id='{{$item->inventory_id}}'>    
                                                            <td>{{$x+=1}}</td>
                                                            <td>{{$item->inventory_name}}</td>
                                                            <td>{{$item->supplier_name}}</td>
                                                            <td>&#8369;{{$item->inventory_price}}</td>
                                                            <td>{{$item->inventory_qty}}</td>
                                                            <td>
                                                                @if($item->inventory_status == 0)
                                                                <span class="red-dot"></span>
                                                                @else 
                                                                <span class="green-dot"></span>
                                                                @endif
                                                            </td>
                                                            
                                                            <!-- <td>{{$item->received_at}}</td> -->
                                                            <td> 
                                                                <button data-target="#editModal-un" data-toggle="modal" data-id='{{$item->inventory_id}}' class="nv-collector edit-btn-un btn btn-primary btn-fill">
                                                                    View
                                                                </button>
                                                            </td>
                                                            <td>
                                                                <button data-target="#removeUnItem_modal" data-toggle="modal" data-id='{{$item->inventory_id}}' class="nv-collector del-btn-un btn btn-danger btn-fill">
                                                                    Remove
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <h3 style="text-align: center"> No undamaged items to show. </h3>
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
                                                    <h4 class="title" style="margin-top:10px">Repairable Inventory</h4> 
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
                                                <button type="button" data-target="#addModal" data-toggle="modal" class="btn btn-success btn-fill" id="add-repairable-btn"> 
                                                    Add Repairable
                                                </button>
                                            </div> 
                                        </div>

                                        <div class="content table-responsive table-full-width">
                                            <table id="inventory-table" class="table table-hover table-striped" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        @if(count($rrepairs)>0)
                                                        <th>ID</th>
                                                        <th>Item Name</th>
                                                        <th>Supplier Name</th>
                                                        <th>Quantity</th>
                                                        <!-- <th>@sortablelink('received_at', 'Received At')</th> -->
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php $x = 0?>
                                                    @forelse($rrepairs as $rrepair)
                                                        <tr data-toggle="modal" class="view-edit-modal" data-id='{{$rrepair->repair_id}}'>    
                                                            <td>{{$x+=1}}</td>
                                                            <td>{{$rrepair->inventory_name}}</td>
                                                            <td>{{$rrepair->supplier_name}}</td>
                                                            <td>{{$rrepair->repair_qty}}</td>
                                                            <td> 
                                                                <button data-target="#viewModal-dm" data-toggle="modal" id="view-repair-btn" data-id='{{$rrepair->repair_id}}' class="view-repair-btn btn btn-primary btn-fill">
                                                                    View
                                                                </button>
                                                            </td>
                                                            <td> 
                                                                <button data-target="#editModal-dm" data-toggle="modal" id="edit-repair-btn" data-id='{{$rrepair->repair_id}}' class="edit-repair-btn btn btn-info btn-fill">
                                                                    Fix
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <h3 style="text-align: center"> No repairable items to show. </h3>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                        <div style="margin-left: 1%"> 
                                            {{$rrepairs->links()}}
                                        </div>
                                    </div>

                                    <!-- TAB #3 -->
                                    <div class="tab-pane" id="3b">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="header">
                                                    <h4 class="title" style="margin-top:10px">Irreparable Inventory</h4> 
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
                                                <button type="button" data-target="#addModal" data-toggle="modal" class="btn btn-success btn-fill" id="add-irreprable-btn"> 
                                                    Add Irreparable
                                                </button>
                                            </div> 
                                        </div>

                                        <div class="content table-responsive table-full-width">
                                            <table id="inventory-table" class="table table-hover table-striped" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        @if(count($urepairs)>0)
                                                        <th>ID</th>
                                                        <th>Item Name</th>
                                                        <th>Supplier Name</th>
                                                        <th>Quantity</th>
                                                        <!-- <th>@sortablelink('received_at', 'Received At')</th> -->
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php $x = 0?>
                                                    @forelse($urepairs as $urepair)
                                                        <tr data-toggle="modal" class="view-edit-modal" data-id='{{$urepair->repair_id}}'>    
                                                            <td>{{$x+=1}}</td>
                                                            <td>{{$urepair->inventory_name}}</td>
                                                            <td>{{$urepair->supplier_name}}</td>
                                                            <td>{{$urepair->repair_qty}}</td>
                                                            <td> 
                                                                <button data-target="#viewModal-dm" data-toggle="modal" id="view-repair-btn" data-id='{{$urepair->repair_id}}' class="view-repair-btn btn btn-primary btn-fill">
                                                                    View
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <h3 style="text-align: center"> No irreparable items to show. </h3>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                        <div style="margin-left: 1%"> 
                                            {{$urepairs->links()}}
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
                    <h4 class="modal-title">Stock In</h4>
                </div>
                                    
                <div class="modal-body">
                    <div class="row">
                        <!-- USER ADD FORM -->
                        <div class="col-lg-12"> 
                            <form class="form-horizontal" onsubmit="return validateAddUndamaged()" method="POST" action="/inventory/-999">

                          <!--   @if (session('upd-form-error'))
                                <div class="alert alert-danger col-md-12">
                                    {{ session('upd-form-error') }}
                                </div>
                            @endif -->

                                {{ csrf_field() }}
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
                                                <select class="un-item-dynamic form-control item_name" name="supply_name[]" required id="first_item_name">
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
                                             <input type="number" min="1" class="un-qty-dynamic form-control" required name="inventory_quantity[]"> 
                                        </div>
                                    </div>                           
                                </div>


                                <div class="modal-footer">
                                    <!-- SUBMIT BUTTON -->
                                    <button type="button" class="btn btn-info btn-fill pull-left" id="add-form">
                                        Add Item Form
                                    </button>

                                    <button type="submit" class="btn btn-success btn-fill pull-right" id="un-form-btn">
                                        Add Item/s
                                    </button>

                                    <button  id="test"  data-dismiss="modal" aria-hidden="true" class="btn btn-basic pull-right" style="margin-right: 2%">
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
                            <form class="form-horizontal" onsubmit="return validateAddDamaged()" method="POST" action="/repair">
                                {{ csrf_field() }}

                                <!-- SUPPLIER NAME & ADDR DETAILS--> 
                                <input type="hidden" id="repair_type" name="repair_type">
                                <div class="form-group">
                                    <div class="{{$errors->addRepair->has('dm_supplier_name') ? ' has-error' : ''}}"> 
                                        <div class="col-md-4">    
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
                                    </div>

                                </div>

                                <div id="dm-form">                                
                                    <div class="row form-group">   
                                        <div class="{{$errors->addRepair->has('dm_item_name') ? ' has-error' : ''}}"> 
                                            <div class="col-md-4">    
                                                <label>Item Name</label>
                                                <select class="dm-item-dynamic form-control dm_item_name" name="dm_item_name[]" required>
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

                                       <!--  <div class="{{$errors->addRepair->has('dm_state') ? ' has-error' : ''}}"> 
                                            <div class='col-md-4'>  
                                                <label>Item State</label>
                                                    <select class='form-control'  name='dm_item_state[]' required>
                                                        <option value='' selected="selected"> </option>
                                                        <option value='1'> Repairable </option>
                                                        <option value='0'> Irreparable </option>
                                                    </select>
                                                @if ($errors->addRepair->has('dm_state'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->addRepair->first('dm_state') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div> -->

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

                                    <button data-dismiss="modal" aria-hidden="true" class="btn btn-basic pull-right" style="margin-right: 2%">
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <center> <h4 class="modal-title">Item Profile</h4> </center>
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
                                        <input type="text" class="form-control" name="view_supplier_name" disabled required id="view_supplier_name">   
                                    </div>
                                    <input type="hidden" class="form-control" name="supplier_id" id="supplier_id">  
                               
                                    <div class="col-md-4">    
                                        <label for="sel1">Last Handler</label>
                                        <select class="form-control" name="view_pic" required id="view_pic" disabled>
                                        <option value="" data-hidden="true" selected="selected"> </option>
                                            @foreach($users as $user)
                                                <option value="{{$user->user_id}}">
                                                    {{$user->fname}} {{$user->mname}}. {{$user->lname}}
                                                </option>
                                            @endforeach
                                        </select>         
                                    </div>

                                    <div class="{{$errors->has('received_at') ? ' has-error': ''}}">
                                        <div class="col-md-4">    
                                            <label>Last Stocked In</label>
                                            <input type="datetime-local" id="view_received_at" class="form-control" disabled name="view_received_at" required value="{{old('received_at')}}"> 
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
                                            <input type="text" class="form-control item_name" name="view_item_name" disabled id="view_item_name" required> 
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
                                             <input type="number" id="view_item_quantity" class="form-control" min="1" required name="view_inventory_quantity"> 
                                        </div>
                                    </div>                           
                                </div>            

                                <div class="modal-footer" >
                                    <button type="submit" class="btn btn-success btn-fill pull-right" id="form-button-edit">
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
            </div>
        </div>
    </div>

    <!-- ADD FIXED QTY MODAL DAMAGED -->
    <div class="modal fade" role="dialog" id="editModal-dm">
        <div class="modal-dialog modal-md">
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
                            <div class="col-md-6">
                                <label>Item name: </label>
                                    <input id="repair_name" class="form-control" type="text" value="" disabled>
                            </div>
                            <div class="col-md-6">    
                                <label for="sel1">Handler</label>
                                <select class="form-control" name="handled_by" required id="handled_by" required>
                                    @foreach($workers as $worker)
                                        <option value="{{$worker->user_id}}">
                                            {{$worker->fname}} {{$worker->mname}}. {{$worker->lname}}
                                        </option>
                                    @endforeach
                                </select>         
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="{{$errors->editRepair->has('qty_fixed') ? ' has-error' : ''}}">                        
                                <div class="col-md-6">    
                                    <label>Quantity Fixed</label>
                                    <input type="number" min="1" id="qty_fixed" class="form-control" name="qty_fixed">
                                    @if ($errors->has('qty_fixed'))
                                        <span class="help-block">
                                            <strong>
                                                {{ $errors->editRepair->first('qty_fixed') }}
                                            </strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="{{$errors->editRepair->has('fixed_at') ? ' has-error' : ''}}">
                                        <div class="col-md-6">    
                                            <label>Date Fixed</label>
                                            <input type="datetime-local" id="fixed_at" class="form-control"  name="fixed_at" required value="{{App\Inventory::currdate()}}"> 
                                            @if ($errors->has('fixed_at'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{ $errors->editRepair->first('fixed_at') }}
                                                    </strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-bg btn-basic" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-bg btn-success btn-fill">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- VIEW/EDIT MODAL DAMAGED -->
    <div class="modal fade" role="dialog" id="viewModal-dm">
        <div class="modal-dialog modal-md">
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
                                    
                                    <div class="col-md-6">    
                                        <label for="sel1">Supplier Name</label>
                                        <input type="text" required name="edit_supplier_name" class="form-control" id="edit_supplier_name" disabled="disabled"> 
                                    </div>

                                    <!-- <div class="col-md-4">    
                                        <label for="sel1">Handler</label>
                                        <select class="form-control" name="edit_handler" disabled required id="pic" required>
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
                                            <input type="datetime-local" id="edit_received_at" class="form-control"  disabled name="edit_received_at" required value="{{App\Inventory::currdate()}}"> 
                                            @if ($errors->has('edit_received_at'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{ $errors->editRepair->first('edit_received_at') }}
                                                    </strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div> -->
                                    <div class="col-md-6">   
                                        <label>Item Name</label> 
                                        <input type="text" required name="edit_item_name" class="form-control" id="edit_item_name" disabled="disabled"> 
                                    </div>
                                </div>
                               
                                <div class="row form-group">   
                                    
                                
                                   <!--  <div class='col-md-4'>  
                                        <label>Item State</label> 
                                        <select required disabled name="edit_item_state" class="form-control" id="edit_item_state">
                                            <option value='1'> Repairable </option>
                                            <option value='0'> Irreparable </option>
                                        </select>
                                    </div> -->

                                    <div class="col-md-6">    
                                        <label for="sel1">Qty Damaged</label>
                                        <input type="number" class="form-control" required name="edit_item_dmqty" min="1" id="edit_item_dmqty" >      
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

    <!-- REMOVE UNDAMAGED -->
    <div class="modal fade" role="dialog" id="removeUnItem_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Remove Undamaged Item</h4>
                </div>
                     
                <form method="POST" class="form-horizontal" id="removeUnItem_form">  
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="DELETE">

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12"> 
                                <div class="row form-group">                       
                                    <div class="col-md-12">   
                                        You are about to remove an item from the inventory. Do you want to proceed?
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-bg btn-default" data-dismiss="modal">      Cancel
                        </button>
                         
                        <button type="submit" class="btn btn-bg btn-success btn-fill">
                            Remove
                        </button>   
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- UNDAMAGED -->
        @if(session('store-undamaged-success'))
            <script> 
                jQuery(document).ready(function($){
                    $.notify( "{{session()-> get('store-undamaged-success' )}}", "success");
                    {{session()->forget('store-undamaged-success')}}
                });
            </script>
        @endif
        @if(session('update-undamaged-success'))
            <script> 
                jQuery(document).ready(function($){
                    $.notify( "{{session()-> get('update-undamaged-success' )}}", "success");
                    {{session()->forget('update-undamaged-success')}}
                });
            </script>
        @endif
        @if(session('destroy-undamaged-success'))
            <script> 
                jQuery(document).ready(function($){
                    $.notify( "{{session()-> get('destroy-undamaged-success' )}}", "success");
                    {{session()->forget('destroy-undamaged-success')}}
                });
            </script>
        @endif
    <!-- END OF UNDAMAGED -->

    <!-- DAMAGED -->
        @if(session('store-damaged-success'))
            <script> 
                jQuery(document).ready(function($){
                    $.notify( "{{session()-> get('store-damaged-success' )}}", "success");
                    {{session()->forget('store-damaged-success')}}
                });
            </script>
        @endif
        @if(session('update-damaged-success'))
            <script> 
                jQuery(document).ready(function($){
                    $.notify( "{{session()-> get('update-damaged-success' )}}", "success");
                    {{session()->forget('update-damaged-success')}}
                });
            </script>
        @endif
    <!-- END OF DAMAGED -->
</body>

<!--   Core JS Files   -->
   
    <script src="/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Charts Plugin -->
    <script src="/js/chartist.min.js"></script>
    <script src="/js/notify.js"></script>
    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

    <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
    <script src="/js/demo.js"></script>

    
    <script>
        // VALIDATION ERRORS
        document.addEventListener("DOMContentLoaded", function(event) {
            if ({!!count($errors->addRepair)!!} > 0)
                $("#addModal").modal();  

            if ({!!count($errors->addUn)!!} > 0)
                $("#addModal-un").modal();    
        });

        // LOAD LIST OF SUPPLIED ITEMS ONCE A SUPPLIER IS CHOSEN - UNDAMAGED//
        $(document).ready(function(){ 
            $('#add-repairable-btn').click(function() {
                $('#repair_type').val('1');
            });

             $('#add-irreprable-btn').click(function() {
                $('#repair_type').val('0');
            });

            var i=1;
            var options = "";
            $('#supplier_name').click(function() {
                var id = document.getElementById("supplier_name");
                
                options = "";
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
                var copy = $("#first_item_name > option").clone();
                i++;
 
                $('#un-form').append(
                    "<div class='row form-group' id='row-" +i +"'>"+
                        "<div class='col-md-4'>"+           
                            // "<label>Item Name</label>"+
                            "<select class='un-item-dynamic form-control item_name' name='supply_name[]' id='item-row-"+i+"'  required>"+
                                
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
                             "<input type='number' class='un-qty-dynamic form-control' required name='inventory_quantity[]'>"+ 
                        "</div>"+

                        "<div class='col-md-2'>"+ 
                            "<button id='"+i +"' type='button' class='btn_remove btn btn-danger btn-fill'> Remove </button>"+
                        "</div>"+
                    "</div>"
                );

                $('#item-row-'+i).append(copy);
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
                                "<select class='dm-item-dynamic form-control dm_item_name' id='dm-item-row-"+i+"' name='dm_item_name[]' required>"+
                                "</select> "+ 
                                "@if ($errors->addRepair->has('dm_item_name'))"+
                                "<span class='help-block'>"+
                                    "<strong>"+
                                        "{{ $errors->addRepair->first('dm_item_name') }}"+
                                    "</strong>"+
                                "</span>"+
                            "@endif"+
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
                    //!!!!!!
                    // response = JSON(response);
                    console.log(response);

                    // SET FORM INPUTS
                    $('#si_id').val(response.si_id);
                    $('#supplier_id').val(response.supplier_id);
                    $('#item_id').val(response.inventory_id);

                    $('#view_supplier_name').val(response.supplier_name);
                    $('#view_item_name').val(response.inventory_name); 
                    $('#view_curr_quantity').val(response.inventory_qty);


                    //DATE TIME FORMATTING
                    var to_erase = response.si_date.substr(response.si_date.length - 3);
                    var formatted_date = response.si_date.replace(to_erase, '');
                    formatted_date = formatted_date.replace(' ', 'T');
                    $('#view_received_at').val(formatted_date);

                    $("#view_pic option[value='"+response.user_id+"']").attr('selected', true)
                },
                error: function(data){
                    console.log(data);
                }
            });

            //FORM
            $("#view-edit-item").attr("action", "/inventory/" +id);
    
        });

        // DELETE UNDAMAGED ITEM
        $(document).on("click", ".del-btn-un", function () {
            var id = $(this).data('id');

            //FORM
            $("#removeUnItem_form").attr("action", "/inventory/" +id);

            //MODAL
            $(".modal-title").html = "Remove Item";
        }); 

        // ADD QTY FIXED DAMAGED INVENTORY
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
                    $('#repair_name').val(response[0].inventory_name);

                    //FORM
                    $("#edit-repair-form").attr("action", "/repair/" +id);
                },  
                error: function(data){
                    console.log(data);
                }
            });  
        }); 

        // EDIT ITEM DAMAGED INVENTORY
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
                    $("#edit_handler option[value='"+response[0].repair_user_id+"']").attr('selected', true);

                    //DATE TIME FORMATTING
                    var to_erase = (response[0].repair_ddate).substr(response[0].repair_ddate.length - 3);
                    var formatted_date = response[0].repair_ddate.replace(to_erase, '');
                    formatted_date = formatted_date.replace(' ', 'T');
                    $('#edit_received_at').val(formatted_date);
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

        //MAINTAIN ACTIVE TAB
        $(document).ready(function(){ 
            $('a[data-toggle="tab"]').click(function (e) {
                e.preventDefault();
                $(this).tab('show');
            });

            $('a[data-toggle="tab"]').on("shown.bs.tab", function (e) {
                var id = $(e.target).attr("href");
                localStorage.setItem('selectedTab', id)
            });

            var selectedTab = localStorage.getItem('selectedTab');
            if (selectedTab != null) {
                $('a[data-toggle="tab"][href="' + selectedTab + '"]').tab('show');
            }
        });
    </script>

   
    <script>
        // UPDATE QTY DYNAMIC FORM VALIDATION
        function validateAddUndamaged() {
            var item_inputs = $(".un-item-dynamic");
            return hasDuplicates(item_inputs);
        }

        function validateAddDamaged() {
            var item_inputs = $(".dm-item-dynamic");
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