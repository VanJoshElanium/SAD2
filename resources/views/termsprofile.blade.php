<!doctype html>
@extends('layouts.app')

@section('content')
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="/public/images/Prince and Princes logo/6.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Term Profile</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="/css/bootstrap.min.css" rel="stylesheet" />

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
        .bgd{
            background-image: url(../images/bg-6-full.jpg);
        }
        .box{
            border: 0px solid #888888;
            box-shadow: 5px 5px 8px 5px #888888;
        }
        .modal-title{
            text-align:center;
            color: white;
        }
        .modal-header{
            background-color:darkgray;
        }
        tbody.qtty{
            text-align: center;
        }
        tbody.qtty tr td:nth-child(1) {
            text-align: left;
        }
        tbody.qtty tr td:nth-child(2) {
            text-align: left;
        }
        tbody.qtty tr td:last-child{
            text-align: left;
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
                        Prince &#38; Princess
                    </a>
                </div>

                <ul class="nav">
                    <li>
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

                    <li class="active">
                        <a href="{{ route('terms')}}">
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
                        <a href="{{ route('usrmgmt') }}">
                            <i class="pe-7s-users"></i>
                            <p>User Management</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logs')}}">
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

            <!-- CONTENTS -->
            <div class="content">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <div class="card box">      
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#mbrNloc" aria-controls="home" role="tab" data-toggle="tab">
                                <span data-toggle="tooltip" data-placement="bottom" title="This tab contains the details of the people that are managing the term.">Members &amp; Location</span></a></li>
                            <li role="presentation"><a href="#itm_list" aria-controls="profile" role="tab" data-toggle="tab">
                                <span data-toggle="tooltip" data-placement="bottom" title="This tab contains the item details.">Items List</span></a></li>
                               <li role="presentation"><a href="#expense" aria-controls="profile" role="tab" data-toggle="tab">
                                <span data-toggle="tooltip" data-placement="bottom" title="This tab contains the expneses used for the term.">Expenses</span></a></li>  
                                 <li role="presentation"><a href="#sales" aria-controls="profile" role="tab" data-toggle="tab">
                                <span data-toggle="tooltip" data-placement="bottom" title="This tab contains the sales and share calculated in the term.">Sales</span></a></li>
                                <li role="presentation"><a href="#Clist" aria-controls="profile" role="tab" data-toggle="tab">
                                <span data-toggle="tooltip" data-placement="bottom" title="This tab contains the sales and share calculated in the term.">Customer List</span></a></li>
    </ul><br>
                            <!-- Contents-->
                            <div class="tab-content">
                                <!-- Workers and location Tab -->
                                <div role="tabpanel" class="tab-pane fade in active" id="mbrNloc">
                                      <div class="row">
                                        <div class="col-md-12">
                                        <div class="col-md-8">
                                            <div class="card">
                                            <div class="header">
                                                <div class="col-md-4"><h4 class="title">List of Peddlers</h4></div>
                                                <div class="col-md-8">
                                                    <span class="pull-right">      
                                                    <button type="button" data-target="#addPeddler" data-toggle="modal" class="btn btn-success btn-fill" id="add-btn">Add Peddler</button>  
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="content table-responsive table-full-width">
                                                <table class="table table-hover table-striped">
                                                    <thead>
                                                        <th>Name</th>
                                                        <th>Position</th>
                                                        <th>Edit</th>
                                                        <th>Remove</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Marko G. Garduvilia</td> 
                                                            <td>Team Leader</td>
                                                            <td>
                                                            <span data-toggle="tooltip" data-placement="bottom" title="Edit the position of the peddler."> 
                                                            <button type="button" data-target="#editPeddler" data-toggle="modal" class="btn btn-sm btn-warning btn-fill" id="add-btn"> 
                                                            Edit
                                                            </button></span>
                                                            </td>
                                                            <td>
                                                            <button type="button" data-target="#removePeddler" data-toggle="modal" class="btn btn-sm btn-danger btn-fill" id="add-btn"> 
                                                            Remove Peddler
                                                            </button>   
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            </div>
                                        </div>
                                    <div class="col-md-4">
                                            <div class="card">
                                                <div class="header">
                                                    <center>
                                                    <h4 class="title">Collector</h4>
                                                    <p class="category">James A. Huston</p>
                                                    <br><hr>
                                                    <h4 class="title">Term Location</h4>
                                                    <p class="category">Mati, Davao Oriental, Philippines</p>
                                                    <hr>    
                                                    </center>
                                                </div>
                                            </div>
                                        </div>     
                                        </div>  
                                      </div>
</div>
                                <!-- Items Tab -->
                                <div role="tabpanel" class="tab-pane fade" id="itm_list">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-10">
                                            <div class="card">
                                            <div class="header">
                                                <div class="col-md-4"><h4 class="title">Item List</h4></div>
                                                <div class="col-md-8">
                                                    <span class="pull-right">
                                                    <button type="button" data-target="#removeItem" data-toggle="modal" class="btn btn-danger btn-fill" id="add-btn"> 
                                                        Remove Item
                                                    </button>   
                                                    <button type="button" data-target="#addItem" data-toggle="modal" class="btn btn-success btn-fill" id="add-btn"> 
                                                        Add Item
                                                    </button>
                                                    <button type="button" data-target="#updateItem" data-toggle="modal" class="btn btn-info btn-fill" id="add-btn"> 
                                                        Update Quantity
                                                    </button>
                                                    <button type="button" data-target="#print" data-toggle="modal" class="btn btn-basic btn-fill" id="add-btn"> 
                                                        Print
                                                    </button>    
                                                    </span>    
                                                </div>
                                            </div>
                                            <div class="content table-responsive table-full-width">
                                                <table class="table table-hover table-striped">
                                                    <thead>
                                                        <th>Item Name</th>
                                                        <th><span data-toggle="tooltip" data-placement="bottom" title="Supplier's price added 25%.">
                                                            Owner's Price</span></th>
                                                        <th>Original Quantity</th>
                                                        <th>Damaged Quantity</th>
                                                        <th>Returns Quantity</th>
                                                        <th>Sold Quantity</th>
                                                    </thead>
                                                    <tbody class="qtty">
                                                        <tr>
                                                            <td>Table</td>
                                                            <td>&#8369; 250.00</td>
                                                            <td>45</td>
                                                            <td>4</td>
                                                            <td>7</td>
                                                            <td>34</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            </div>
                                        </div>
                                    <div class="col-md-2">
                                            <div class="card">
                                                <div class="header">
                                                    <center>
                                                    <p class="category">Number of items</p>    
                                                    <h4 class="title">1</h4>
                                                    <br><hr>
                                                    <p class="category">Total damaged quantity</p>    
                                                    <h4 class="title">4</h4>
                                                    <br><hr>
                                                    <p class="category">Total returned quantity</p>    
                                                    <h4 class="title">7</h4>
                                                    <br><hr>  
                                                    <p class="category">Total sold quantity</p>
                                                    <h4 class="title">34</h4>    
                                                    <hr>    
                                                    </center>
                                                </div>
                                            </div>
                                        </div>      
                                </div>
                                </div>
</div>
                                <!-- Expense Tab -->
                                <div role="tabpanel" class="tab-pane fade" id="expense">
                                      <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-8">
                                            <div class="card">
                                            <div class="header">
                                                <div class="col-md-4"><h4 class="title">Expense List</h4></div>
                                                <div class="col-md-8">
                                                    <span class="pull-right">
                                                    <button type="button" data-target="#addExpense" data-toggle="modal" class="btn btn-success btn-fill" id="add-btn">Add Expense</button>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="content table-responsive table-full-width">
                                                <table class="table table-hover table-striped">
                                                    <thead>
                                                        <th>Expense Details</th>
                                                        <th>Amount</th>
                                                        <th>Edit</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Gasoline expense</td> 
                                                            <td>&#8369; 1,000.00</td>
                                                            <td>
                                                            <button type="button" data-target="#editExpense" data-toggle="modal" class="btn btn-sm btn-warning btn-fill" id="add-btn"> 
                                                                Edit Expense
                                                            </button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            </div>
                                        </div>
                                    <div class="col-md-4">
                                            <div class="card">
                                                <div class="header"><br><br>
                                                    <center>
                                                    <h3 class="title">Total expense</h3>    
                                                    <p class="category">&#8369; 1,000.00</p>
                                                    <br><br>
                                                    <hr>    
                                                    </center>
                                                </div>
                                            </div>
                                        </div>  
                                        </div>
                                    </div>
</div>
                                <!-- Collection Tab -->
                                <div role="tabpanel" class="tab-pane fade" id="sales">
                                      <div class="row">
                                          <div class="col-md-12">
                                            <div class="col-md-8">
                                            <div class="card">
                                            <div class="header">
                                                <div class="col-md-4"><h4 class="title">Collection List</h4></div>
                                                    <span class="pull-right">
                                                    <button type="button" data-target="#addCollection" data-toggle="modal" class="btn btn-success btn-fill" id="add-btn">Add Collection</button>
                                                    </span>
                                            </div>
                                            <div class="content table-responsive table-full-width">
                                                <table class="table table-hover table-striped">
                                                    <thead>
                                                        <th>Date</th>
                                                        <th>Amount</th>
                                                        <th>Edit</th>
                                                        <th><span data-toggle="tooltip" data-placement="bottom" title="View note contains the details in where a payment isn't cash.">
                                                            View Note</span></th>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>01/01/18</td> 
                                                            <td>&#8369; 250.00</td>
                                                            <td>
                                                            <button type="button" data-target="#editCollection" data-toggle="modal" class="btn btn-sm btn-warning btn-fill" id="add-btn"> 
                                                                Edit Collection
                                                            </button>
                                                            </td>
                                                            <td>
                                                            <span data-toggle="tooltip" data-placement="bottom" title="View if there are any comments or payment changes.">
                                                                <button type="button" data-target="#viewNote" data-toggle="modal" class="btn btn-sm btn-info btn-fill" id="add-btn">View Note</button></span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            </div>
                                        </div>
                                    <div class="col-md-4">
                                            <div class="card">
                                                <div class="header"><br><br>
                                                    <h4 class="title">Total Expenses</h4>    
                                                    <p class="category">&#8369; 1,000.00</p>
                                                    <br><br>
                                                    <h4 class="title">Total Sold Items</h4>    
                                                    <p class="category">&#8369; 9,500.00</p>
                                                    <br><br> 
                                                    <h4 class="title">Total Revenue of Owner</h4>    
                                                    <p class="category">&#8369; 2,375.00</p>
                                                    <br><br>
                                                    <h4 class="title">Total Payment</h4>    
                                                    <p class="category">&#8369; 10,500.00</p>
                                                    <br><br><br>   
                                                    <div class="modal-footer">
                                                    <h4 class="title">Current Payment</h4>    
                                                    <p class="category">&#8369; 250.00</p>
                                                    <br><br>
                                                    </div>
                                                    <hr>     
                                                </div>
                                            </div>
                                        </div>
                                          </div>
                                    </div>
</div>
                                <!-- Customer info -->
                                <div role="tabpanel" class="tab-pane fade" id="Clist">
                                      <div class="row">
                                          <div class="col-md-12">
                                            <div class="card">
                                                <!-- LIst of unpaid customers-->
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="header">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <h4 class="title">List of unpaid customers</h4>
                                                                <p class="category">This list contains the unpaid customers.</p>
                                                            </div>

                                                            <div class="col-md-2 pull-right">
                                                                <button data-target="#addC" id="" data-toggle="modal" data-id='' class="edit-btn btn btn-success btn-fill pull-right">
                                                                    Add customer 
                                                                </button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="content table-responsive table-full-width">
                                                        <table class="table table-hover table-striped">
                                                            <thead>
                                                                <th>No.</th>
                                                                <th>Date</th>
                                                                <th>Contact</th>
                                                                <th>Payment Amount</th>
                                                                <th>Edit</th>
                                                                <th>View</th>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>02/12/17</td>
                                                                    <td>09XXXXXXXXX</td><!--Add an if if it still not ended indicates as "Has not ended or set yet"-->
                                                                    <td>&#8369; <span>2,000.00</span></td>
                                                                    <td>
                                                                    <button data-target="#editC" id="" data-toggle="modal" data-id='' class="edit-btn btn-sm btn btn-success btn-fill">
                                                                    Edit 
                                                                </button>
                                                                    </td>
                                                                    <td>
                                                                    <button data-target="#viewC" data-toggle="modal" data-id='' class="btn btn-sm btn-info btn-fill">
                                                                        View
                                                                    </button>
                                                                    </td>
                                                                </tr>
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
                                                                <h4 class="title">List of paid customers</h4>
                                                                <p class="category">This list contains the unpaid customers.</p>
                                                            </div>
                                                            <!--Just leaving this "div" part incase if we add some buttons and stuff-->
                                                            <div class="col-md-2 pull-right">

                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="content table-responsive table-full-width">
                                                        <table class="table table-hover table-striped">
                                                            <thead>
                                                                <th>No.</th>
                                                                <th>Date</th>
                                                                <th>Contact</th>
                                                                <th>Payment Amount</th>
                                                                <th>View</th>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>02/12/17</td>
                                                                    <td>09XXXXXXXXX</td><!--Add an if if it still not ended indicates as "Has not ended or set yet"-->
                                                                    <td>&#8369; <span>2,000.00</span></td>
                                                                    <td>
                                                                    <button data-target="#viewC" id="" data-toggle="modal" data-id='' class="edit-btn btn-sm btn btn-info btn-fill">
                                                                    View 
                                                                </button>
                                                                    </td>
                                                                </tr>
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
<!--Add Peddler-->
<div class="modal fade" role="dialog" id="addPeddler">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Peddler</h4>
                </div>
                                    
                <div class="modal-body">
                    <div id="view-edit-content" class="row">
                        <!-- Term edit form-->
                        <div class="col-md-12"> 
                            <form method="POST" class="form-horizontal" id="view-edit-profile">      
                                <!-- Collector initialization-->                                    
                                <div class="row form-group">                       
                                    <div class=""> 
                                        <div class="col-md-8">   
                                            <!--Acquires the list of workers within users table-->
                                            <label class="sel1">Peddler Name:</label>
                                              <form>
                                                  <!-- Generate list of collectors-->
                                                  <select class="form-control" id="sel1">
                                                    <option>David Mark</option>
                                                  </select>
                                              </form>
                                            
                                                <span class="help-block">
                                                    <strong>
                                                        
                                                    </strong>
                                                </span>
                                            
                                        </div>
                                    </div>
                                </div>                                                                    
                                <div class="row form-group"> <!--Identifies the position of the peddler-->                      
                                    <div class=""> 
                                        <div class="col-md-8">    
                                            <label class="sel1">Position:</label>
                                              <form>
                                                
                                                  <select class="form-control" id="sel1">
                                                    <option>Team leader</option>
                                                    <option>Subordinate</option>  
                                                  </select>
                                              </form>
                                                <span class="help-block">
                                                    <strong>
                                                        
                                                    </strong>
                                                </span>
                                        </div>
                                    </div>
                                </div> 
                            </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <center>
                          <!--ADD New Term button-->
                          <button type="button" class="btn btn-bg btn-success btn-fill">Add</button>
                          <button type="button" class="btn btn-bg btn-fill" data-dismiss="modal">Cancle</button></center>
                    </div>
                </div>
            </div>
        </div><!--End  div of modal-->
<!--Remove peddler-->
<div class="modal fade" role="dialog" id="removePeddler">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Remove Peddler</h4>
                </div>
                                    
                <div class="modal-body">
                    <div id="view-edit-content" class="row">
                        <!-- Term edit form-->
                        <div class="col-md-12"> 
                            <form method="POST" class="form-horizontal" id="view-edit-profile">      
                                <!-- Collector initialization-->                                    
                                <div class="row form-group">                       
                                    <div class=""> 
                                        <div class="col-md-12">   
                                                <center><h4 class="title">Are you sure you want to remove <br>
                                                <span>Marko G. Garduvilia</span> ? <!--The collectors name is inside the span tag or just just the code itself is fine.-->
                                                    </h4></center>
                                            
                                                <span class="help-block">
                                                    <strong>
                                                        
                                                    </strong>
                                                </span>
                                            
                                        </div>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <center>
                          <!--ADD New Term button-->
                          <button type="button" class="btn btn-bg btn-success btn-fill">Remove</button>
                          <button type="button" class="btn btn-bg btn-fill" data-dismiss="modal">Cancle</button></center>
                    </div>
                </div>
            </div>
        </div><!--End  div of modal-->
<!--Edit peddler-->
<div class="modal fade" role="dialog" id="editPeddler">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Peddler</h4>
                </div>
                                    
                <div class="modal-body">
                    <div id="view-edit-content" class="row">
                        <!-- Term edit form-->
                        <div class="col-md-12"> 
                            <form method="POST" class="form-horizontal" id="view-edit-profile">      
                                <!-- Collector initialization-->                                    
                                <div class="row form-group">                       
                                    <div class=""> 
                                        <div class="col-md-8">   
                                        
                                            <label class="sel1">Peddler Name:</label>
                                            <input class="form-control" id="disabledInput" type="text" placeholder="Marko G. Garduvilia" disabled>
                                                <span class="help-block">
                                                    <strong>
                                                        
                                                    </strong>
                                                </span>
                                            
                                        </div>
                                    </div>
                                </div>                                                                    
                                <div class="row form-group"> <!--Identifies the position of the peddler-->                      
                                    <div class=""> 
                                        <div class="col-md-8">    
                                            <label class="sel1">Position:</label>
                                              <form>
                                                
                                                  <select class="form-control" id="sel1">
                                                    <option>Team leader</option>
                                                    <option>Subordinate</option>  
                                                  </select>
                                              </form>
                                                <span class="help-block">
                                                    <strong>
                                                        
                                                    </strong>
                                                </span>
                                        </div>
                                    </div>
                                </div> 
                            </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <center>
                          <!--ADD New Term button-->
                          <button type="button" class="btn btn-bg btn-success btn-fill">save</button>
                          <button type="button" class="btn btn-bg btn-fill" data-dismiss="modal">Cancle</button></center>
                    </div>
                </div>
            </div>
        </div><!--End  div of modal-->
<!--Remove Item-->
<div class="modal fade" role="dialog" id="removeItem">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Remove Item</h4>
                </div>
                                    
                <div class="modal-body">
                    <div id="view-edit-content" class="row">
                        <!-- Term edit form-->
                        <div class="col-md-12"> 
                            <form method="POST" class="form-horizontal" id="view-edit-profile">      
                                <!-- Collector initialization-->                                    
                                <div class="row form-group">                       
                                    <div class=""> 
                                        <div class="col-md-8">   
                                            <!--Picks existing item-->
                                            <label class="sel1">Item Name:</label>
                                              <form>
                                                  <!-- Generate list of item within the existing term.-->
                                                  <select class="form-control" id="sel1">
                                                    <option>chair</option>
                                                  </select>
                                              </form>
                                            
                                                <span class="help-block">
                                                    <strong>
                                                        
                                                    </strong>
                                                </span>
                                            
                                        </div>
                                    </div>
                                </div> 
                            </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <center>
                          <!--ADD New Term button-->
                          <button type="button" class="btn btn-bg btn-success btn-fill">Remove</button>
                          <button type="button" class="btn btn-bg btn-fill" data-dismiss="modal">Cancle</button></center>
                    </div>
                </div>
            </div>
        </div><!--End  div of modal-->
<!--Add Item-->
<div class="modal fade" role="dialog" id="addItem">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Item</h4>
                </div>
                                    
                <div class="modal-body">
                    <div id="view-edit-content" class="row">
                        <!-- Term edit form-->
                        <div class="col-md-12"> 
                            <form method="POST" class="form-horizontal" id="view-edit-profile">      
                                <!-- Collector initialization-->                                    
                                <div class="row">                       
                                    <div class=""> 
                                        <div class="col-md-8">   
                                            <!--Picks items that are available within the inventory. Only Items that the quantity is greater than 0 can be generated.-->
                                            <label class="sel1">Item Name:</label>
                                              <form>
                                                  <!-- Generate list of item within the existing term.-->
                                                  <select class="form-control" id="sel1">
                                                    <option>chair</option>
                                                  </select>
                                              </form>
                                            
                                                <span class="help-block">
                                                    <strong>
                                                        
                                                    </strong>
                                                </span>
                                            
                                        </div>
                                    
                                    <div class="">
                                        <div class="col-md-6">  
                                            <label>Collector's price:</label>
                                            <input type="text" required name="Term_address" id="T_address" class="form-control">
                                                                                
                                                <span class="help-block">
                                                    
                                                </span>
                                
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="col-md-6">  
                                            <!--Note: Must not exceed with the existing quantity.-->
                                            <label>Quantity</label>
                                            <input type="number" required name="cnum" id="cnum2" class="form-control" value="">
                                                                                
                                                <span class="help-block">
                                                    
                                                </span>
                                
                                        </div>
                                    </div>  
                                    </div>
                                </div> 
                            </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <center>
                          <!--ADD New Term button-->
                          <button type="button" class="btn btn-bg btn-success btn-fill">Add</button>
                          <button type="button" class="btn btn-bg btn-fill" data-dismiss="modal">Cancle</button></center>
                    </div>
                </div>
            </div>
        </div><!--End  div of modal--> 
<!--Update items quantity-->    
<div class="modal fade" role="dialog" id="updateItem">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Item</h4>
                </div>
                                    
                <div class="modal-body">
                    <div id="view-edit-content" class="row">
                        <!-- Term edit form-->
                        <div class="col-md-12"> 
                            <form method="POST" class="form-horizontal" id="view-edit-profile">      
                                <!-- Collector initialization-->                                    
                                <div class="row">                       
                                    <div class=""> 
                                        <div class="col-md-8">   
                                            <!--Gdenerates Items that exist within this term. -->
                                            <label class="sel1">Item Name:</label>
                                              <form>
                                                  <!-- Generate list of item within the existing term.-->
                                                  <select class="form-control" id="sel1">
                                                    <option>chair</option>
                                                  </select>
                                              </form>
                                            
                                                <span class="help-block">
                                                    <strong>
                                                        
                                                    </strong>
                                                </span>
                                            
                                        </div>
  
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="">
                                        <div class="col-md-6">  
                                            <!--Note: Must not exceed with the existing quantity.-->
                                            <label>Damaged Quantity</label>
                                            <input type="number" required name="cnum" id="cnum2" class="form-control" value="">
                                                                                
                                                <span class="help-block">
                                                    
                                                </span>
                                
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="">
                                        <div class="col-md-6">  
                                            <!--Note: Must not exceed with the existing quantity.-->
                                            <label>Returns Quantity:</label>
                                            <input type="number" required name="cnum" id="cnum2" class="form-control" value="">
                                                                                
                                                <span class="help-block">
                                                    
                                                </span>
                                
                                        </div>
                                    </div>  
                                </div>

                            </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <center>
                          <!--ADD New Term button-->
                          <button type="button" class="btn btn-bg btn-success btn-fill">Update</button>
                          <button type="button" class="btn btn-bg btn-fill" data-dismiss="modal">Cancle</button></center>
                    </div>
                </div>
            </div>
        </div><!--End  div of modal-->
<!--Add Expense-->   
<div class="modal fade" role="dialog" id="addExpense">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Expense</h4>
                </div>
                                    
                <div class="modal-body">
                    <div id="view-edit-content" class="row">
                        <!-- Term edit form-->
                        <div class="col-md-12"> 
                            <form method="POST" class="form-horizontal" id="view-edit-profile">      
                                <!-- Collector initialization-->                                    
                                             
                                    <div class=""> 
                                    <div class="row">
                                            <div class="">
                                                <div class="col-md-12">  
                                                    <!--Note: Must not exceed with the existing quantity.-->
                                                    <label>Expense used:</label>
                                                    <input class="form-control" type="text" id="expenseNote" placeholder="Write expense used here">

                                                        <span class="help-block">

                                                        </span>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                        <div class="">
                                            <div class="col-md-6">  
                                                <label>Expense amount:</label>
                                                <input type="text" required name="Term_address" id="T_address" class="form-control">

                                                    <span class="help-block">

                                                    </span>

                                            </div>
                                        </div> 
                                        </div>
                                    </div>
                                
                            </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <center>
                          <!--ADD New Term button-->
                          <button type="button" class="btn btn-bg btn-success btn-fill">Add</button>
                          <button type="button" class="btn btn-bg btn-fill" data-dismiss="modal">Cancle</button></center>
                    </div>
                </div>
            </div>
        </div><!--End  div of modal-->
<!--Edit Expense--> 
<div class="modal fade" role="dialog" id="editExpense">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Expense</h4>
                </div>
                                    
                <div class="modal-body">
                    <div id="view-edit-content" class="row">
                        <div class="col-md-12"> 
                            <form method="POST" class="form-horizontal" id="view-edit-profile">      
                                                              
                                             
                                    <div class=""> 
                                    <div class="row">
                                            <div class="">
                                                <div class="col-md-12">  
                                                    
                                                    <label>Expense used:</label>
                                                    <input class="form-control" type="text" id="expenseNote" placeholder="">

                                                        <span class="help-block">

                                                        </span>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                        <div class="">
                                            <div class="col-md-6">  
                                                <label>Expense amount:</label>
                                                <input type="text" required name="Term_address" id="T_address" class="form-control">

                                                    <span class="help-block">

                                                    </span>

                                            </div>
                                        </div> 
                                        </div>
                                    </div>
                                
                            </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <center>
                          <!--ADD New Term button-->
                          <button type="button" class="btn btn-bg btn-success btn-fill">Save</button>
                          <button type="button" class="btn btn-bg btn-fill" data-dismiss="modal">Cancle</button></center>
                    </div>
                </div>
            </div>
        </div><!--End  div of modal-->
<!--Add Collection-->
<div class="modal fade" role="dialog" id="addCollection">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Collection</h4>
                </div>
                                    
                <div class="modal-body">
                    <div id="view-edit-content" class="row">
                        <div class="col-md-12"> 
                            <form method="POST" class="form-horizontal" id="view-edit-profile">                                        
                                             
                                    <div class="">
                                <div class="row form-group">
                                    <div class="">
                                            <div class="col-md-6">
                                                <label>Date</label>
                                                <!--I think this should be initialized for current date rather than adding this manualy? Just incase I'm putting this.-->
                                                <input name="initialTerm_Date"  id="initT_Date" class="form-control" type="text" onfocus="(this.type='date')" required onblur="if(!this.value)this.type='text'">
                                                                                    
                                                    <span class="help-block">
                                                        <strong>  </strong>
                                                    </span>
                                            
                                            </div>
                                    </div> 
                                </div> 
                                        <div class="row">
                                        <div class="">
                                            <div class="col-md-6">  
                                                <label>Collection amount:</label>
                                                <input type="text" required name="Term_address" id="T_address" class="form-control">

                                                    <span class="help-block">

                                                    </span>

                                            </div>
                                        </div> 
                                        </div>
                                    <div class="row">
                                    <div class="">
                                        <div class="col-md-12">  
                                            <!--Note: Must not exceed with the existing quantity.-->
                                            <label>Note:</label>
                                            <textarea rows="8" required name="cnum" id="cnum2" class="form-control" value=""></textarea>
                                                                     
                                                <span class="help-block">
                                                    
                                                </span>
                                
                                        </div>
                                    </div>
                                </div>
                                    </div>
                                
                            </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <center>
                          <!--ADD New Term button-->
                          <button type="button" class="btn btn-bg btn-success btn-fill">Add</button>
                          <button type="button" class="btn btn-bg btn-fill" data-dismiss="modal">Cancle</button></center>
                    </div>
                </div>
            </div>
        </div><!--End  div of modal-->
<!--Edit Collection-->
<div class="modal fade" role="dialog" id="editCollection">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Collection</h4>
                </div>
                                    
                <div class="modal-body">
                    <div id="view-edit-content" class="row">
                        <div class="col-md-12"> 
                            <form method="POST" class="form-horizontal" id="view-edit-profile">                                        
                                             
                                    <div class="">
                                <div class="row form-group">
                                    <div class="">
                                            <div class="col-md-6">
                                                <label>Date</label>
                                                <!--I think this should be initialized for current date rather than adding is manualy? Just incase I'm putting this.-->
                                                <input name="initialTerm_Date"  id="initT_Date" class="form-control" type="text" onfocus="(this.type='date')" required onblur="if(!this.value)this.type='text'">
                                                                                    
                                                    <span class="help-block">
                                                        <strong>  </strong>
                                                    </span>
                                            
                                            </div>
                                    </div> 
                                </div> 
                                        <div class="row">
                                        <div class="">
                                            <div class="col-md-6">  
                                                <label>Collection amount:</label>
                                                <input type="text" required name="Term_address" id="T_address" class="form-control">

                                                    <span class="help-block">

                                                    </span>

                                            </div>
                                        </div> 
                                        </div>
                                    </div>
                                
                            </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <center>
                          <!--ADD New Term button-->
                          <button type="button" class="btn btn-bg btn-success btn-fill">Save</button>
                          <button type="button" class="btn btn-bg btn-fill" data-dismiss="modal">Cancle</button></center>
                    </div>
                </div>
            </div>
        </div><!--End  div of modal-->
<!--View Note of the item list.-->
<div class="modal fade" role="dialog" id="viewNote">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Item <span><!--This is where the name of the selectd item is placed.--> </span>Note</h4>
                </div>
                                    
                <div class="modal-body">
                    <div id="view-edit-content" class="row">
                        <div class="col-md-12"> 
                            <form method="POST" class="form-horizontal" id="view-edit-profile">                                                          
                                <div class="">
                                    <div class="row form-group">
                                        <div class="col-md-12">
                                        <p class="category">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ac dolor non nunc ullamcorper imperdiet nec at odio. Sed pellentesque consectetur nisl. Nullam vitae tellus diam. Suspendisse quis ipsum id felis aliquet tincidunt non sed eros. Nam vel fringilla diam. Vivamus vitae aliquam neque. Donec convallis sem diam.

                                        Sed bibendum tincidunt blandit. Proin consequat faucibus dolor, sed egestas purus gravida nec. Aliquam erat volutpat. Nulla ultricies dolor nec elit porttitor, eget consectetur eros maximus. Ut tincidunt lectus eget lectus aliquet mollis. Maecenas vel porta ex. Cras consequat augue sem, eget placerat nisl placerat vitae. Cras eros felis, auctor et justo at, bibendum cursus dolor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus vitae ipsum neque. Sed elementum magna orci, quis commodo eros egestas at. Donec non turpis massa. Sed maximus diam eu ipsum semper luctus.

                                        Pellentesque luctus vestibulum ligula vel iaculis. Pellentesque convallis velit ut efficitur commodo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc placerat nibh ac neque suscipit rutrum. Vestibulum nec tortor augue. Aliquam blandit, tortor nec tristique pulvinar, augue ligula euismod felis, eu finibus mi velit eget urna. Praesent placerat neque in euismod luctus.

                                        Donec non quam augue. Praesent quis justo id odio egestas blandit nec ut libero. Pellentesque id accumsan lorem. Phasellus imperdiet suscipit accumsan. In bibendum diam vitae risus suscipit, vitae aliquam erat ornare. Suspendisse potenti. Integer fringilla metus vitae dolor hendrerit ullamcorper. Nam faucibus vel arcu eu maximus. Praesent ullamcorper pretium vulputate.

                                        Mauris vitae pretium felis, sed blandit turpis. Sed id tempor erat, quis feugiat ante. Curabitur eu sem vel turpis facilisis vestibulum. Maecenas id vehicula massa, pellentesque tempus risus. Nullam eleifend sem id nunc iaculis, ac suscipit erat mattis. Nunc accumsan eget nisl ullamcorper condimentum. Mauris tincidunt ligula non leo pharetra finibus. Sed metus nulla, eleifend nec purus eu, consectetur posuere leo. Cras nunc nisl, porta quis ultrices vitae, lacinia at sapien.
                                        </p><!--The note's contents are here-->
                                        </div>
                                    </div> 
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <center>
                          <!--ADD New Term button-->
                          <button type="button" class="btn btn-bg btn-fill" data-dismiss="modal">Return</button></center>
                    </div>
                </div>
            </div>
        </div><!--End  div of modal-->
<!--Customer view Modal-->
<div class="modal fade" role="dialog" id="viewC" >
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <center><h4 class="modal-title">Customer Details</h4></center>
            </div>
            <div class="modal-body">
                <!--The details of the list. the span tags can also be put with classes and id for the querying.-->
                 <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td><p><b>ID:</b>  <span> 1 </span></p></td>
                            <td></td>                       
                        </tr>
                        <tr>
                            <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates whether it was updated or added.">
                                Name:</span></b> <span> David V. Tupas</span></p></td>
                            <td>
                            <p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates when the event was logged.">
                                Date:</span></b> 02/12/17</p></td>
                        </tr>
                        <tr>
             
                            <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="The one responsible for handling the items in the warehouse.">
                                Address:</span></b> <span> 44 Shirley Ave. West Chicago, IL 60185</span></p></td>
                                           <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates whether it is from the Terms, new supplies, or damages.">
                                Total Amount:</span></b> <span> 2,000.00 </span></p></td>
                        </tr>
                    </tbody>
                </table>
            <!--This table contains the list of items-->
                <hr>
                <h4 class="title">Purhcased items</h4>
                <table class="table table-hover table-striped">
                    <thead>
                        <th>ID</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Chair</td>
                            <td>22</td> 
                            <td>&#8369; 2,000.00</td>
                        </tr>
                    </tbody>
                </table>                                 
            </div>
            <div class="modal-footer">
              <center>
                  <button type="button" class="btn btn-bg btn-fill" data-dismiss="modal">Back</button>
                  <!--NOTE: This "Confirm payment" button must be hidden if the customer had paid-->
                  <button type="button" class="btn edit-btn btn-bg btn-success btn-fill" data-dismiss="modal">Confirm payment</button>
                </center>
            </div>
          </div>
        </div>
      </div><!--End div of modal-->
<!--Customer Add Modal-->        
<div class="modal fade" role="dialog" id="addC">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Customer Detials</h4>
                </div>               
                <div class="modal-body">
                    <div id="view-edit-content" class="row">
                        <div class="col-md-12"> 
                            <form method="POST" class="form-horizontal" id="view-edit-profile">                                        
                                             
                                    <div class="">
                                <div class="row form-group">
                                    <div class="">
                                            <div class="col-md-6">
                                                <label>Customer Name: </label>
                                                <!--I think this should be initialized for current date rather than adding this manualy? Just incase I'm putting this.-->
                                                <type="text" required name="Cname" id="T_address" class="form-control">
                                                                                    
                                                    <span class="help-block">
                                                        <strong>  </strong>
                                                    </span>
                                            
                                            </div>
                                    </div> 
                                </div> 
                                        <div class="row">
                                        <div class="">
                                            <div class="col-md-12">  
                                                <label>Address:</label>
                                                <input type="text" required name="Caddress" id="T_address" class="form-control">

                                                    <span class="help-block">

                                                    </span>

                                            </div>
                                        </div> 
                                        </div>
                                    <div class="row">
                                    <div class="">
                                        <div class="col-md-12">  
                                <!--Note: the date is auto incirmented just like in the groccery stores' counters, and the amount is auto calculated 
                                    by summing the list of item purchased. This is not logged, due to what was in the item terms that was totally given out 
                                    and returned from the inventory only is logged. That is not inventory process but sales, so only inventoy processes are logged.
                                -->
                                            <br><br>
                                            <center><label>Items bought</label></center>
                                                <div id="un-form">
                                                    <div class="row form-group" style="margin-top: 5%">
                                                        <div class="col-md-4">              
                                                            <label>Item Name</label>
                                                            <select class="form-control item_name" name="supply_name[]" required>
                                                            </select> 
                                                        </div>
                                                        <div class="col-md-2">              
                                                            <label>Item Qty</label>
                                                             <input type="number" class="form-control" required name="inventory_quantity[]"> 
                                                        </div>
                                                    </div>                           
                                                </div>
                                                                     
                                                <span class="help-block">
                                                    
                                                </span>
                                
                                        </div>
                                    </div>
                                </div>
                                    </div>
                                
                            </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <center>
                          <!--ADD New Term button-->
                          <button type="button" class="btn btn-info btn-fill pull-left" id="add-form">Add Item Form</button>
                          <button type="button" class="btn btn-bg btn-success btn-fill">Add</button>
                          <button type="button" class="btn btn-bg btn-fill" data-dismiss="modal">Cancle</button></center>
                    </div>
                </div>
            </div>
        </div><!--End  div of modal-->
<!--Customer Edit Modal-->
<div class="modal fade" role="dialog" id="editC">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Customer Detials</h4>
                </div>               
                <div class="modal-body">
                    <div id="view-edit-content" class="row">
                        <div class="col-md-12"> 
                            <form method="POST" class="form-horizontal" id="view-edit-profile">                                        
                                             
                                    <div class="">
                                <div class="row form-group">
                                    <div class="">
                                            <div class="col-md-6">
                                                <label>Customer Name: </label>
                                                <!--I think this should be initialized for current date rather than adding this manualy? Just incase I'm putting this.-->
                                                <type="text" required name="Cname" id="T_address" class="form-control">
                                                                                    
                                                    <span class="help-block">
                                                        <strong>  </strong>
                                                    </span>
                                            
                                            </div>
                                    </div> 
                                </div> 
                                        <div class="row">
                                        <div class="">
                                            <div class="col-md-12">  
                                                <label>Address:</label>
                                                <input type="text" required name="Caddress" id="T_address" class="form-control">

                                                    <span class="help-block">

                                                    </span>

                                            </div>
                                        </div> 
                                        </div>
                                    <div class="row">
                                    <div class="">
                                        <div class="col-md-12">  
                                            <br><br>
                                            <center><label>Items bought</label></center>
                                                <div id="un-form">
                                                    <div class="row form-group" style="margin-top: 5%">
                                                        <div class="col-md-4">              
                                                            <label>Item Name</label>
                                                            <select class="form-control item_name" name="supply_name[]" required>
                                                            </select> 
                                                        </div>
                                                        <div class="col-md-2">              
                                                            <label>Item Qty</label>
                                                             <input type="number" class="form-control" required name="inventory_quantity[]"> 
                                                        </div>
                                                    </div>                           
                                                </div>
                                                                     
                                                <span class="help-block">
                                                    
                                                </span>
                                
                                        </div>
                                    </div>
                                </div>
                                    </div>
                                
                            </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <center>
                          <!--ADD New Term button-->
                          <button type="button" class="btn btn-info btn-fill pull-left" id="add-form">Add Item Form</button>
                          <button type="button" class="btn btn-bg btn-success btn-fill">Add</button>
                          <button type="button" class="btn btn-bg btn-fill" data-dismiss="modal">Cancle</button></center>
                    </div>
                </div>
            </div>
        </div><!--End  div of modal-->
<!--Printing Modal-->    
<div class="modal fade" role="dialog" id="print">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title">Log Details</h4></center>
        </div>
        <div class="modal-body">
            <!--The details of the list. the span tags can also be put with classes and id for the querying.-->
             <table class="table table-hover">
                <tbody>
                    <tr>
                        <td><p><b>Collector:</b>  <span> James B. Debunko </span></p></td>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates when the event was logged.">
                            Term date started:</span></b> <span> 01/12/18</span></p></td>                                                
                    </tr>
                    <tr>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates whether it was updated or added.">
                            Total quantity:</span></b> <span> 22 </span></p></td>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="The one responsible for handling the items in the warehouse.">
                            Total types of items:</span></b> <span>1</span></p></td>
                    </tr>
                </tbody>
            </table>
        <!--This table contains the list of items-->
            <table class="table table-hover table-striped">
                <thead>
                    <th>ID</th>
                    <th>Item Name</th>
                    <th>Quantity</th>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Chair</td>
                        <td>22</td>                                                  
                    </tr>
                </tbody>
            </table>                                 
        </div>
        <div class="modal-footer">
          <center>
              <button type="button" class="btn btn-bg btn-info btn-fill" data-dismiss="modal">Print</button>
              <button type="button" class="btn btn-bg btn-fill" data-dismiss="modal">Back</button>
        
            </center>
        </div>
      </div>
    </div>
  </div>

</body>

    <!--   Core JS Files   -->
    <script src="/js/jquery.3.2.1.min.js" type="text/javascript"></script>
    <!--<script src="/js/bootstrap.min.js" type="text/javascript"></script>-->

    <!--  Charts Plugin -->
    <script src="/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="/js/bootstrap-notify.js"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

    <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
    <script src="/js/demo.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){

            demo.initChartist();

            $.notify({
                icon: 'pe-7s-gift',
                message: "Welcome to <b>Light Bootstrap Dashboard</b> - a beautiful freebie for every web developer."

            },{
                type: 'info',
                timer: 4000
            });

        });
    </script>
    <script type="text/javascript">
        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <script type="text/javascript">
        $('#myTabs a').click(function (e) {
          e.preventDefault()
          $(this).tab('show')
        })
    </script>
@endsection
</html>
