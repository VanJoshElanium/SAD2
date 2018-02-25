@extends('layouts.app')

@section('content')
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="/public/images/Prince and Princes logo/6.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Term Profile</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="/css/bootstrap.min.css" rel="stylesheet" />


    <script src="/js/jquery.3.2.1.min.js" type="text/javascript"></script>

    <!-- Animation library for notifications   -->
    <link href="/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


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
                    <li class="active">
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

        <div class="main-panel bgd">
            <!-- NAVBAR -->
            <nav class="navbar navbar-default navbar-fixed">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                           <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Term Profile</a>
                   </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
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

            <!-- TAB CONTENTS -->
            <div class="content">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <div class="card box">        
                            <!-- NAVIGATION TABS -->
                            <ul class="nav nav-tabs" role="tablist" id="myTab">
                                <li role="presentation" class="active">
                                    <a href="#tl_members" aria-controls="home" role="tab" data-toggle="tab">
                                        <span data-toggle="tooltip" data-placement="bottom" title="This tab contains the details of the people that are managing the term.">
                                            Members &amp; Location
                                        </span>
                                    </a>
                                </li>

                                <li role="presentation">
                                    <a href="#tl_items" aria-controls="profile" role="tab" data-toggle="tab">
                                        <span data-toggle="tooltip" data-placement="bottom" title="This tab contains the item details.">
                                            Items
                                        </span>
                                    </a>
                                </li>
                                
                                <li role="presentation">
                                    <a href="#tl_expenses" aria-controls="profile" role="tab" data-toggle="tab">
                                    <!-- <a> -->
                                        <span data-toggle="tooltip" data-placement="bottom" title="This tab contains the expneses used for the term.">      Expenses
                                        </span>
                                    </a>
                                </li>  
                                
                                <li role="presentation">
                                    <a href="#tl_sales" aria-controls="profile" role="tab" data-toggle="tab">
                                        <span data-toggle="tooltip" data-placement="bottom" title="This tab contains the sales and share calculated in the term.">
                                            Collections
                                        </span>
                                    </a>
                                </li>
                                
                                <li role="presentation">
                                    <a href="#tl_customers" aria-controls="profile" role="tab" data-toggle="tab">
                                        <span data-toggle="tooltip" data-placement="bottom" title="This tab contains the sales and share calculated in the term.">
                                            Customers
                                        </span>
                                    </a>
                                </li>
                            </ul>
                            <br>
                            <!-- NAVTABS CONTENT -->
                            <div class="tab-content">

                                <!-- TERM WORKERS & LOCATION -->
                                <div role="tabpanel" class="tab-pane fade in active" id="tl_members">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-8">
                                                <div class="card">
                                                    <div class="header">
                                                        <div class="col-md-4">
                                                            <h4 class="title">Peddlers</h4>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <span class="pull-right">      
                                                                <button type="button" data-target="#addPeddler" data-toggle="modal" class="btn btn-success btn-fill" id="add-btn">Add Peddler</button>  
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="content table-responsive table-full-width">
                                                        <table class="table table-hover table-striped">
                                                            <thead>
                                                                @if(count($workers) > 0)
                                                                <th>Name</th>
                                                                <th>Position</th>
                                                                <!--<th>Edit</th>
                                                                <th>Remove</th> -->
                                                                @endif
                                                            </thead>
                                                            <tbody>  
                                                                @forelse($workers as $worker)
                                                                <tr>
                                                                    <td>
                                                                        {{$worker->fname}}
                                                                        {{$worker->mname}}.
                                                                        {{$worker->lname}}
                                                                    </td> 
                                                                   
                                                                    @if ($worker->worker_type == 0)
                                                                            
                                                                        @elseif ($worker->worker_type == 1)
                                                                            <td> Team Leader </td>
                                                                        @elseif ($worker->worker_type == 2)
                                                                            <td> Permament Staff </td>
                                                                        @else
                                                                            <td> Temporary Staff </td>
                                                                    @endif
                                                                    
                                                                    <td>
                                                                        <span data-toggle="tooltip" data-placement="bottom" title="Edit the position of the peddler."> 
                                                                            <button type="button" data-target="#editPeddler" data-id='{{$worker->worker_id}}' data-toggle="modal" class="ep_btn btn  btn-primary btn-fill" id="ep-{{$worker->worker_id}}"> 
                                                                            Edit
                                                                            </button>
                                                                        </span>
                                                                    </td>
                                                                    <td>
                                                                        <button type="button" data-target="#removePeddler" data-id='{{$worker->worker_id}}' data-toggle="modal" class="rp_btn btn  btn-danger btn-fill" id="rp_btn"> 
                                                                        Remove
                                                                        </button>   
                                                                    </td>
                                                                </tr>
                                                                @empty
                                                                    <h3 style="text-align: center"> No peddlers for this term.</h3>
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div style="margin-left: 1%"> 
                                                    {{$workers->links()}} 
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="card">
                                                    <div class="header">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <button type="button" id="editTermDetails_btn" data-target="#editTerm" data-toggle="modal" class="btn pull-right btn-basic btn-fill" data-id="{{$term[0]->term_id}}" style="margin-bottom: 3%"> 
                                                                    Edit Details
                                                                </button> 
                                                            </div>
                                                        </div>
                                                            <h4 class="title">
                                                                {{$term[0]->fname}} {{$term[0]->mname}}. {{$term[0]->lname}}
                                                            </h4>
                                                            <p class="category">
                                                                Collector
                                                            </p>
                                                            <br>
                                                            <hr>
                                                            <h4 class="title">
                                                                {{$term[0]->location}}
                                                            </h4>
                                                            <p class="category">
                                                                Term Location
                                                            </p>
                                                            <br>
                                                            <hr>  
                                                            <h4 class="title">
                                                                {{$term[0]->start_date}}
                                                            </h4>
                                                            <p class="category">
                                                                Peddling Start
                                                            </p>
                                                            <br>
                                                            <hr> 
                                                            <h4 class="title">
                                                                @if($term[0]->end_date == NULL)
                                                                    N/A
                                                                @else 
                                                                    {{$term[0]->end_date}}
                                                                @endif
                                                            </h4>
                                                            <p class="category">
                                                                Peddling End
                                                            </p>
                                                            <br>
                                                            <hr>
                                                            <h4 class="title">
                                                                @if($term[0]->finish_date == NULL)
                                                                    N/A
                                                                @else 
                                                                    {{$term[0]->finish_date}}
                                                                @endif
                                                            </h4>
                                                            <p class="category">
                                                                Collecting End
                                                            </p>
                                                            <hr> 
                                                    </div>
                                                </div>
                                            </div>         
                                        </div>  
                                    </div>
                                </div>

                                <!-- TERM ITEMS -->
                                <div role="tabpanel" class="tab-pane fade" id="tl_items">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-10">
                                                <div class="card">
                                                    <div class="header">
                                                        <div class="col-md-4">
                                                            <h4 class="title">Item List</h4>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <span class="pull-right">
                                                                  
                                                                <button type="button" data-target="#addItem" data-toggle="modal" class="btn btn-success btn-fill"> 
                                                                    Add Item/s
                                                                </button>
                                                                <button type="button" data-target="#editItem" data-toggle="modal" class="btn btn-info btn-fill" > 
                                                                    Edit Item
                                                                </button>
                                                                <button type="button" data-target="#printItems" data-toggle="modal" class="btn btn-basic btn-fill"> 
                                                                    Print Items
                                                                </button> 
                                                            </span>    
                                                        </div>
                                                    </div>
                                                    <div class="content table-responsive table-full-width">
                                                        <table class="table table-hover table-striped" cellspacing="0" width="100%">
                                                            <thead>
                                                                @if(count($term_items) > 0)
                                                                <th>ID</th>
                                                                <th>Item Name</th>
                                                                <th>Supplier Name</th>
                                                                <th>
                                                                    <span data-toggle="tooltip" data-placement="bottom" title="Original Price + 25%">
                                                                    Price
                                                                    </span>
                                                                </th>
                                                                <th>Original</th>
                                                                <th>Damaged</th>
                                                                <th>Returned</th>
                                                                <th>Sold</th>
                                                                @endif
                                                            </thead>
                                                            <tbody>
                                                                @forelse($term_items as $term_item)
                                                                <tr style="text-align: left">
                                                                    <td> 
                                                                        {{$term_item -> ti_id}}
                                                                    </td>
                                                                    <td> 
                                                                        {{$term_item -> inventory_name}}
                                                                    </td>

                                                                    <td>
                                                                        {{$term_item -> supplier_name}}
                                                                    </td>
                                                                    <td>
                                                                        &#8369;{{$term_item -> inventory_price + ($term_item -> inventory_price * 0.25)}}
                                                                    </td>
                                                                    <td>
                                                                        {{$term_item->ti_original}}
                                                                    </td>
                                                                    <td>
                                                                        {{$term_item->ti_damaged}}
                                                                    </td>
                                                                    <td>
                                                                        {{$term_item->ti_returned}}
                                                                    </td>
                                                                    <td>
                                                                        @if($term_item->ti_returned != 0 || $term_item->ti_damaged != 0)
                                                                            {{$term_item->ti_original -($term_item->ti_damaged + $term_item->ti_returned)}}
                                                                        @else {{$term_item->ti_original}}
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <button type="button" data-target="#removeItem" data-toggle="modal" data-id="{{$term_item->ti_id}}" class="btn btn-sm  btn-danger btn-fill ri_btn"> 
                                                                            -
                                                                        </button> 
                                                                    </td>
                                                                </tr>
                                                                @empty
                                                                    <h3 style="text-align: center"> No items for this term.</h3>
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div > 
                                                        {{$term_items->links()}} 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="card">
                                                    <div class="header">
                                                        <center>
                                                            <p class="category">
                                                                Number of items
                                                            </p>    
                                                            <h4 class="title">
                                                                {{$total_items}}
                                                            </h4>
                                                            <br><hr>

                                                            <p class="category">
                                                                Total damaged items
                                                            </p>    
                                                            <h4 class="title">
                                                                {{$total_damages}}
                                                            </h4>
                                                            <br><hr>

                                                            <p class="category">
                                                                Total returned items
                                                            </p>    
                                                            <h4 class="title">
                                                                {{$total_returns}}
                                                            </h4>
                                                            <br><hr>  

                                                            <p class="category">
                                                                Total sold items</p>
                                                            <h4 class="title">
                                                                {{$total_sales}}
                                                            </h4>    
                                                            <hr>    
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>      
                                        </div>
                                    </div>
                                </div>

                                <!-- TERM EXPENSES -->
                                <div role="tabpanel" class="tab-pane fade" id="tl_expenses">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-8">
                                                <div class="card">
                                                    <div class="header">
                                                        <div class="col-md-4">
                                                            <h4 class="title"> Expenses </h4>
                                                        </div>

                                                        <div class="col-md-8">
                                                            <span class="pull-right">
                                                                <button type="button" data-target="#addExpense" data-toggle="modal" class="btn btn-success btn-fill" id="ae_btn"> Add Expense
                                                                </button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="content table-responsive table-full-width">
                                                        <table class="table table-hover table-striped">
                                                            <thead>
                                                                @if(count($expenses) > 0)
                                                                <th> ID </th>
                                                                <th>Expense</th>
                                                                <th>Amount</th>
                                                                @endif
                                                            </thead>
                                                            <tbody>
                                                                @forelse ($expenses as $expense)
                                                                <tr>
                                                                    <td>
                                                                        {{$expense -> expense_id}} 
                                                                    </td> 
                                                                    <td>
                                                                        {{$expense -> expense_name}} 
                                                                    </td> 
                                                                    <td> 
                                                                        &#8369; {{$expense -> expense_amt}} 
                                                                    </td>
                                                                    <td> 
                                                                        {{$expense -> expense_date}} 
                                                                    </td>
                                                                    <td>
                                                                        <button type="button" id="expense-view-edit-{{$expense->expense_id}}" data-target="#editExpense" data-toggle="modal" data-id="{{$expense->expense_id}}" class="btn btn-fill btn-primary ee_btn"> 
                                                                            View
                                                                        </button>
                                                                    </td>
                                                                    <td>
                                                                        <button type="button" data-target="#removeExpense" data-toggle="modal" data-id="{{$expense->expense_id}}" class="btn  btn-danger btn-fill re_btn"> 
                                                                            Remove
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                                @empty
                                                                    <h3 style="text-align: center"> No expenses for this term.</h3>
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div style="margin-left: 1%"> 
                                                    {{$expenses->links()}} 
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="card">
                                                    <div class="header"><br><br>
                                                        <center>
                                                                
                                                            <h3 class="title">&#8369; {{$total_expense}}</h3>
                                                            <p class="category">Total Expense</p>
                                                            <br>
                                                            <br>
                                                            <hr>    
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                </div>

                                <!-- TERM SALES -->
                                <div role="tabpanel" class="tab-pane fade" id="tl_sales">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-8">

                                                <div class="card">
                                                    <div class="header">
                                                        <div class="col-md-4">
                                                            <h4 class="title">Collections</h4>
                                                        </div>
                                                        <span class="pull-right">
                                                            <button type="button" data-target="#addCollection" data-toggle="modal" class="btn btn-success btn-fill" id="add-btn">Add Collection</button>
                                                        </span>
                                                    </div>
                                                    <div class="content table-responsive table-full-width">
                                                        <table class="table table-hover table-striped">
                                                            <thead>
                                                            @if(count($sales) > 0)
                                                                <th>ID</th>
                                                                <th>Date</th>
                                                                <th>Amount</th>
                                                                @endif
                                                            </thead>
                                                            <tbody>
                                                                @forelse($sales as $sale)
                                                                <tr>
                                                                    <td> 
                                                                        {{$sale->sale_id}}
                                                                    </td>
                                                                    <td>
                                                                        {{$sale->sales_date}}
                                                                    </td> 
                                                                    <td>
                                                                        &#8369;{{$sale->sales_amt}}
                                                                    </td>
                                                                    <td>
                                                                        <button type="button" data-target="#editCollection" data-id="{{$sale->sale_id}}" data-toggle="modal" class="viewCollection_btn btn  btn-primary btn-fill" id="viewCollection_btn">  View
                                                                        </button>
                                                                    </td>
                                                                    <td>
                                                                        <button type="button" data-target="#removeCollection" data-toggle="modal" data-id="{{$sale->sale_id}}" class="removeCollection_btn btn  btn-danger btn-fill" id="removeCollection_btn">  Remove
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                                @empty
                                                                    <h3 style="text-align: center"> No sales for this term.</h3>  
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div style="margin-left: 1%"> 
                                                    {{$sales->links()}} 
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <div class="header">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button type="button" data-target="#printSales" data-toggle="modal" class="btn pull-right btn-basic btn-fill"> 
                                                                        Print Sales
                                                                    </button> 
                                                        </div>
                                                    </div>
                                                    <!-- Total expense -->
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                          <h4 class="title">&#8369;{{$total_expense}}</h4>
                                                        <p class="category">
                                                            Total Expenses
                                                        </p>  
                                                        </div>
                                                    </div><br><br>
                                                    <!-- Total sale-->
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            @foreach($term_items as $term_item)
                                                                <?php $total_sale += 
                                                                ($term_item->ti_original -($term_item->ti_damaged + $term_item->ti_returned)) *
                                                                ($term_item -> inventory_price + ($term_item -> inventory_price * 0.25)) ?>
                                                            @endforeach
                                                        <h4 class="title">&#8369; {{$total_sale}}</h4>    
                                                            
                                                        <p class="category">
                                                            Total Sales</p>
                                                        </div>
                                                    </div><br><br>
                                                    <!-- Total revenue -->
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h4 class="title">&#8369;{{$total_sale * 0.25}}</h4>
                                                        <p class="category">
                                                            Total Revenue
                                                        </p>
                                                        </div>
                                                    </div><br><br>
                                                    <!-- Collectable amount -->
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h4 class="title"> &#8369;{{$total_sale + $total_expense +($total_sale * 0.25)}}</h4>
                                                        <p class="category">
                                                           Amount Collectable
                                                        </p>
                                                        </div>
                                                    </div><br><br>
                                                        <!-- Collected amount -->
                                                        <div class="modal-footer">
                                                            <h4 class="title">&#8369;{{$total_collected}}</h4>    
                                                            <p class="category">
                                                                Collected Amount
                                                            </p>
                                                        </div>
                                                        <hr>     
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- TERM CUSTOMERS -->
                                <div role="tabpanel" class="tab-pane fade" id="tl_customers">
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                                <!-- LIst of unpaid customers-->
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="header">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <h4 class="title">Unpaid Customers</h4>
                                                                    <p class="category">Customers whose payments have not yet been collected.</p>
                                                                </div>

                                                                <div class="col-md-2 pull-right">
                                                                    <button data-target="#addCustomer
                                                                    " id="" data-toggle="modal" data-id='' class="edit-btn btn btn-success btn-fill pull-right">
                                                                        Add Customer 
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="content table-responsive table-full-width">
                                                            <table class="table table-hover table-striped">
                                                                <thead>
                                                                @if(count($unpaid_customers) > 0)
                                                                    <th>No.</th>
                                                                    <th>Name</th>
                                                                    <th>Contact Number</th>
                                                                    <th>Total Payable</th>
                                                                    <!-- <th>Edit</th>
                                                                    <th>View</th> -->
                                                                @endif
                                                                </thead>
                                                                <tbody>
                                                                @forelse ($unpaid_customers as $unpaid_customer)
                                                                    <tr>
                                                                        <td> 
                                                                            {{$unpaid_customer -> customer_id}} </td>
                                                                        <td> 
                                                                            {{$unpaid_customer -> customer_fname}} 
                                                                            {{$unpaid_customer -> customer_mname}}. {{$unpaid_customer -> customer_lname}}
                                                                        </td>
                                                                        <td> 
                                                                            {{$unpaid_customer -> customer_cnum}} 
                                                                        </td>
                                                                        <td>
                                                                            &#8369;{{$unpaid_customer -> total_payable}}
                                                                        </td>
                                                                        <td>
                                                                            <button data-target="#editCustomer" data-toggle="modal" id="viewCustomer-{{$unpaid_customer -> co_id}}"  data-id='{{$unpaid_customer -> co_id}}' class="viewCustomer_btn btn btn-primary btn-fill">
                                                                                View
                                                                            </button>
                                                                        </td>
                                                                        <td>
                                                                            <button data-target="#payCustomer" data-toggle="modal" data-id='{{$unpaid_customer -> co_id}}' class="payCustomer_btn btn btn-info btn-fill">
                                                                                Paid
                                                                            </button>
                                                                        </td>
                                                                        <td>
                                                                            <button data-target="#removeCustomer" data-toggle="modal" data-id='{{$unpaid_customer -> co_id}}' class="btn btn-danger btn-fill removeCustomer_btn">
                                                                                Remove
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                @empty
                                                                    <h3> No unpaid customers for this term</h3>
                                                                @endforelse
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                    <!-- List of paid customers-->
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="header">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <h4 class="title">Paid Customers</h4>
                                                                    <p class="category">Customers whose payments have already been collected.</p>
                                                                </div>
                                                                <!--Just leaving this "div" part incase if we add some buttons and stuff-->
                                                                <div class="col-md-2 pull-right">

                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="content table-responsive table-full-width">
                                                            <table class="table table-hover table-striped">
                                                                <thead>
                                                                    @if(count($paid_customers) >0)
                                                                    <th>No.</th>
                                                                    <th>Name</th>
                                                                    <th>Date Paid</th>
                                                                    <th>Total Paid</th>
                                                                    @endif
                                                                </thead>
                                                                <tbody>
                                                                @forelse($paid_customers as $paid_customer)
                                                                    <tr>
                                                                        <td>{{$paid_customer -> customer_id}}</td>
                                                                        <td>
                                                                            {{$paid_customer -> customer_fname}}
                                                                            {{$paid_customer -> customer_mname}}.
                                                                            {{$paid_customer -> customer_lname}}
                                                                        </td>
                                                                        <td>
                                                                            {{$paid_customer -> co_collect_date}}
                                                                        </td>
                                                                        <td>
                                                                            &#8369; {{$paid_customer -> total_payable}}
                                                                        </td>
                                                                        <td>
                                                                        <button data-target="#editCustomer" id="viewPCustomer-{{$paid_customer->customer_id}}" data-toggle="modal" data-id='{{$paid_customer->customer_id}}' class="viewCustomer_btn btn btn-primary btn-fill">
                                                                            View 
                                                                        </button>
                                                                        </td>
                                                                        <td>
                                                                        <button data-target="#removeCustomer" data-toggle="modal" data-id='{{$paid_customer -> co_id}}' class="btn btn-danger btn-fill removeCustomer_btn">
                                                                                Remove
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                    @empty
                                                                        <h3> No paid customers for this term</h3>
                                                                    @endforelse
                                                                </tbody>
                                                            </table>
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
            </div>
        </div>
    </div>

    <!--MODALS-->

    <!-- EDIT TERM DETAILS -->
    <div class="modal fade" role="dialog" id="editTerm">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <center> <h4 class="modal-title"> Edit Term Details</h4> </center>
                </div>
                
                <form id="editTermDetails_form" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="modal-body">
                        <div id="view-edit-content" class="row">
                        <!-- Term edit form-->
                            <div class="col-md-12"> 
                                <!-- Term Collector -->
                                <div class="row form-group">                       
                                    <div class="{{ $errors->editTerm->has('et_collector') ? ' has-error' : '' }}"> 
                                        <div class="col-md-8">    
                                            <label class="sel1">Collector Name</label>
                                                  <select class="form-control" required id="et_collector" name="et_collector">
                                                    @foreach($collectors as $collector)
                                                        <option value='{{$collector->user_id}}' 
                                                            >
                                                            {{$collector->fname}}&nbsp
                                                            {{$collector->mname}}.
                                                            {{$collector->lname}}
                                                        </option>
                                                    @endforeach
                                                  </select>
                                            
                                                @if ($errors->editTerm->has('et_collector'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->editTerm->first('et_collector') }}</strong>
                                                    </span>
                                                @endif     
                                        </div>
                                    </div>
                                </div>
                                <!-- Term Location -->
                                <div class="row form-group">
                                    <div class="{{ $errors->editTerm->has('et_location') ? ' has-error' : '' }}">
                                        <div class="col-md-8">  
                                            <label>Location</label>
                                            <textarea rows='2' id="et_location" class="form-control"  name="et_location" required value="{{ old('et_location') }}"></textarea>

                                                @if ($errors->editTerm->has('et_location'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->editTerm->first('et_location') }}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- Peddling Start-->
                                <div class="row form-group">
                                    <div class="{{ $errors->editTerm->has('et_startdate') ? ' has-error' : '' }}">
                                        <div class="col-md-6">
                                            <label>Peddling Start</label>
                                            <input name="et_startdate"  id="et_startdate" class="form-control" type="text" onfocus="(this.type='date')" required onblur="if(!this.value)this.type='text'" value="{{ old('et_startdate') }}">
                                                                                
                                            @if ($errors->editTerm->has('et_startdate'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->editTerm->first('et_startdate') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div> 
                                </div>
                                <!-- Peddling End-->
                                <div class="row form-group">
                                    <div class="{{ $errors->editTerm->has('et_enddate') ? ' has-error' : '' }}">
                                        <div class="col-md-6">
                                            <label>Peddling End</label>
                                            <input name="et_enddate"  id="et_enddate" class="form-control" type="text" onfocus="(this.type='date')"  onblur="if(!this.value)this.type='text'" value="{{ old('et_enddate') }}">
                                                                                
                                            @if ($errors->editTerm->has('et_enddate'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->editTerm->first('et_enddate') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div> 
                                </div>
                                <!-- Collecting End-->
                                <div class="row form-group">
                                    <div class="{{ $errors->editTerm->has('et_finishdate') ? ' has-error' : '' }}">
                                        <div class="col-md-6">
                                            <label>Collecting End</label>
                                            <input name="et_finishdate"  id="et_finishdate" class="form-control" type="text" onfocus="(this.type='date')"  onblur="if(!this.value)this.type='text'" value="{{ old('et_finishdate') }}">
                                                                                
                                            @if ($errors->editTerm->has('et_finishdate'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->editTerm->first('et_finishdate') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button  data-dismiss="modal" aria-hidden="true" class="btn btn-basic">
                            Cancel
                        </button>

                        <button type="submit" class="btn btn-success btn-fill pull-right" id="form-button-add">
                            Save
                        </button>      
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--ADD PEDDLER-->
    <div class="modal fade" role="dialog" id="addPeddler">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <center>
                        <h4 class="modal-title">Add Peddler</h4>
                    </center>
                </div>
                
                <form method="POST" class="form-horizontal" action="/workers">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">                   
                                <input type="hidden" name="term_id" id="term_id" value="{{$term[0]->term_id}}">                         
                                <div class="row form-group">                       
                                    <div class="{{ $errors->addPeddler->has('peddler') ? ' has-error' : '' }}"> 
                                        <div class="col-md-8">   
                                            <!--Acquires the list of workers within users table-->
                                            <label class="sel1">Peddler Name:</label>
                                            <select class="form-control" name="peddler" required id="peddler">
                                                <option value="" data-hidden="true" selected="selected">
                                                </option>
                                                @foreach($a_peddlers as $a_peddler)
                                                    <option value="{{$a_peddler->user_id}}">
                                                        {{$a_peddler->fname}}&nbsp
                                                        {{$a_peddler->mname}}.
                                                        {{$a_peddler->lname}}
                                                    </option>
                                                @endforeach
                                            </select>           
                                            @if ($errors->addPeddler->has('peddler'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->addPeddler->first('peddler') }}</strong>
                                                </span>
                                            @endif                   
                                        </div>
                                    </div>
                                                        
                                    <div class="{{ $errors->addPeddler->has('position') ? ' has-error' : '' }}"> 
                                        <div class="col-md-4">    
                                            <label class="sel1">Position:</label>
                                            <select name="position" required class="form-control" id="position">
                                                <option value="" selected="selected"></option>
                                                <option value="1">Team Leader</option>
                                                <option value="2">Permanent Staff</option>
                                                <option value="3">Temporary Staff</option>  
                                            </select>
                                            @if ($errors->addPeddler->has('position'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{ $errors->addPeddler->first('position') }}
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
                        <button  data-dismiss="modal" aria-hidden="true" class="btn btn-basic">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-success btn-fill pull-right" id="form-button-add">
                          Add
                        </button>      
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--REMOVE PEDDLER-->
    <div class="modal fade" role="dialog" id="removePeddler">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Remove Peddler</h4>
                </div>
                     
                <form method="POST" class="form-horizontal" id="removePeddler_form">  
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="DELETE">

                    <div class="modal-body">
                        <div id="view-edit-content" class="row">
                            <div class="col-md-12"> 
                                <div class="row form-group">                       
                                    <div class=""> 
                                        <div class="col-md-12">   
                                            You are about to remove a peddler from this term. Do you want to proceed?
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

    <!--EDIT PEDDLER-->
    <div class="modal fade" role="dialog" id="editPeddler">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Peddler</h4>
                </div>
                
                <form method="POST" class="form-horizontal" id="editPeddler_form">  
                    {{csrf_field()}}
                    {{method_field('PUT')}} 

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">                   
                                <input type="hidden" name="term_id" id="term_id" value="{{$term[0]->term_id}}">                         
                                <div class="row form-group">                       
                                    <div class="{{ $errors->editPeddler->has('edit_peddler') ? ' has-error' : '' }}"> 
                                        <div class="col-md-8">  
                                            <input type="hidden" id="edit_peddler" id="edit_peddler">
                                            <label class="sel1">Peddler Name:</label>
                                            <input type="text" id="peddler_name" name="peddler_name" class="form-control">                  
                                        </div>
                                    </div>
                                                        
                                    <div class="{{ $errors->editPeddler->has('edit_position') ? ' has-error' : '' }}"> 
                                        <div class="col-md-4">    
                                            <label class="sel1">Position:</label>
                                            <select name="edit_position" required class="form-control" id="edit_position" required>
                                                <option value="1">Team Leader</option>
                                                <option value="2">Permanent Staff</option>
                                                <option value="3">Temporary Staff</option>  
                                            </select>
                                            @if ($errors->editPeddler->has('edit_position'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{ $errors->editPeddler->first('edit_position') }}
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
                        <button type="button" class="btn btn-bg btn-default" data-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-bg btn-success btn-fill" >
                            Edit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--REMOVE ITEM-->
    <div class="modal fade" role="dialog" id="removeItem">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Remove Item</h4>
                </div>
                                        
                <form method="POST" class="form-horizontal" id="removeItem_form">  

                    {{csrf_field()}}
                    {{method_field('DELETE')}}

                    <div class="modal-body">
                        <div id="view-edit-content" class="row">
                            <div class="col-md-12"> 
                                <div class="row form-group">                       
                                    <div class="col-md-12">   
                                        You are about to remove an item from this term. Do you want to proceed?
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-bg btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-bg btn-success btn-fill">Remove</button>   
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--ADD ITEM-->
    <div class="modal fade" role="dialog" id="addItem">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> 
                        <center> Add Term Item </center>
                    </h4>
                </div>             
                <form method="POST" class="form-horizontal" id="addItem_form" action="/term_items">   
                    {{csrf_field()}} 
                    <input type="hidden" name="term_id" id="term_id" value="{{$term[0]->term_id}}">

                    <div class="modal-body">
                        <div id="view-edit-content" class="row">
                            <div class="col-md-12">                                 
                                <div class="row form-group">
                                    <div class="{{ $errors->addItem->has('add_ti_date') ? ' has-error' : '' }}">
                                        <div class="col-md-6">
                                            <label>Stock Out</label>
                                            <input type="datetime-local" id="add_ti_date" class="form-control" max="{{Carbon\Carbon::now()->toDateString()}}" name="add_ti_date" required value="{{App\Inventory::currdate()}}"> 
                                                                                
                                            @if ($errors->addItem->has('add_ti_date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->addItem->first('add_ti_date') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div> 

                                    <div class="{{ $errors->addItem->has('add_ti_worker') ? ' has-error' : '' }}"> 
                                        <div class="col-md-6">   
                                            <!--Acquires the list of workers within users table-->
                                            <label class="sel1">Handler:</label>
                                            <select class="form-control" name="add_ti_worker" required id="add_ti_worker">
                                                <option value="" data-hidden="true" selected="selected">
                                                </option>
                                                @foreach($peddlers as $peddler)
                                                    <option value="{{$peddler-> user_id}}">
                                                        {{$peddler->fname}}&nbsp
                                                        {{$peddler->mname}}.
                                                        {{$peddler->lname}}
                                                    </option>
                                                @endforeach
                                            </select>           
                                            @if ($errors->addItem->has('add_ti_worker'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->addItem->first('add_ti_worker') }}</strong>
                                                </span>
                                            @endif                   
                                        </div>
                                    </div>
                                </div>
                                
                                    <div class="row form-group">   
                                        <div class="{{$errors->addItem->has('add_ti_item_name') ? ' has-error' : ''}}"> 
                                            <div class="col-md-8">              
                                                <label>Item Name</label>
                                                <select  class="form-control" id="add_ti_item_name" name="add_ti_item_name[]" required> 
                                                    <option value="" selected> </option>
                                                    @foreach($a_items as $a_item)
                                                        <option value='{{$a_item -> inventory_id}}'> 
                                                            {{$a_item -> supplier_name}}: {{$a_item -> inventory_name}}, &#8369;{{$a_item -> inventory_price + ($a_item -> inventory_price * 0.25)}}, In-Stock : {{$a_item -> inventory_qty}}
                                                        </option>
                                                    @endforeach
                                                </select> 
                                                @if ($errors->addItem->has('add_ti_item_name'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{ $errors->addItem->first('add_ti_item_name') }}
                                                        </strong>
                                                    </span>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="{{$errors->addItem->has('add_ti_qty') ? ' has-error' : ''}}">
                                            <div class="col-md-2">              
                                                <label>Quantity</label>
                                                <input type="number" class="form-control" name="add_ti_qty[]" min="1" id="add_ti_qty" required>
                                                @if ($errors->addItem->has('add_ti_qty'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{ $errors->addItem->first('add_ti_qty') }}
                                                        </strong>
                                                    </span>
                                                @endif
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div id="item-form">    
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-info btn-fill pull-left" id="add-form">
                            Add Item Form
                        </button>

                        <button type="button" class="btn btn-bg btn-default" data-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit" class="btn btn-bg btn-success btn-fill">
                            Add Item/s
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div> 

    <!--EDIT ITEM-->    
    <div class="modal fade" role="dialog" id="editItem">
        <div class="modal-dialog  modal-md">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <center> <h4 class="modal-title">Edit Item</h4> </center>
                </div>
                                    
                <form method="POST" class="form-horizontal" id="editItem_form" action="/term_items/1">      
                    {{csrf_field()}}
                    {{method_field('PUT')}}
                    <input type="hidden" name="term_id" id="term_id" value="{{$term[0]->term_id}}">

                    <div class="modal-body">
                        <div id="view-edit-content" class="row">
                            <div class="col-md-12">
                                <div class="row form-group">
                                    <div class="{{ $errors->editItem->has('edit_ti_item_name') ? ' has-error' : '' }}">
                                        <div class="col-md-8">   
                                            <label>Item Name</label>
                                            <select  class="form-control" id="edit_ti_item_name" name="edit_ti_item_name" required value="{{ old('edit_ti_item_name') }}"> 
                                                <option value="" selected> </option>
                                                @foreach($term_items as $term_item)
                                                    <option value='{{$term_item -> ti_id}}'> 
                                                        {{$term_item -> supplier_name}}: {{$term_item -> inventory_name}} &#8369; {{$a_item -> inventory_price + ($term_item -> inventory_price * 0.25)}}
                                                    </option>
                                                @endforeach
                                            </select> 
                                            @if ($errors->editItem->has('edit_ti_item_name'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{$errors->addItem->first('edit_ti_item_name')}}
                                                    </strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="{{ $errors->editItem->has('edit_item_rhandler') ? ' has-error' : '' }}"> 
                                        <div class="col-md-6">   
                                            <!--Acquires the list of workers within users table-->
                                            <label class="sel1">Handler:</label>
                                            <select class="form-control" name="edit_item_handler" required id="edit_item_rhandler">
                                                <option value="" data-hidden="true" selected="selected" >
                                                </option>
                                                @foreach($peddlers as $peddler)
                                                    <option value="{{$peddler->user_id}}">
                                                        {{$peddler->fname}}&nbsp
                                                        {{$peddler->mname}}.
                                                        {{$peddler->lname}}
                                                    </option>
                                                @endforeach
                                            </select>           
                                            @if ($errors->editItem->has('edit_item_rhandler'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->editItem->first('edit_item_rhandler') }}</strong>
                                                </span>
                                            @endif                   
                                        </div>
                                    </div>

                                    <div class="{{ $errors->editItem->has('edit_item_date') ? ' has-error' : '' }}">
                                        <div class="col-md-6">
                                            <label>Date</label>
                                            <input type="datetime-local" id="edit_item_date" class="form-control"  name="edit_item_date" required value="{{App\Inventory::currdate()}}"> 
                                                                                
                                            @if ($errors->editItem->has('edit_item_date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->editItem->first('edit_item_date') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div> 
                                </div><br><br><br>

                                 <div class="row form-group">
                                    <div class="{{ $errors->editItem->has('edit_item_original') ? ' has-error' : '' }}">
                                        <div class="col-md-4">
                                            <label>Original Qty</label>
                                            <input  class="form-control" type="number" id="edit_item_original" name="edit_item_original" required value="{{ old('edit_item_original') }}">
                                            @if ($errors->editItem->has('edit_item_original'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{$errors->editItem->first('edit_item_original')}}
                                                    </strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="{{ $errors->editItem->has('edit_item_returns') ? ' has-error' : '' }}">
                                        <div class="col-md-4">
                                            <label>Returned Qty</label>
                                            <input  class="form-control" type="number" id="edit_item_returns" name="edit_item_returns" required value="{{ old('edit_item_returns') }}">
                                            @if ($errors->editItem->has('edit_item_returns'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{$errors->editItem->first('edit_item_returns')}}
                                                    </strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>                            
                                </div>

                                <div class="row form-group">
                                    <div class="{{ $errors->editItem->has('edit_item_udamages') ? ' has-error' : '' }}">
                                        <div class="col-md-4">  
                                            <label class="sel1">Unrepairable Qty</label>
                                            <input class="form-control" type="number" id="edit_item_damages" name="edit_item_udamages" value="{{ old('edit_item_udamages') }}">
                                            @if ($errors->editItem->has('edit_item_udamages'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{$errors->editItem->first('edit_item_udamages')}}
                                                    </strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="{{ $errors->editItem->has('edit_item_rdamages') ? ' has-error' : '' }}">
                                        <div class="col-md-4">  
                                            <label class="sel1">Repairable Qty</label>
                                            <input class="form-control" type="number" id="edit_item_rdamages" name="edit_item_rdamages" value="{{ old('edit_item_rdamages') }}">
                                            @if ($errors->editItem->has('edit_item_rdamages'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{$errors->editItem->first('edit_item_rdamages')}}
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
                        <button type="button" class="btn btn-bg btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" id="editItem_btn" class="btn btn-bg btn-success btn-fill">Edit</button>  
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--ADD EXPENSE-->   
    <div class="modal fade" role="dialog" id="addExpense">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Expense</h4>
                </div>
                                 
                <form method="POST" class="form-horizontal" id="addExpense_form" action="/expenses">   
                    {{csrf_field()}} 

                    <!-- TERM_ID -->
                    <input type="hidden" name="term_id" id="term_id" value="{{$term[0]->term_id}}">

                    <div class="modal-body">
                        <div id="view-add-content" class="row">                                 
                            <div class="row form-group col-md-12">
                                <div class="{{$errors->addExpense->has('add_exp_name') ? ' has-error' : ''}}"> 
                                    <div class="col-md-8">  
                                        <label>Expense Name</label>
                                        <input class="form-control" type="text" id="add_exp_name" name="add_exp_name" required> 
                                        @if ($errors->addExpense->has('add_exp_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->addExpense->first('add_exp_name') }}</strong>
                                            </span>
                                        @endif   
                                    </div>
                                </div>

                                <div class="{{$errors->addExpense->has('add_exp_amt') ? ' has-error' : ''}}"> 
                                    <div class="col-md-4">  
                                        <label>Expense Amount</label>
                                        <input type="number"  name="add_exp_amt" id="add_exp_amt" class="form-control" min="1" required>
                                        @if ($errors->addExpense->has('add_exp_amt'))
                                            <span class="help-block">
                                                <strong>{{ $errors->addExpense->first('add_exp_amt') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                          <button type="button" class="btn btn-bg btn-default" data-dismiss="modal">    Cancel
                          </button>
                          <button type="submit" class="btn btn-bg btn-success btn-fill">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--EDIT EXPENSE--> 
    <div class="modal fade" role="dialog" id="editExpense">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Expense</h4>
                </div>
                                 
                <form method="POST" class="form-horizontal" id="editExpense_form">   

                    {{csrf_field()}}
                    {{method_field('PUT')}}  

                    <!-- TERM_ID -->
                    <input type="hidden" name="term_id" id="term_id" value="{{$term[0]->term_id}}">

                    <div class="modal-body">
                        <div id="view-edit-content" class="row">                                 
                            <div class="row form-group col-md-12">
                                <div class="{{$errors->editExpense->has('edit_exp_name') ? ' has-error' : ''}}"> 
                                    <div class="col-md-8">  
                                        <label>Expense Name</label>
                                        <input class="form-control" type="text" id="edit_exp_name" name="edit_exp_name" required> 
                                        @if ($errors->editExpense->has('edit_exp_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->editExpense->first('edit_exp_name') }}</strong>
                                            </span>
                                        @endif   
                                    </div>
                                </div>
                            
                                <div class="{{$errors->editExpense->has('edit_exp_amt') ? ' has-error' : ''}}"> 
                                    <div class="col-md-4">  
                                        <label>Expense Amount</label>
                                        <input type="number" required name="edit_exp_amt" id="edit_exp_amt" min="1" class="form-control" required>
                                        @if ($errors->editExpense->has('edit_exp_amt'))
                                            <span class="help-block">
                                                <strong>{{ $errors->editExpense->first('edit_exp_amt') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                          <button type="button" class="btn btn-bg btn-default" data-dismiss="modal"> Cancel
                          </button>
                          <button type="submit" class="btn btn-bg btn-success btn-fill">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--REMOVE EXPENSE-->
    <div class="modal fade" role="dialog" id="removeExpense">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Remove Expense</h4>
                </div>
                              
                <form method="POST" class="form-horizontal" id="removeExpense_form">

                    {{csrf_field()}}
                    {{method_field('DELETE')}}

                    <div class="modal-body">
                        <div id="view-edit-content" class="row">
                            <div class="col-md-12">                                     
                                <div class="row form-group">                       
                                    <div class=""> 
                                        <div class="col-md-12">   
                                            You are about to remove an expense from this term. Do you want to proceed?
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-bg btn-default" data-dismiss="modal">No
                        </button>

                        <button type="submit" class="btn btn-bg btn-success btn-fill">Yes
                        </button>         
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--ADD COLLECTION-->
    <div class="modal fade" role="dialog" id="addCollection">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">
                        <center>
                            Add Collection
                        </center>
                    </h4>
                </div>
                
                <form method="POST" class="form-horizontal" id="addCollection_form" action="/sales">
                 {{csrf_field()}}

                    <input type="hidden" name="term_id" id="term_id" value="{{$term[0]->term_id}}">

                    <div class="modal-body">
                        <div id="view-edit-content" class="row">
                            <div class="col-md-12"> 
                                <div class="row form-group">
                                    <div class="{{$errors->addCollection->has('add_amt_collected') ? ' has-error' : ''}}"> 
                                        <div class="col-md-6">  
                                            <label>Amount Collected</label>
                                            <input type="number"  name="add_amt_collected" id="add_amt_collected" class="form-control" value="{{ old('add_amt_collected')}}" required min="1">
                                            @if ($errors->addCollection->has('add_amt_collected'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->addCollection->first('add_amt_collected') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label> Date Collected </label>
                                        <input type="date" class="form-control" name="add_date_collected" max="{{Carbon\Carbon::now()->toDateString()}}" required value="{{Carbon\Carbon::now()->toDateString()}}">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="{{$errors->addCollection->has('add_note_collected') ? ' has-error' : ''}}"> 
                                        <div class="col-md-12"> 
                                            <label>Note</label>
                                            <textarea id="addr" class="form-control" required name="add_note_collected" rows='2' cols="30" value="{{ old('add_note_collected')}}"> </textarea>
                                            @if ($errors->addCollection->has('add_note_collected'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{ $errors->addCollection->first('add_note_collected') }}
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
                        <button type="button" class="btn btn-bg btn-default" data-dismiss="modal">Cancel
                        </button>

                        <button type="submit" class="btn btn-bg btn-success btn-fill">Add Collection
                        </button> 
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--EDIT COLLECTION-->
    <div class="modal fade" role="dialog" id="editCollection">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">
                        <center>
                            Edit Collection
                        </center>
                    </h4>
                </div>
                
                <form method="POST" class="form-horizontal" id="editCollection_form">
                 {{csrf_field()}}
                 {{method_field('PUT')}}

                    <input type="hidden" name="term_id" id="term_id" value="{{$term[0]->term_id}}">

                    <div class="modal-body">
                        <div id="view-edit-content" class="row">
                            <div class="col-md-12"> 
                                <div class="row form-group">
                                    <div class="{{$errors->editCollection->has('edit_amt_collected') ? ' has-error' : ''}}"> 
                                        <div class="col-md-6">  
                                            <label>Amount Collected</label>
                                            <input type="number"  name="edit_amt_collected" id="edit_amt_collected" class="form-control" value="{{ old('edit_amt_collected')}}" min="1" required>
                                            @if ($errors->editCollection->has('edit_amt_collected'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->editCollection->first('edit_amt_collected') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label> Date Collected </label>
                                        <input type="date" class="form-control" name="edit_date_collected" max="{{Carbon\Carbon::now()->toDateString()}}" required value="{{Carbon\Carbon::now()->toDateString()}}">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="{{$errors->editCollection->has('edit_note_collected') ? ' has-error' : ''}}"> 
                                        <div class="col-md-12"> 
                                            <label>Note</label>
                                            <textarea class="form-control"  id="edit_note_collected" name="edit_note_collected" rows='2' cols="30" value="{{ old('edit_note_collected')}}"> </textarea>
                                            @if ($errors->editCollection->has('edit_note_collected'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{ $errors->editCollection->first('edit_note_collected') }}
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
                        <button type="button" class="btn btn-bg btn-default" data-dismiss="modal">Cancel
                        </button>

                        <button type="submit" class="btn btn-bg btn-success btn-fill">Edit Collection
                        </button> 
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- REMOVE COLLECTION  -->
    <div class="modal fade" role="dialog" id="removeCollection">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Remove Collection</h4>
                </div>
                              
                <form method="POST" class="form-horizontal" id="removeCollection_form">

                    {{csrf_field()}}
                    {{method_field('DELETE')}}

                    <div class="modal-body">
                        <div id="view-edit-content" class="row">
                            <div class="col-md-12">                                     
                                <div class="row form-group">                       
                                    <div class=""> 
                                        <div class="col-md-12">   
                                            You are about to remove a collection from this term. Do you want to proceed?
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-bg btn-default" data-dismiss="modal">No
                        </button>

                        <button type="submit" class="btn btn-bg btn-success btn-fill">Yes
                        </button>         
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--CUSTOMER VIEW/EDIT MODAL-->  
    <div class="modal fade" role="dialog" id="editCustomer">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <center> 
                        <h4 class="modal-title">
                            Customer Details
                        </h4> 
                    </center>
                </div>    

                <form method="POST" class="form-horizontal" id="editCustomer_form"> 
                    {{csrf_field()}} 
                    {{method_field('PUT')}}

                    <input type="hidden" name="term_id" id="term_id" value="{{$term[0]->term_id}}">      
                    <div class="modal-body">
                        <div id="view-edit-content" class="row">
                            <div class="col-md-12"> 
                                <div class="row form-group">                   
                                    <div class="{{$errors->editCustomer->has('fname') ? ' has-error' : ''}}"> 
                                        <div class="col-md-4">    
                                            <label>First Name</label>
                                            <input type="text" id="edit_fname" class="form-control"  name="edit_fname" required  > 
                                            @if ($errors->editCustomer->has('edit_fname'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{ $errors->editCustomer->first('edit_fname') }}
                                                    </strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="{{$errors->editCustomer->has('edit_mname') ? ' has-error' : ''}}"> 
                                        <div class="col-md-4"> 
                                            <label>M.I.</label>
                                            <input type="text" id="edit_mname" class="form-control" required name="edit_mname" >
                                            @if ($errors->editCustomer->has('edit_mname'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{ $errors->editCustomer->first('edit_mname') }}
                                                    </strong>
                                                </span>
                                            @endif                   
                                        </div>      
                                    </div>

                                    <div class="{{$errors->editCustomer->has('edit_lname') ? ' has-error' : ''}}">
                                        <div class="col-md-4">              
                                            <label>Last Name</label>
                                             <input type="text" id="edit_lname" class="form-control" required name="edit_lname" > 
                                             @if ($errors->editCustomer->has('edit_lname'))
                                                 <span class="help-block">
                                                    <strong>
                                                        {{ $errors->editCustomer->first('edit_lname') }}</strong>
                                                 </span>
                                            @endif
                                        </div>
                                    </div> 
                                </div> 
                                    
                                <div class="row form-group">
                                    <div class="{{ $errors->editCustomer->has('edit_cnum') ? ' has-error' : '' }}">
                                        <div class="col-md-8">  
                                            <label>Contact Number</label>
                                            <input type="number" required name="edit_cnum" id="edit_cnum" class="form-control" >
                                                                                
                                            @if ($errors->editCustomer->has('edit_cnum'))
                                                <span class="help-block">
                                                    <strong>{{$errors->editCustomer->first('edit_cnum')}}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="{{ $errors->editCustomer->has('edit_gender') ? ' has-error' : '' }}">
                                            <div class="col-md-4">
                                                <label for="sel1">Gender</label>
                                                <select class="form-control" name="edit_gender" required id="edit_gender">
                                                    <option value="" data-hidden="true"  
                                                        selected="selected">
                                                    </option>

                                                    <option value="0">
                                                        Male
                                                    </option>
                                                    
                                                    <option value="1">
                                                        Female
                                                    </option>
                                                </select>         
                                                @if ($errors->editCustomer->has('edit_gender'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->editCustomer->first('edit_gender') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                </div>

                                <div class="row form-group">
                                    <div class="{{$errors->editCustomer->has('edit_addr') ? ' has-error' : ''}}"> 
                                        <div class="col-md-12"> 
                                            <label>Address</label>
                                            <textarea id="edit_addr" class="form-control" required name="edit_addr" rows='2' cols="30"> </textarea>
                                            @if ($errors->editCustomer->has('edit_addr'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{ $errors->editCustomer->first('edit_addr') }}
                                                    </strong>
                                                </span>
                                            @endif                   
                                        </div>      
                                    </div> 
                                </div>

                                <hr>

                                <center> <h5> Purchased Items </h5> </center>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label> Item Name </label>
                                        </div>
                                        <div class="col-md-2">
                                            <label> Item Qty </label>
                                        </div>
                                    </div>
                                    <div id="purchased-items"></div>   
                            </div>              
                        </div>                        
                    </div>

                    <div class="modal-footer">
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

    <!--CUSTOMER ADD MODAL-->        
    <div class="modal fade" role="dialog" id="addCustomer">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <center> 
                        <h4 class="modal-title">
                            Add Customer
                        </h4> 
                    </center>
                </div>    

                <form method="POST" class="form-horizontal" id="addCustomer_form" action="/customers">
                    {{csrf_field()}}   
                    <input type="hidden" name="term_id" id="term_id" value="{{$term[0]->term_id}}">

                    <div class="modal-body">
                        <div id="view-edit-content" class="row">
                            <div class="col-md-12"> 
                                <div class="row form-group">                   
                                    <div class="{{$errors->addCustomer->has('fname') ? ' has-error' : ''}}"> 
                                        <div class="col-md-4">    
                                            <label>First Name</label>
                                            <input type="text" id="fname" class="form-control"  name="fname" required  value="{{ old('fname') }}"> 
                                            @if ($errors->addCustomer->has('fname'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{ $errors->addCustomer->first('fname') }}
                                                    </strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="{{$errors->addCustomer->has('mname') ? ' has-error' : ''}}"> 
                                        <div class="col-md-4"> 
                                            <label>M.I.</label>
                                            <input type="text" id="mname" class="form-control" required name="mname" value="{{ old('mname') }}">
                                            @if ($errors->addCustomer->has('mname'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{ $errors->addCustomer->first('mname') }}
                                                    </strong>
                                                </span>
                                            @endif                   
                                        </div>      
                                    </div>

                                    <div class="{{$errors->addCustomer->has('lname') ? ' has-error' : ''}}">
                                        <div class="col-md-4">              
                                            <label>Last Name</label>
                                             <input type="text" id="lname" class="form-control" required name="lname" value="{{ old('lname') }}"> 
                                             @if ($errors->addCustomer->has('lname'))
                                                 <span class="help-block">
                                                    <strong>
                                                        {{ $errors->addCustomer->first('lname') }}</strong>
                                                 </span>
                                            @endif
                                        </div>
                                    </div> 
                                </div> 
                                    
                                <div class="row form-group">
                                    <div class="{{ $errors->addCustomer->has('supplier_cnum') ? ' has-error' : '' }}">
                                        <div class="col-md-8">  
                                            <label>Contact Number</label>
                                            <input type="number" required name="cnum" id="cnum" class="form-control" value="{{ old('cnum') }}">
                                                                                
                                            @if ($errors->addCustomer->has('cnum'))
                                                <span class="help-block">
                                                    <strong>{{$errors->addCustomer->first('cnum')}}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="{{ $errors->addCustomer->has('gender') ? ' has-error' : '' }}">
                                            <div class="col-md-4">
                                                <label for="sel1">Gender</label>
                                                <select class="form-control" name="gender" required id="gender">
                                                    <option value="" data-hidden="true"  
                                                        selected="selected">
                                                    </option>

                                                    <option value="0" 
                                                        @if (old('gender') == 0) 
                                                            selected="selected"  @endif>
                                                        Male
                                                    </option>
                                                    
                                                    <option value="1" 
                                                        @if (old('gender') == 1) 
                                                            selected="selected" @endif>
                                                        Female
                                                    </option>
                                                </select>         
                                                @if ($errors->addCustomer->has('gender'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->addCustomer->first('gender') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                </div>

                                <div class="row form-group">
                                    <div class="{{$errors->addCustomer->has('addr') ? ' has-error' : ''}}"> 
                                        <div class="col-md-12"> 
                                            <label>Address</label>
                                            <textarea id="addr" class="form-control" required name="addr" rows='2' cols="30" value="{{ old('addr')}}"> </textarea>
                                            @if ($errors->addCustomer->has('addr'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{ $errors->addCustomer->first('addr') }}
                                                    </strong>
                                                </span>
                                            @endif                   
                                        </div>      
                                    </div> 
                                </div>

                                <hr>

                                <center> <h5> Purchased Items </h5> </center>
                                <div id="item-form-collector"> 
                                    <div class="row form-group">   
                                        <div class="{{$errors->addCustomer->has('item_name') ? ' has-error' : ''}}"> 
                                            <div class="col-md-8">              
                                                <label>Item Name</label>
                                                <select  class="form-control" id="item_name" name="item_name[]" required> 
                                                    <option value="" selected> </option>
                                                    @foreach($term_items as $term_item)
                                                        <option value='{{$term_item->ti_id}}'> 
                                                            {{$term_item -> supplier_name}}: {{$term_item -> inventory_name}} &#8369; {{$term_item -> inventory_price + ($term_item -> inventory_price * 0.25)}}
                                                        </option>
                                                    @endforeach
                                                </select> 
                                                @if ($errors->addCustomer->has('item_name'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{ $errors->addCustomer->first('item_name') }}
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="{{$errors->addCustomer->has('item_qty') ? ' has-error' : ''}}">
                                            <div class="col-md-2">              
                                                <label>Quantity</label>
                                                <input type="number" class="form-control" name="item_qty[]" min="1" id="item_qty" required>
                                                @if ($errors->addCustomer->has('item_qty'))
                                                    <span class="help-block">
                                                        <strong>
                                                            {{ $errors->addCustomer->first('item_qty') }}
                                                        </strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>   
                                </div>
                            </div>              
                        </div>                        
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-info btn-fill pull-left" id="add-form-customer">
                            Add Item Form
                        </button>

                        <button type="submit" class="btn btn-success btn-fill pull-right" id="form-button-add">
                            Add Customer
                        </button>

                        <button  data-dismiss="modal" aria-hidden="true" class="btn btn-basic pull-right" style="margin-right: 2%">
                            Cancel
                        </button>              
                    </div>  
                </form>
            </div>
        </div>
    </div>

    <!--REMOVE CUSTOMERS-->
    <div class="modal fade" role="dialog" id="removeCustomer">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Remove Customer</h4>
                </div>
                              
                <form method="POST" class="form-horizontal" id="removeCustomer_form">

                    {{csrf_field()}}
                    {{method_field('DELETE')}}

                    <div class="modal-body">
                        <div id="view-edit-content" class="row">
                            <div class="col-md-12">                                     
                                <div class="row form-group">                       
                                    <div class=""> 
                                        <div class="col-md-12">   
                                            You are about to remove a customer from this term. Do you want to proceed?
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-bg btn-default" data-dismiss="modal">No
                            </button>

                            <button type="submit" class="btn btn-bg btn-success btn-fill">Yes
                            </button>         
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--CONFIRM PAYMENT CUSTOMERS-->
    <div class="modal fade" role="dialog" id="payCustomer">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Confirm Customer Payment</h4>
                </div>
                              
                <form method="POST" class="form-horizontal" id="payCustomer_form">

                    {{csrf_field()}}
                    {{method_field('PUT')}}

                    <input type="hidden" name="term_id" id="term_id" value="{{$term[0]->term_id}}">
                    <input type="hidden" name="update_type" value="confirm_payment">

                    <div class="modal-body">
                        <div id="view-edit-content" class="row">
                            <div class="col-md-12">                                     
                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <label> Date Paid </label>
                                        <input type="date" class="form-control" max="{{Carbon\Carbon::now()->toDateString()}}" name="collect_date" required value="{{Carbon\Carbon::now()->toDateString()}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-bg btn-default" data-dismiss="modal">Cancel
                        </button>

                        <button type="submit" class="btn btn-bg btn-success btn-fill">Confirm
                        </button>         
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--PRINTING ITEMS MODAL-->    
    <div class="modal fade" role="dialog" id="printItems" >
        <div class="modal-dialog">
          <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <center>
                        <h4 class="modal-title"> List of Term Items</h4>
                    </center>
                </div>

                <form method="POST" action="/printItems/{{$term[0]->term_id}}">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div id="view-edit-content" class="row">
                            <div class="col-md-12">                                     
                                <div class="row form-group">                       
                                    <div class=""> 
                                        <div class="col-md-12">   
                                            You are about to generate a pdf of all the items of this term. Do you want to proceed?
                                        </div>
                                    </div>
                                </div> 
                            </div> 
                        </div>                       
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-bg btn-default" data-dismiss="modal">Cancel
                        </button>

                        <button type="submit" class="btn btn-bg btn-success btn-fill">
                        Generate PDF
                        </button> 
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--PRINTING SALES MODAL-->    
    <div class="modal fade" role="dialog" id="printSales" >
        <div class="modal-dialog">
          <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <center>
                        <h4 class="modal-title"> Sales Report</h4>
                    </center>
                </div>

                <form method="POST" action="/printSales/{{$term[0]->term_id}}">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div id="view-edit-content" class="row">
                            <div class="col-md-12">                                     
                                <div class="row form-group">                       
                                    <div class=""> 
                                        <div class="col-md-12">   
                                            You are about to generate a pdf of all the sales of this term. Do you want to proceed?
                                        </div>
                                    </div>
                                </div> 
                            </div> 
                        </div>                       
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-bg btn-default" data-dismiss="modal">Cancel
                        </button>

                        <button type="submit" class="btn btn-bg btn-success btn-fill">
                        Generate PDF
                        </button> 
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- SUCCESS MESSAGES -->
    
        <!-- DETAILS -->
            @if(session('update-term-success'))
                <script> 
                    jQuery(document).ready(function($){
                        $.notify( "{{session()-> get('update-term-success' )}}", "success");
                        {{session()->forget('update-term-success')}}
                    });
                </script>
            @endif
        <!-- END OF DETAILS -->

        <!-- PEDDLERS -->
            @if(session('store-peddler-success'))
                <script> 
                    jQuery(document).ready(function($){
                        $.notify( "{{session()-> get('store-peddler-success' )}}", "success");
                        {{session()->forget('store-peddler-success')}}
                    });
                </script>
            @endif
            @if(session('update-peddler-success'))
                <script> 
                    jQuery(document).ready(function($){
                        $.notify( "{{session()-> get('update-peddler-success' )}}", "success");
                        {{session()->forget('update-peddler-success')}}
                    });
                </script>
            @endif
            @if(session('destroy-peddler-success'))
                <script> 
                    jQuery(document).ready(function($){
                        $.notify( "{{session()-> get('destroy-peddler-success' )}}", "success");
                        {{session()->forget('destroy-peddler-succses')}}
                    });
                </script>
            @endif
        <!-- END OF PEDDLERS -->

        <!-- ITEMS -->
            @if(session('store-item-success'))
                <script> 
                    jQuery(document).ready(function($){
                        $.notify( "{{session()-> get('store-item-success' )}}", "success");
                        {{session()->forget('store-item-success')}}
                    });
                </script>
            @endif
            @if(session('update-item-success'))
                <script> 
                    jQuery(document).ready(function($){
                        $.notify( "{{session()-> get('update-item-success' )}}", "success");
                        {{session()->forget('update-item-success')}}
                    });
                </script>
            @endif
            @if(session('destroy-item-success'))
                <script> 
                    jQuery(document).ready(function($){
                        $.notify( "{{session()-> get('destroy-item-success' )}}", "success");
                        {{session()->forget('destroy-item-success')}}
                    });
                </script>
            @endif
        <!-- END OF ITEMS -->

        <!-- EXPENSES -->
            @if(session('store-expense-success'))
                <script> 
                    jQuery(document).ready(function($){
                        $.notify( "{{session()-> get('store-expense-success' )}}", "success");
                        {{session()->forget('store-expense-success')}}
                    });
                </script>
            @endif
            @if(session('update-expense-success'))
                <script> 
                    jQuery(document).ready(function($){
                        $.notify( "{{session()-> get('update-expense-success' )}}", "success");
                        {{session()->forget('update-expense-success')}}
                    });
                </script>
            @endif
            @if(session('destroy-expense-success'))
                <script> 
                    jQuery(document).ready(function($){
                        $.notify( "{{session()-> get('destroy-expense-success' )}}", "success");
                        {{session()->forget('destroy-expense-success')}}
                    });
                </script>
            @endif
        <!-- END OF EXPENSES -->
        
        <!-- COLLECTIONS -->
            @if(session('store-collection-success'))
                <script> 
                    jQuery(document).ready(function($){
                        $.notify( "{{session()-> get('store-collection-success' )}}", "success");
                        {{session()->forget('store-collection-success')}}
                    });
                </script>
            @endif
            @if(session('update-collection-success'))
                <script> 
                    jQuery(document).ready(function($){
                        $.notify( "{{session()-> get('update-collection-success' )}}", "success");
                        {{session()->forget('update-collection-success')}}
                    });
                </script>
            @endif
            @if(session('destroy-collection-success'))
                <script> 
                    jQuery(document).ready(function($){
                        $.notify( "{{session()-> get('destroy-collection-success' )}}", "success");
                        {{session()->forget('destroy-collection-success')}}
                    });
                </script>
            @endif
        <!-- END OF COLLECIONTS -->

        <!-- CUSTOMERS -->
            @if(session('store-customer-success'))
                <script> 
                    jQuery(document).ready(function($){
                        $.notify( "{{session()-> get('store-customer-success' )}}", "success");
                        {{session()->forget('store-customer-success')}}
                    });
                </script>
            @endif
            @if(session('update-customer-success'))
                <script> 
                    jQuery(document).ready(function($){
                        $.notify( "{{session()-> get('update-customer-success' )}}", "success");
                        {{session()->forget('update-customer-success')}}
                    });
                </script>
            @endif
            @if(session('destroy-customer-success'))
                <script> 
                    jQuery(document).ready(function($){
                        $.notify( "{{session()-> get('destroy-customer-success' )}}", "success");
                        {{session()->forget('destroy-customer-success')}}
                    });
                </script>
            @endif
        <!-- END OF CUSTOMERS -->
    <!-- END OF SUCCESS MESSAGES -->
</body>

    <!--   Core JS Files   -->
    <script src="/js/notify.js" type="text/javascript"></script>
    <script src="/js/bootstrap.min.js" type="text/javascript"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

    <!-- MAINTAIN ACTIVE TAB -->
        <script>
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
    <!-- END OF MAINITAIN ACTIVE TAB -->

    <!-- VALIDATION ERRORS -->
        <script>
            document.addEventListener("DOMContentLoaded", function(event) {
                if ({!!count($errors->addExpense)!!} > 0)
                    $("#addExpense").modal();    
                
                if({!!count($errors->editExpense)!!} > 0){
                    $("#expense-view-edit-{{ session()-> get( 'error_id' ) }}").on('click', function (e) {
                 
                        e.preventDefault();
                        $("#edit_exp_name").val("{{old('edit_exp_name')}}");
                        $('#edit_exp_amt').val("{{old('edit_exp_amt')}}");

                        var id = $(this).data('id');
                       $("#editExpense_form").attr("action", "/expenses/" +id);
                    }); 
                    $("#expense-view-edit-{{ session()-> get( 'error_id' ) }}").click();
                }

                if ({!!count($errors->addPeddler)!!} > 0)
                    $("#addPeddler").modal(); 

                if({!!count($errors->editPeddler)!!} > 0)
                    $("#ep-{{ session()-> get( 'error_id' ) }}").click();


                if ({!!count($errors->addItem)!!} > 0)
                    $("#addItem").modal(); 

                if ({!!count($errors->editItem)!!} > 0)
                    // $("#editItem").modal(); 

                if ({!!count($errors->addCustomer)!!} > 0)
                    $("#addCustomer").modal(); 

                if ({!!count($errors->editCustomer)!!} > 0)
                    $("#viewCustomer-{{ session()-> get( 'error_id' ) }}").click(); 

                if ({!!count($errors->editTerm)!!} > 0){
                    $("#editTermDetails_btn").on('click', function (e) {
                 
                        e.preventDefault();
                        $("#et_collector option[value={{old('et_collector')}}]").attr('selected', true);

                        $("#et_location").val("{{old('et_location')}}");
                        $('#et_startdate').val("{{old('et_startdate')}}");

                        @if(old('et_enddate') == null)
                            $("#et_enddate").prop('disabled', true);
                        @endif
                        @if (old('et_finishdate') == null)
                            $("#et_finishdate").prop('disabled', true);
                        @endif

                        $('#et_enddate').val("{{old('et_enddate')}}");
                        $('#et_finishdate').val("{{old('et_finishdate')}}");

                        var id = $(this).data('id');
                        $("#editTermDetails_form").attr("action", "/termsprofile/" +id);
                    });      
                    $("#editTermDetails_btn").click();
                }
            });
        </script>
    <!-- END OF VALIDATION ERRORS  -->

    <!-- TERM DETAILS -->
        <script>
            //EDIT PEDDLER FROM TERM
            $(document).on("click", "#editTermDetails_btn", function () {
                var id = $(this).data('id');

                 $.ajax({
                    url: "/getTermDetails/" + id,
                    type: 'GET',             
                    data: { 'id' : id },
                    success: function(response){
                        // DEBUGGING
                        console.log(response[0]);

                        $("#et_collector option[value='"+response[0].worker_user_id+"']").attr('selected', true);

                        $("#et_location").val(response[0].location);
                        $('#et_startdate').val(response[0].start_date);

                        if (response[0].end_date == null)
                            $("#et_enddate").prop('disabled', true);
                        if (response[0].finish_date == null)
                            $("#et_finishdate").prop('disabled', true);

                        $('#et_enddate').val(response[0].end_date);
                        $('#et_finishdate').val(response[0].finish_date);
                    },
                    error: function(data){
                        console.log(data);
                    }
                }); 

                //FORM
                $("#editTermDetails_form").attr("action", "/termsprofile/" +id);
            });
        </script>
    <!-- END OF TERM DETAILS -->
    
    <!-- TERM PEDDLERS -->
        <script>
            //DELETE PEDDLER FROM TERM
            $(document).on("click", ".rp_btn", function () {
                var id = $(this).data('id');

                //FORM
                $("#removePeddler_form").attr("action", "/workers/" +id);

            }); 

            //EDIT PEDDLER FROM TERM
            $(document).on("click", ".ep_btn", function () {
                var id = $(this).data('id');

                 $.ajax({
                    url: "/getWorker/" + id,
                    type: 'GET',             
                    data: { 'id' : id },
                    success: function(response){
                        // DEBUGGING
                        console.log(response[0]);

                        // SET FORM INPUTS
                        $("#edit_peddler").val(response[0].worker_user_id);
                        $("#peddler_name").val(response[0].fname + " " +response[0].mname +". " +response[0].lname);
                        $("#edit_position option[value=" + response[0].worker_type +"]").prop('selected', 'selected').change();

                        $("#peddler_name").prop('disabled', true);
                    },
                    error: function(data){
                        console.log(data);
                    }
                }); 

                //FORM
                $("#editPeddler_form").attr("action", "/workers/" +id);
            }); 
        </script>
    <!-- END OF TERM PEDDLERS -->
    
    <!-- TERM EXPENSES-->
    <script>
        //DELETE EXPENSE FROM TERM
        $(document).on("click", ".re_btn", function () {
            var id = $(this).data('id');

            //FORM
            $("#removeExpense_form").attr("action", "/expenses/" +id);
        }); 

        //EDIT EXPENSE FROM TERM
        $(document).on("click", ".ee_btn", function () {
            var id = $(this).data('id');

             $.ajax({
                url: "/getExpense/" + id,
                type: 'GET',             
                data: { 'id' : id },
                success: function(response){
                    // DEBUGGING
                    console.log(response);

                    // SET FORM INPUTS
                    $('#edit_exp_name').val(response.expense_name);
                    $('#edit_exp_amt').val(response.expense_amt); 
                },
                error: function(data){
                    console.log(data);
                }
            }); 

            //FORM
            $("#editExpense_form").attr("action", "/expenses/" +id);
        }); 
    </script>
    <!-- END OF TERM EXPENSES -->
   
    <!-- TERM ITEMS-->
        <script>
            $(document).ready(function(){ 
               
                var i = 1;
                // CREATE ADDITIONAL ITEM FORM
                $('#add-form').click(function() {
                    var options = $("#add_ti_item_name > option").clone();
                    i++;
                    $('#item-form').append(                                      
                        "<div class='row form-group' id='ti-form-row-" +i +"'>"+   
                            "<div class='col-md-8'>" +             
                                "<select  class='form-control' id='ti-row-" +i +"' name='add_ti_item_name[]' required>" + 
                                "</select>"+  
                            "</div>"+

                            "<div class='col-md-2'>"+              
                                "<input type='number' min='1' class='form-control' name='add_ti_qty[]' id='add_ti_qty' required>"+
                            "</div>"+

                            "<div class='col-md-2'>"+ 
                                "<button id='"+i +"' type='button' class='btn_remove btn btn-danger btn-fill'> - </button>"+
                            "</div>"+
                        "</div>"    
                    );

                    $('#ti-row-'+i).append(options);
                });


                // REMOVE ITEM FORM
                $(document).on('click', '.btn_remove', function(){  
                   var button_id = $(this).attr("id");  
                   var removed = $("#ti-form-row-"+button_id).remove();
                });

                // EDIT ITEM
                $('#edit_ti_item_name').on('change', function() {
                    $id = $('#edit_ti_item_name').val();
                    
                    $.ajax({
                        url: "/getTermItem/" + $id,
                        type: 'GET',             
                        data: { 'id' : $id },
                        success: function(response){
                            // DEBUGGING
                            console.log(response);

                            // SET FORM INPUTS
                            $("#edit_item_original").val(response.ti_original);
                            $("#edit_item_returns").val(response.ti_returned);
                            // if (response.ti_damaged > 0 )
                            //     $("#edit_item_udamages").val(response.);
                            //     $("#edit_item_rdamages").val(response.);
                            // else
                            //     $("#edit_item_udamages").val(0);
                            //     $("#edit_item_rdamages").val(0);


                            // /
                        
                        },
                        error: function(data){
                            console.log(data);
                        }
                    }); 
                });

                //REMOVE ITEM
                $(document).on("click", ".ri_btn", function () {
                    var id = $(this).data('id');

                    //FORM
                    $("#removeItem_form").attr("action", "/term_items/" +id);
                }); 
            });
        </script>  
    <!-- END OF TERM ITEMS -->
    
    <!-- TERM CUSTOMERS -->
        <script>
            $(document).ready(function(){ 
                var options = $("#item_name > option").clone();
                
                var i = 1;
                // CREATE ADDITIONAL CUSTOMER ITEM FORM
                $('#add-form-customer').click(function() {
                    i++;
                    $('#item-form-collector').append(                                      
                        "<div class='row form-group' id='collector-form-row-" +i +"'>"+   
                            "<div class='col-md-8'>" +             
                                "<select  class='form-control item_name' id='collector-row-" +i +"' name='item_name[]' required>" + 
                                "</select>"+  
                            "</div>"+

                            "<div class='col-md-2'>"+              
                                "<input type='number' class='form-control' name='item_qty[]' id='item_qty' required>"+
                            "</div>"+

                            "<div class='col-md-2'>"+ 
                                "<button id='"+i +"' type='button' class='btn_remove_collector btn btn-danger btn-fill'> - </button>"+
                            "</div>"+
                        "</div>"    
                    );

                    $('.item_name').append(options);
                    $('#collector-row-'+i).val("");
                });

                // REMOVE CUSTOMER ITEM FORM
                $(document).on('click', '.btn_remove_collector', function(){  
                   var button_id = $(this).attr("id");  
                   var removed = $("#collector-form-row-"+button_id).remove(); 
                });

                //VIEW-EDIT CUSTOMER
                $(document).on("click", ".viewCustomer_btn", function () {
                    var id = $(this).data('id');

                    $.ajax({
                        url: "/getCustomerOrder",
                        type: 'GET',             
                        data: {
                                'id' : id ,
                                'term_id' : {{$term[0]->term_id}},
                                },
                        success: function(response){
                            // DEBUGGING
                            console.log(response);

                            $('#purchased-items').empty();

                            // SET FORM INPUTS
                            $('#edit_fname').val(response[0].customer_fname);
                            $('#edit_mname').val(response[0].customer_mname);
                            $('#edit_lname').val(response[0].customer_lname);
                            $('#edit_gender').val(response[0].customer_gender);
                            $('#edit_cnum').val(response[0].customer_cnum);
                            $('#edit_addr').val(response[0].customer_addr);

                            var i = 0;
                            for (var x = 0; x < response.length; x++){
                                i++;
                                $('#purchased-items').append(
                                    '<div class="row form-group">'+
                                        '<div class="{{$errors->editCustomer->has("edit_item_name") ? " has-error" : ""}}">'+
                                            '<div class="col-md-8">'+
                                                '<select  class="form-control" id="edit_item_name_' +x +'"'  
                                                    +'name="edit_item_name[]" required>'+
                                                    '@foreach($term_items as $term_item)'+
                                                        '<option value="{{$term_item->ti_id}}">'+ 
                                                            '{{$term_item -> supplier_name}}: {{$term_item -> inventory_name}} &#8369; {{$term_item -> inventory_price + ($term_item -> inventory_price * 0.25)}}'+
                                                        '</option>'+
                                                    '@endforeach'+
                                                '</select>'+
                                                '@if ($errors->editCustomer->has("edit_item_name"))'+
                                                    '<span class="help-block">'+
                                                        '<strong>'+
                                                            '{{ $errors->editCustomer->first("edit_item_name") }}'+
                                                        '</strong>'+
                                                    '</span>'+
                                                '@endif'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="{{$errors->editCustomer->has("edit_item_qty") ? " has-error" : ""}}">'+
                                            '<div class="col-md-2">'+
                                                '<input type="number" class="form-control" name="edit_item_qty[]" id="edit_item_qty" required min="1" value="' +response[x].order_qty +'">'+
                                                '@if ($errors->editCustomer->has("edit_item_qty"))'+
                                                    '<span class="help-block">'+
                                                        '<strong>'+
                                                            '{{ $errors->editCustomer->first("edit_item_qty") }}'+
                                                        '</strong>'+
                                                    '</span>'+
                                                '@endif'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'
                                );

                                $("#edit_item_name_" +x +" option[value='"+response[x].ti_id+"']").attr('selected', true);
                            }

                        },
                        error: function(data){
                            console.log(data);
                        }
                    });

                    //FORM
                    $("#editCustomer_form").attr("action", "/customers/" +id);
                });

                //REMOVE CUSTOMER
                $(document).on("click", ".removeCustomer_btn", function () {
                    var id = $(this).data('id');

                    //FORM
                    $("#removeCustomer_form").attr("action", "/customers/" +id);
                }); 

                //CONFIRM CUSTOMER PAYMENT
                $(document).on("click", ".payCustomer_btn", function () {
                    var id = $(this).data('id');

                    //FORM
                    $("#payCustomer_form").attr("action", "/customers/" +id);
                }); 
            });
        </script>  
    <!-- END OF TERM CUSTOMERS -->

    <!-- TERM COLLECTIONS -->
        <script>
            //VIEW-EDIT COLLECTONR
                $(document).on("click", ".viewCollection_btn", function () {
                    var id = $(this).data('id');
              
                    $.ajax({
                        url: "/getSale/" +id,
                        type: 'GET',             
                        data: {'id' : id },
                        success: function(response){
                            // DEBUGGING
                            console.log(response);
                            // SET FORM INPUTS
                            $('#edit_date_collected').val(response.sales_date);
                            $('#edit_amt_collected').val(response.sales_amt);
                            $('#edit_note_collected').val(response.sales_remarks);
                        },
                        error: function(data){
                            console.log(data);
                        }
                    });

                    //FORM
                    $("#editCollection_form").attr("action", "/sales/" +id);
                });

            //REMOVE COLLECTION
                $(document).on("click", ".removeCollection_btn", function () {
                    var id = $(this).data('id');

                    //FORM
                    $("#removeCollection_form").attr("action", "/sales/" +id);
                }); 
        </script>
    <!-- END OF TERM CUSTOMERS -->
@endsection

