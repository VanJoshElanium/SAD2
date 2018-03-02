@extends('layouts.app')

@section('content')
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="{{ asset('images/Prince and Princes logo/2.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Dashboard</title>

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
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        }
        .box:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }
        .box2{
            border: 0px solid #888888;
            box-shadow: 2px 2px 3px 2px rgba(0,0,0,0.2)	;
        }
        /*
        NOTE: Here you can hide or not the 3 sections
        
        of the <section> tags. Change the class from 
        
        h1 = owner section
        h2 = collecor section
        h3 = worker section
        
        This is just temporary, offical hiding function will be handled in JQuerry
        */
        .h{display: none;}
        .h2{display: none;}
        .h3{display: none;}
        
        .bg{background-color: #FFFBF7;}
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
                    <li class="active">
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
                    <div class="navbar-header"><br>
                        <div class="row">
                            <div class="col-md-6"><a class="navbar-brand" href="#">Dashboard</a></div>
                            <div class="col-md-2"></div>
                            <!--<a class="btn  btn-primary btn-fill btn-sm" href="{{ URL::previous() }}">Back</a>-->
                        </div>
                   </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="{{ route('profile') }}">
                                        {{$curr_usr->fname}} {{$curr_usr->mname}} {{$curr_usr->lname}}  
                                        <!-- Full Name of currently logged in user -->
                                </a>
                            </li>

                            <li>
                                <a class="flip-animate" href="{{ route('logout') }}"
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
                    
                    <!-- OWNER INTERFACE-->
                    <section class="h1">
                        <div class="row">
                            <!-- TERMS BUTTON-->
                            <div class="col-md-4">
                                <div class="card card-user box">
                                    <div class="image" style="background-color:#2EBE00;"></div>
                                    <div class="content bg">
                                        <div class="author">
                                            <br><br><br><br><br><br>
                                            <img class="" src="{{ asset('images/icons8-pie-chart-100.png') }}" alt="..."/><br><br><br>
                                              <h4 class="title"><b>Terms</b></h4>
                                                <h5>Here is where the lists of all the Terms of ongoing or finished</h5>

                                            <hr>
                                            <h5 class="title text-center"> 
                                               
                                            </h5>
                                             <button style="margin-top:5%; margin-bottom:5%" type="button" data-target="#editSupplierModal" data-toggle="modal" id="edit-supplier-btn" class="toLocation btn  btn-primary btn-fill btn-lg" data-id='' data-href="{{route('terms')}}"> 
                                                View List
                                            </button>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <!-- INVENTORY BUTTON-->
                            <div class="col-md-4">
                                <div class="card card-user box">
                                    <div class="image" style="background-color:#FF7629;"></div>
                                    <div class="content bg">
                                        <div class="author">
                                            <br><br><br><br><br><br>
                                            <img class="" src="{{ asset('images/icons8-warehouse-100.png') }}" alt="..."/><br><br><br>
                                              <h4 class="title"><b>Inventory List</b></h4>
                                                <h5>Contains all the list of items available in the inventory</h5>

                                            <hr>
                                            <h5 class="title text-center"> 
                                               
                                            </h5>
                                             <button style="margin-top:5%; margin-bottom:5%" type="button" data-target="#editSupplierModal" data-toggle="modal" id="edit-supplier-btn" class="toLocation btn  btn-primary btn-fill btn-lg" data-id='' data-href="{{route('inventory')}}"> 
                                                View List
                                            </button>
                                        </div>
                                    </div> 
                                </div>
                            </div> 
                            <!-- SUPPLIERS BUTTON-->
                            <div class="col-md-4">
                                <div class="card card-user box">
                                    <div class="image" style="background-color:#C88841;"></div>
                                    <div class="content bg">
                                        <div class="author">
                                            <br><br><br><br><br><br>
                                            <img class="" src="{{ asset('images/icons8-box-100.png') }}" alt="..."/><br><br><br>
                                              <h4 class="title"><b>Suppliers</b></h4>
                                                <h5>Look up and see the details and add new items of suppliers</h5>

                                            <hr>
                                            <h5 class="title text-center"> 
                                               
                                            </h5>
                                             <button style="margin-top:5%; margin-bottom:5%" type="button" data-target="#editSupplierModal" data-toggle="modal" id="edit-supplier-btn" class="toLocation btn  btn-primary btn-fill btn-lg" data-id='' data-href="{{route('suppliers')}}"> 
                                                View List
                                            </button>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <!-- USERS BUTTON-->
                            <div class="col-md-4 col-md-offset-2">
                                <div class="card card-user box">
                                    <div class="image" style="background-color:#407DD0;"></div>
                                    <div class="content bg">
                                        <div class="author">
                                            <br><br><br><br><br><br>
                                            <img class="" src="{{ asset('images/icons8-user-account-100.png') }}" alt="..."/><br><br><br>
                                              <h4 class="title"><b>Users</b></h4>
                                                <h5>Contains all user details. Here you can add new users, and edit the user's accounts. Passwords can also be changed is forgotten.</h5>

                                            <hr>
                                            <h5 class="title text-center"> 
                                               
                                            </h5>
                                             <button style="margin-top:5%; margin-bottom:5%" type="button" data-target="#editSupplierModal" data-toggle="modal" id="edit-supplier-btn" class="toLocation btn  btn-primary btn-fill btn-lg" data-id='' data-href="{{route('usrmgmt')}}"> 
                                                View List
                                            </button>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <!-- LOGS BUTTON-->
                            <div class="col-md-4">
                                <div class="card card-user box">
                                    <div class="image" style="background-color:#ED435A;"></div>
                                    <div class="content bg">
                                        <div class="author">
                                            <br><br><br><br><br><br>
                                            <img class="" src="{{ asset('images/icons8-paper-100.png') }}" alt="..."/><br><br><br>
                                              <h4 class="title"><b>Logs</b></h4>
                                                <h5>Contains all the edits from users, suppliers, and terms details. Item logs can be viewed within the Inventory.</h5>

                                            <hr>
                                            <h5 class="title text-center"> 
                                               
                                            </h5>
                                             <button style="margin-top:5%; margin-bottom:5%" type="button" data-target="#editSupplierModal" data-toggle="modal" id="edit-supplier-btn" class="toLocation btn  btn-primary btn-fill btn-lg" data-id='' data-href="{{route('logs')}}"> 
                                                View List
                                            </button>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                    <div class="col-md-12">
                        <div class="card box2">
                            <div class="header">
                                <div class="row">
                                    <div class="col-md-2 col-md-offset-5">
                                        <center><h5 class="title"><b>Sales Chart</b></h5></center>
                                        <p class="category"></p>
                                    </div> 
                                    <div class="col-md-2 col-md-offset-1">
                                                                            
                                        <span data-toggle="tooltip" data-placement="bottom" title="Select a month or date to view only those list of terms."> 
                                        <input name="initialTerm_Date"  id="initT_Date" class="form-control" type="text" onfocus="(this.type='date')" 
                                        placeholder="Search by Date. . ." required onblur="if(!this.value)this.type='text'"></span> 
                                        
                                    </div>
                                    <div class="col-md-2">
                                        <button data-target="#addModal" id="" data-toggle="modal" data-id='' class="edit-btn btn btn-success btn-fill pull-left">
                                            Print
                                        </button>
                                    </div>
                                </div><br>
                                
                            </div>
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-12">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        </div>
                    </section>
                    
                    <!-- COLLECTOR INTERFACE-->
                    <section class="h2 animated fadeIn">
                        <!-- BUTTONS FOR LISTS ON WORKERS AND ITEMS IN INVENTORY-->
                        <div class="row">
                            <div class="col-md-5 col-md-offset-1">
                                <div class="card card-user box">
                                    <div class="image" style="background-color:#FF7629;"></div>
                                    <div class="content bg">
                                        <div class="author">
                                            <br><br><br><br><br><br>
                                            <img class="" src="{{ asset('images/icons8-warehouse-100.png') }}" alt="..."/><br><br><br>
                                              <h4 class="title"><b>Inventory List</b></h4>
                                                <h5>Contains all the list of items available in the inventory</h5>

                                            <hr>
                                            <h5 class="title text-center"> 
                                               
                                            </h5>
                                             <button style="margin-top:5%; margin-bottom:5%" type="button" data-href="{{route('inventory') }}" id="edit-supplier-btn" class="btn  btn-primary btn-fill btn-lg"> 
                                                View List
                                            </button>
                                        </div>
                                    </div> 
                                </div>
                        </div>
                            <div class="col-md-5">
                                <div class="card card-user box">
                                    <div class="image" style="background-color:#FFA929;"></div>
                                    <div class="content bg">
                                        <div class="author">
                                            <br><br><br><br><br><br>
                                            <img class="" src="{{ asset('images/icons8-workers-100.png') }}" alt="..."/><br><br><br>
                                              <h4 class="title"><b>Worker List</b></h4>
                                                <h5>To see the list of workers and if they are available</h5>

                                            <hr>
                                            <h5 class="title text-center"> 
                                               
                                            </h5>
                                             <button style="margin-top:5%; margin-bottom:5%" type="button" data-target="#editSupplierModal" data-toggle="modal" id="edit-supplier-btn" class="btn  btn-primary btn-fill btn-lg" data-id=''> 
                                                View List
                                            </button>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        <!-- LIST OF TERMS-->
                        <div class="row" style="margin-top:85px">
                        <div class="col-md-12">
                        <div class="card box2">
                            <div class="header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="title">Ongoing Terms</h4>
                                        <p class="category">My Terms that are still ongoing and have not been fully paid yet</p>
                                    </div>
                                    <div class="col-md-4">                                                                            
                                        <span data-toggle="tooltip" data-placement="bottom" title="Select a month or date to view only those list of terms."> 
                                        <input name="initialTerm_Date"  id="initT_Date" class="form-control" type="text" onfocus="(this.type='date')" 
                                        placeholder="Search by Date. . ." required onblur="if(!this.value)this.type='text'"></span> 
                                        
                                    </div>    
                                </div>
                                
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                
                                    <thead>
                                        <th>No.</th>
                                    	<th>Date Started</th>
                                        <th>Date Peddling Ended</th>
                                        <th>Location</th>
                                        <th>Balance</th>
                                        <th>Status</th>  
                                        <th>View</th>  
                                        <!-- <th>View Details</th> -->
                                    </thead>
                                    <tbody>
                                            <tr data-target="" data-toggle="modal" class="" data-id=''>
                                            <td>1</td>
                                            <td>02/09/17</td>
                                            <td>Unavailable</td>
                                            <td>Diversion Road, 8402, Digos City. Davao del Sur</td>
                                            <td style="background-color:#DCDCDC;">&#8369; 200.00</td>
                                            <td>Unfinished</td>
                                            </td>
                                            <td> 
                                                <button data-href="" class="toProfile btn btn-primary btn-fill">
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
                    </section>
                    
                    <!-- WORKER INTEFACE-->
                    <section class="h3">
                        <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Edit Profile</h4>
                            </div>
                            <div class="content">
                                <form>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Company (disabled)</label>
                                                <input type="text" class="form-control" disabled placeholder="Company" value="Prince and Princess.">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control" placeholder="Username" value="michael23">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" class="form-control" placeholder="Email">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" class="form-control" placeholder="Company" value="Mike">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control" placeholder="Last Name" value="Andrew">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control" placeholder="Home Address" value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" class="form-control" placeholder="City" value="Mike">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <input type="text" class="form-control" placeholder="Country" value="Andrew">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Postal Code</label>
                                                <input type="number" class="form-control" placeholder="ZIP Code">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
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
                                    <img class="avatar border-gray" src="{{ asset('images/nam.png') }}" alt="..."/>

                                      <h4 class="title">Mike Andrew<br />
                                         <small>michael24</small>
                                      </h4>
                                    </a>
                                </div>
                                <p class="description text-center"> "Lamborghini Mercy <br>
                                                    Your chick she so thirsty <br>
                                                    I'm in that two seat Lambo"
                                </p>
                            </div>
                            <hr>
                        </div>
                    </div>

                </div>
                            <div class="row" style="margin-top:10px;">
                        <div class="col-md-12">
                        <div class="card box2">
                            <div class="header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="title">Participated Terms</h4>
                                        <p class="category"></p>
                                    </div>
                                    <div class="col-md-4">                                                                            
                                        <span data-toggle="tooltip" data-placement="bottom" title="Select a month or date to view only those list of terms."> 
                                        <input name="initialTerm_Date"  id="initT_Date" class="form-control" type="text" onfocus="(this.type='date')" 
                                        placeholder="Search by Date. . ." required onblur="if(!this.value)this.type='text'"></span> 
                                        
                                    </div>    
                                </div>
                                
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                
                                    <thead>
                                        <th>No.</th>
                                    	<th>Date Started</th>
                                    	<th>Date Ended</th>
                                        <th>Location</th>
                                        <th>View</th>  
                                        <!-- <th>View Details</th> -->
                                    </thead>
                                    <tbody>
                                            <tr data-target="" data-toggle="modal" class="" data-id=''>
                                            <td>1</td>
                                            <td>02/09/17</td>
                                            <td>03/09/17</td>
                                            <td>Diversion Road, 8402, Digos City. Davao del Sur</td>
                                            </td>
                                            <td> 
                                                <button data-href="" class="toProfile btn btn-primary btn-fill">
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

                    </section>
                    
                    <section>
                        
                    </section>
                </div>
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

</body>

    <!--   Core JS Files   -->
    <script src="/js/jquery.3.2.1.min.js" type="text/javascript"></script>
    <!--<script src="/js/bootstrap.min.js" type="text/javascript"></script>-->

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
        
        $(document).on("click", ".toLocation", function(){
            window.location = $(this).data("href");
        })
    </script>
@endsection

