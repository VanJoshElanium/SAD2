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

                    <li>
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
                    <li class="active">
                        <a href="/public/html/template.html">
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
                        <a class="navbar-brand" href="#">Log Records</a>
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

            <!-- CONTENT -->
            <div class="content">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <div class="card box">
                                  <div class="row">
                                    <div class="col-md-12">                                      
                                        <div class="content table-responsive table-full-width">
                                            <div class="col-md-4">
                                            <div class="header">
                                                <h4 class="title">Logs</h4> 
                                            </div> 
                                            </div>
                                            <div class="col-md-4">
                                                <!--Date Time picker-->
                                            <center><label>Select Date changed:</label></center>
                                            <input name="Log_Date"  id="initL_Date" class="form-control" type="text" onfocus="(this.type='date')" required onblur="if(!this.value)this.type='text'">
                                            </div>
                                            <table class="table table-hover table-striped">
                                                <thead>
                                                    <th>ID</th>
                                                    <th>Date</th>
                                                    <th>Event type</th>
                                                    <th>Worker Handler</th>  
                                                    <th>View Details</th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>03/04/17</td>
                                                        <td>Update</td>
                                                        <td>Arman Dumaging</td>
                                                    <!-- this is a button that will show the list of items updated-->
                                                        <td>
                                                        <button data-target="#itemDetails" id="" data-toggle="modal" data-id='' class="btn btn-bg btn-info btn-fill">
                                                            View
                                                        </button>
                                                        <button data-target="#1" id="" data-toggle="modal" data-id='' class="btn btn-bg btn-info btn-fill">
                                                            Modal tester button
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

    <!-- This is the Modal content for the Item Log   -->
    <div class="modal fade" role="dialog" id="">
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
                        <td><p><b>ID:</b>  <span> 1 </span></p></td>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates when the event was logged.">
                            Date changed:</span></b> <span> 01/12/18</span></p></td>                                                
                    </tr>
                    <tr>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates whether it was updated or added.">
                            Event type:</span></b> <span> Update </span></p></td>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="The one responsible for handling the items in the warehouse.">
                            Worker Handler:</span></b> <span> Arman Dumaging</span></p></td>
                    </tr>
                    <tr>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates whether it is from the Terms, new supplies, or damages.">
                            From:</span></b> <span> Terms </span></p></td><!--This sets whether it is from the terms, damaged supplies, or from new supplies-->
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates if it's from damages or undamaged logs">
                            Type:</span></b> <span> Damages</span></p></td>
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
          <center><button type="button" class="btn btn-bg btn-default" data-dismiss="modal">Close</button></center>
        </div>
      </div>
    </div>
  </div><!--Edn div of modal-->
    <!-- This is the Modal content for the Password -->
    <div class="modal fade" role="dialog" id="" >
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
                        <td><p><b>ID:</b>  <span> 1 </span></p></td>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates when the event was logged.">
                            Date changed:</span></b> <span> 01/12/18</span></p></td>                                                
                    </tr>
                    <tr>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates whether it was updated or added.">
                            Event type:</span></b> <span> Change password </span></p></td>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="The one responsible for handling the items in the warehouse.">
                            Handler:</span></b> <span> Arman Dumaging</span></p></td>
                    </tr>
                    <tr>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates whether it is from the Terms, new supplies, or damages.">
                            From:</span></b> <span> Accounts</span></p></td><!--This sets whether it is from the terms, damaged supplies, or from new supplies-->
                        <td></td>
                    </tr>
                    <tr><td></td><td></td></tr>
                </tbody>
            </table><br>
        <!--This table contains the list of items-->
            <table class="table table-hover table-striped">
                <label class="title">Old Password</label>
                <thead>
                    <th>ID</th>
                    <th>Account</th>
                    <th>Old Password</th>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Mark</td>
                        <td>Mark213</td>                                                  
                    </tr>
                </tbody>
            </table><br>
            <table class="table table-hover table-striped">
                <label class="title">New Password</label>
                <thead>
                    <th>ID</th>
                    <th>Account</th>
                    <th>New Password</th>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Mark</td>
                        <td>Mark123</td>                                                  
                    </tr>
                </tbody>
            </table> 
        </div>
        <div class="modal-footer">
          <center><button type="button" class="btn btn-bg btn-default" data-dismiss="modal">Close</button></center>
        </div>
      </div>
    </div>
  </div><!-- End div of modal-->  
    <!--Supplier Acoount edit-->
    <div class="modal fade" role="dialog" id="" >
    <div class="modal-dialog modal-lg">
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
                        <td><p><b>ID:</b>  <span> 1 </span></p></td>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates when the event was logged.">
                            Date changed:</span></b> <span> 01/12/18</span></p></td>                                                
                    </tr>
                    <tr>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates whether it was updated or added.">
                            Event type:</span></b> <span> Edit details </span></p></td>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="The one responsible for handling the items in the warehouse.">
                            Handler:</span></b> <span> Arman Dumaging</span></p></td>
                    </tr>
                    <tr>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates whether it is from the Terms, new supplies, or damages.">
                            From:</span></b> <span> Supplier Account</span></p></td><!--This sets whether it is from the terms, damaged supplies, or from new supplies-->
                        <td></td>
                    </tr>
                    <tr><td></td><td></td></tr>
                </tbody>
            </table><br>
        <!--This table contains the list of items-->
            <table class="table table-hover table-striped">
                <label class="title">Old Details</label>
                <thead>
                    <th>ID</th>
                    <th>Supplier Name</th>                    
                    <th>Email</th>
                    <th>Contact Number</th>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>DewFoam</td>                                                             
                        <td>something@gmail.com</td>                                                  
                        <td>09394829485</td>                                                  
                    </tr>
                </tbody>
            </table><br>
            <label>Address</label>
            <textarea rows="4" required name="cnum" id="cnum2" class="form-control" value="" disabled>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</textarea><br><br><br>
            <table class="table table-hover table-striped">
                <label class="title">New Details</label>
                <thead>
                    <th>ID</th>
                    <th>Supplier Name</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>DewFoam</td>                                                  
                        <td>newthing@gmail.com</td>                                                  
                        <td>09393498498</td>                                                  
                    </tr>
                </tbody>
            </table> 
            <label>Address</label>
            <textarea rows="4" required name="cnum" id="cnum2" class="form-control" value="" disabled>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</textarea>
        </div>
        <div class="modal-footer">
          <center><button type="button" class="btn btn-bg btn-default" data-dismiss="modal">Close</button></center>
        </div>
      </div>
    </div>
  </div><!-- End div of modal--> 
    <!--USER ACCOUNT EDITS-->
    <div class="modal fade" role="dialog" id="" >
    <div class="modal-dialog modal-lg">
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
                        <td><p><b>ID:</b>  <span> 1 </span></p></td>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates when the event was logged.">
                            Date changed:</span></b> <span> 01/12/18</span></p></td>                                                
                    </tr>
                    <tr>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates whether it was updated or added.">
                            Event type:</span></b> <span> Edit details </span></p></td>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="The one responsible for handling the items in the warehouse.">
                            Handler:</span></b> <span> Arman Dumaging</span></p></td>
                    </tr>
                    <tr>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates whether it is from the Terms, new supplies, or damages.">
                            From:</span></b> <span> User Account</span></p></td><!--This sets whether it is from the terms, damaged supplies, or from new supplies-->
                        <td></td>
                    </tr>
                    <tr><td></td><td></td></tr>
                </tbody>
            </table><br>
        <!--This table contains the list of items-->
            <table class="table table-hover table-striped">
                <label class="title">Old Details</label>
                <thead>
                    <th>ID</th>
                    <th>User Name</th>                    
                    <th>Gender</th>
                    <th>Birth Date</th>
                    <th>Contact Number</th>
                    <th>Username</th>
                    <th>User Type</th>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Mark</td>                                                             
                        <td>Male</td>                                           
                        <td>01/12/98</td>                                                  
                        <td>09394829485</td>                                                  
                        <td>Mark1</td>                                                  
                        <td>Collector</td>                                                  
                    </tr>
                </tbody>
            </table><br>
            <label>Address</label>
            <table class="table table-hover table-striped">
                <label class="title">New Details</label>
                 <thead>
                    <th>ID</th>
                    <th>User Name</th>                    
                    <th>Gender</th>
                    <th>Birth Date</th>
                    <th>Contact Number</th>
                    <th>Username</th>
                    <th>User Type</th>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Mark</td>                                                             
                        <td>Male</td>                                           
                        <td>01/12/98</td>                                                  
                        <td>09394829485</td>                                                  
                        <td>Mark1</td>                                                  
                        <td>Worker</td>                                                  
                    </tr>
                </tbody>
            </table> 
            <label>Address</label>
        </div>
        <div class="modal-footer">
          <center><button type="button" class="btn btn-bg btn-default" data-dismiss="modal">Close</button></center>
        </div>
      </div>
    </div>
  </div><!-- End div of modal--> 
    <!--SUPPLIER ITEMS-->
    <div class="modal fade" role="dialog" id="" >
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
                        <td><p><b>ID:</b>  <span> 1 </span></p></td>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates when the event was logged.">
                            Date changed:</span></b> <span> 01/12/18</span></p></td>                                                
                    </tr>
                    <tr>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates whether it was updated or added.">
                            Event type:</span></b> <span> Edit item </span></p></td>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="The one responsible for handling the items in the warehouse.">
                            Handler:</span></b> <span> Arman Dumaging</span></p></td>
                    </tr>
                    <tr>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates whether it is from the Terms, new supplies, or damages.">
                            From:</span></b> <span>Supplier </span></p></td><!--This sets whether it is from the terms, damaged supplies, or from new supplies-->
                        <td></td>
                    </tr>
                    <tr><td></td><td></td></tr>
                </tbody>
            </table><br>
        <!--This table contains the list of items-->
            <table class="table table-hover table-striped">
                <label class="title">Old Details</label>
                <thead>
                    <th>ID</th>
                    <th>Item Name</th>
                    <th>Price</th>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Table</td>
                        <td>&#x20BD; 2,000.00</td>                                                  
                    </tr>
                </tbody>
            </table><br>
            <table class="table table-hover table-striped">
                <label class="title">New Details</label>
                <thead>
                    <th>ID</th>
                    <th>Item Name</th>
                    <th>Price</th>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Table</td>
                        <td>&#x20BD; 1,500.00</td>                                                  
                    </tr>
                </tbody>
            </table> 
        </div>
        <div class="modal-footer">
          <center><button type="button" class="btn btn-bg btn-default" data-dismiss="modal">Close</button></center>
        </div>
      </div>
    </div>
  </div><!-- End div of modal--> 
    <!--TERM PEDDLER POSITION-->
    <div class="modal fade" role="dialog" id="" >
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
                        <td><p><b>ID:</b>  <span> 1 </span></p></td>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates when the event was logged.">
                            Date changed:</span></b> <span> 01/12/18</span></p></td>                                                
                    </tr>
                    <tr>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates whether it was updated or added.">
                            Event type:</span></b> <span> Edit position </span></p></td>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="The one responsible for handling the items in the warehouse.">
                            Handler:</span></b> <span> Arman Dumaging</span></p></td>
                    </tr>
                    <tr>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates whether it is from the Terms, new supplies, or damages.">
                            From:</span></b> <span>Term Profile </span></p></td>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates whether it is from the Terms, new supplies, or damages.">
                            Term Date:</span></b> <span>01/02/17 </span></p></td>
                    </tr>
                    <tr><td></td><td></td></tr>
                </tbody>
            </table><br>
        <!--This table contains the list of items-->
            <table class="table table-hover table-striped">
                <label class="title">Old Details</label>
                <thead>
                    <th>ID</th>
                    <th>Worker Name</th>
                    <th>Position</th>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Mark</td>
                        <td>Permanent Staff</td>                                                  
                    </tr>
                </tbody>
            </table><br>
            <table class="table table-hover table-striped">
                <label class="title">New Details</label>
                <thead>
                    <th>ID</th>
                    <th>Worker Name</th>
                    <th>Position</th>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Mark</td>
                        <td>Temporary Staff</td>                                                  
                    </tr>
                </tbody>
            </table> 
        </div>
        <div class="modal-footer">
          <center><button type="button" class="btn btn-bg btn-default" data-dismiss="modal">Close</button></center>
        </div>
      </div>
    </div>
  </div><!-- End div of modal--> 
    <!--TERM EDIT ITEM-->
    <div class="modal fade" role="dialog" id="" >
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
                        <td><p><b>ID:</b>  <span> 1 </span></p></td>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates when the event was logged.">
                            Date changed:</span></b> <span> 01/12/18</span></p></td>                                                
                    </tr>
                    <tr>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates whether it was updated or added.">
                            Event type:</span></b> <span> Edit item </span></p></td>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="The one responsible for handling the items in the warehouse.">
                            Handler:</span></b> <span> Arman Dumaging</span></p></td>
                    </tr>
                    <tr>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates whether it is from the Terms, new supplies, or damages.">
                            From:</span></b> <span>Term Profile </span></p></td><!--This sets whether it is from the terms, damaged supplies, or from new supplies-->
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates whether it is from the Terms, new supplies, or damages.">
                            Term Date:</span></b> <span>01/02/17 </span></p></td>
                    </tr>
                    <tr><td></td><td></td></tr>
                </tbody>
            </table><br>
        <!--This table contains the list of items-->
            <table class="table table-hover table-striped">
                <label class="title">Old Details</label>
                <thead>
                    <th>Item Name</th>
                    <th>Original Quantity</th>
                    <th>Undamged Returns Quantity</th>
                    <th>Damaged Quantity</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Table</td>
                        <td>3</td>                                                  
                        <td>23</td>                                                  
                        <td>2</td>                                                  
                    </tr>
                </tbody>
            </table><br>
            <table class="table table-hover table-striped">
                <label class="title">New Details</label>
                <thead>
                    <th>Item Name</th>
                    <th>Original Quantity</th>
                    <th>Undamged Returns Quantity</th>
                    <th>Damaged Quantity</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Table</td>
                        <td>3</td>                                                  
                        <td>2</td>                                                  
                        <td>23</td>                                                  
                    </tr>
                </tbody>
            </table> 
        </div>
        <div class="modal-footer">
          <center><button type="button" class="btn btn-bg btn-default" data-dismiss="modal">Close</button></center>
        </div>
      </div>
    </div>
  </div><!-- End div of modal--> 
    <!--TERM EDIT EXPENSE-->
    <div class="modal fade" role="dialog" id="" >
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
                        <td><p><b>ID:</b>  <span> 1 </span></p></td>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates when the event was logged.">
                            Date changed:</span></b> <span> 01/12/18</span></p></td>                                                
                    </tr>
                    <tr>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates whether it was updated or added.">
                            Event type:</span></b> <span> Edit Epxense </span></p></td>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="The one responsible for handling the items in the warehouse.">
                            Handler:</span></b> <span> Arman Dumaging</span></p></td>
                    </tr>
                    <tr>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates whether it is from the Terms, new supplies, or damages.">
                            From:</span></b> <span>Term Profile </span></p></td><!--This sets whether it is from the terms, damaged supplies, or from new supplies-->
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates whether it is from the Terms, new supplies, or damages.">
                            Term Date:</span></b> <span>01/02/17 </span></p></td>
                    </tr>
                    <tr><td></td><td></td></tr>
                </tbody>
            </table><br>
        <!--This table contains the list of items-->
            <table class="table table-hover table-striped">
                <label class="title">Old Details</label>
                <thead>
                    <th>Expense</th>
                    <th>Amount</th>
 
                </thead>
                <tbody>
                    <tr>
                        <td>Gas</td>
                        <td>&#x20BD; 2,000.00</td>                                                                                                  
                    </tr>
                </tbody>
            </table><br>
            <table class="table table-hover table-striped">
                <label class="title">New Details</label>
                <thead>
                    <th>Expense</th>
                    <th>Amount</th>
 
                </thead>
                <tbody>
                    <tr>
                        <td>Gas</td>
                        <td>&#x20BD; 1,000.00</td>                                                                                                  
                    </tr>
                </tbody>
            </table> 
        </div>
        <div class="modal-footer">
          <center><button type="button" class="btn btn-bg btn-default" data-dismiss="modal">Close</button></center>
        </div>
      </div>
    </div>
  </div><!-- End div of modal--> 
    <!--TERM COLLECTION-->
    <div class="modal fade" role="dialog" id="" >
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
                        <td><p><b>ID:</b>  <span> 1 </span></p></td>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates when the event was logged.">
                            Date changed:</span></b> <span> 01/12/18</span></p></td>                                                
                    </tr>
                    <tr>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates whether it was updated or added.">
                            Event type:</span></b> <span> Edit collection </span></p></td>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="The one responsible for handling the items in the warehouse.">
                            Handler:</span></b> <span> Arman Dumaging</span></p></td>
                    </tr>
                    <tr>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates whether it is from the Terms, new supplies, or damages.">
                            From:</span></b> <span>Term Profile </span></p></td><!--This sets whether it is from the terms, damaged supplies, or from new supplies-->
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates whether it is from the Terms, new supplies, or damages.">
                            Term Date:</span></b> <span>01/02/17 </span></p></td>
                    </tr>
                    <tr><td></td><td></td></tr>
                </tbody>
            </table><br>
        <!--This table contains the list of items-->
            <table class="table table-hover table-striped">
                <label class="title">Old Details</label>
                <thead>
                    <th>Date</th>
                    <th>Amount</th>
                </thead>
                <tbody>
                    <tr>
                        <td>01/02/18</td>
                        <td>&#x20BD; 22,000.00</td>
                    </tr>
                </tbody>
            </table><br>
            <label>Note</label>
            <textarea rows="4" required name="cnum" id="cnum2" class="form-control" value="" disabled>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</textarea><br><br><br>
            <table class="table table-hover table-striped">
                <label class="title">New Details</label>
                <thead>
                    <th>Date</th>
                    <th>Amount</th>
                </thead>
                <tbody>
                    <tr>
                        <td>01/02/18</td>
                        <td>&#x20BD; 22,000.00</td>
                    </tr>
                </tbody>
            </table><br>
            <label>Note</label>
            <textarea rows="4" required name="cnum" id="cnum2" class="form-control" value="" disabled>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</textarea>
        </div>
        <div class="modal-footer">
          <center><button type="button" class="btn btn-bg btn-default" data-dismiss="modal">Close</button></center>
        </div>
      </div>
    </div>
  </div><!-- End div of modal-->
    <!--Customer Details-->
    <div class="modal fade" role="dialog" id="1" >
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
                        <td><p><b>ID:</b>  <span> 1 </span></p></td>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates when the event was logged.">
                            Date changed:</span></b> <span> 01/12/18</span></p></td>                                                
                    </tr>
                    <tr>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates whether it was updated or added.">
                            Event type:</span></b> <span> Edit customer </span></p></td>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="The one responsible for handling the items in the warehouse.">
                            Handler:</span></b> <span> Arman Dumaging</span></p></td>
                    </tr>
                    <tr>
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates whether it is from the Terms, new supplies, or damages.">
                            From:</span></b> <span>Term Profile </span></p></td><!--This sets whether it is from the terms, damaged supplies, or from new supplies-->
                        <td><p><b><span data-toggle="tooltip" data-placement="bottom" title="Indicates whether it is from the Terms, new supplies, or damages.">
                            Term Date:</span></b> <span>01/02/17 </span></p></td>
                    </tr>
                    <tr><td></td><td></td></tr>
                </tbody>
            </table><br>
        <!--This table contains the list of items-->
            <table class="table table-hover table-striped">
                <label class="title">Old Details</label>
                <thead>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Total Payment</th>
                </thead>
                <tbody>
                    <tr>
                        <td>May</td>
                        <td>09385784893</td>
                        <td>&#x20BD; 12,000.00</td>
                    </tr>
                </tbody>
            </table><br>
            <label>Address</label>
            <textarea rows="4" required name="cnum" id="cnum2" class="form-control" value="" disabled>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</textarea><br>
            <table class="table table-hover table-striped">
                <label class="title">Items Bought</label>
                <thead>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Chair</td>
                        <td>200</td>
                        <td>&#x20BD; 100.00</td>
                    </tr>
                </tbody>
            </table><br><br><br><br>
            <table class="table table-hover table-striped">
                <label class="title">New Details</label>
                <thead>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Total Payment</th>
                </thead>
                <tbody>
                    <tr>
                        <td>May</td>
                        <td>09382983948</td>
                        <td>&#x20BD; 22,000.00</td>
                    </tr>
                </tbody>
            </table><br>
            <label>Address</label>
            <textarea rows="4" required name="cnum" id="cnum2" class="form-control" value="" disabled>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</textarea>
                            <table class="table table-hover table-striped">
                <label class="title">Items Bought</label>
                <thead>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Chair</td>
                        <td>200</td>
                        <td>&#x20BD; 100.00</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
          <center><button type="button" class="btn btn-bg btn-default" data-dismiss="modal">Close</button></center>
        </div>
      </div>
    </div>
  </div><!-- End div of modal--> 
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
        });
    </script>
    <script type="text/javascript">
        $('#myTabs a').click(function (e) {
          e.preventDefault()
          $(this).tab('show')
        });
    </script>
@endsection

