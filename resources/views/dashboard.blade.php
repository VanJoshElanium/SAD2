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
    <script src="/js/jquery.3.2.1.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function(){ 
            var worker = document.getElementById("h3");
            var collector = document.getElementById("h2");
            var owner_admin = document.getElementById("h1");
            var sidebar = document.getElementById("sidebar");

            //Current User => Admin || Owner
            @if (\Auth::user() -> user_type == "Administrator" || \Auth::user() -> user_type == "Owner") 
                worker.style.display = "none";
                collector.style.display = "none"; 
                owner_admin.style.display = "block"; 
                sidebar.style.display = "block"; 

            //Current User => Collector
            @elseif(\Auth::user() -> user_type == "Collector")
                worker.style.display = "none";
                collector.style.display = "block"; 
                owner_admin.style.display = "none";
                sidebar.remove(); 
               $("#main-panel").removeClass("main-panel");
            

            //Current User => Staff
            @else
                worker.style.display = "block";
                collector.style.display = "none"; 
                owner_admin.style.display = "none"; 
                sidebar.remove();
                $("#main-panel").removeClass("main-panel");
            
             @endif
        });

        $(document).on("click", ".toLocation", function () {
            window.location = $(this).data("href");
        }); 
    </script>

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
            box-shadow: 2px 2px 3px 2px rgba(0,0,0,0.2) ;
        }
        .bg{background-color: #FFFBF7;}

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
        <div class="sidebar" id="sidebar" data-color="none" data-image="/images/lol.png">
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
                    
                    <li>
                        <a href="{{ route('logs') }}">
                            <i class="pe-7s-help1"></i>
                            <p>Help</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-panel bgd" id="main-panel">

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
                        <a class="navbar-brand" href="#">Dashboard</a>
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
                    
                    <!-- OWNER INTERFACE-->
                    <div id="h1">
                        <div class="row">
                            <!-- TERMS BUTTON-->
                            <div class="col-md-4">
                                <div class="card card-user box">
                                    <div class="image" style="background-color:#556B2F;"></div>
                                    <div class="content bg">
                                        <div class="author">
                                            <br><br><br><br><br><br>
                                            <img class="" src="{{ asset('images/icons8-pie-chart-100.png') }}" alt="..."/><br><br><br>
                                              <h4 class="title"><b>Term</b></h4>
                                                <h5>Ongoing and completed terms</h5>

                                            <hr>
                                            <h5 class="title text-center"> 
                                               
                                            </h5>
                                             <button style="margin-top:5%; margin-bottom:5%" type="button" data-target="#editSupplierModal" data-toggle="modal" id="edit-supplier-btn" class=" toLocation btn  btn-primary btn-fill btn-md" data-href="{{route('terms')}}" data-id=''> 
                                                View List
                                            </button>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <!-- INVENTORY BUTTON-->
                            <div class="col-md-4">
                                <div class="card card-user box">
                                    <div class="image" style="background-color:#FFA732;"></div>
                                    <div class="content bg">
                                        <div class="author">
                                            <br><br><br><br><br><br>
                                            <img class="" src="{{ asset('images/icons8-warehouse-100.png') }}" alt="..."/><br><br><br>
                                              <h4 class="title"><b>Inventory List</b></h4>
                                                <h5>Undamaged and damaged items</h5>
                                             <button style="margin-top:5%; margin-bottom:5%" type="button" data-target="#editSupplierModal" data-toggle="modal" id="edit-supplier-btn" class=" toLocation btn  btn-primary btn-fill btn-md" data-href="{{route('inventory')}}" data-id=''> 
                                                View List
                                            </button>
                                        </div>
                                    </div> 
                                </div>
                            </div> 
                            <!-- SUPPLIERS BUTTON-->
                            <div class="col-md-4">
                                <div class="card card-user box">
                                    <div class="image" style="background-color:#CD853F;"></div>




                                    <div class="content bg">
                                        <div class="author">
                                            <br><br><br><br><br><br>
                                            <img class="" src="{{ asset('images/icons8-box-100.png') }}" alt="..."/><br><br><br>
                                              <h4 class="title"><b>Suppliers</b></h4>
                                                <h5>Suppliers and their supplied items</h5>

                                            <hr>
                                            <h5 class="title text-center"> 
                                               
                                            </h5>
                                             <button style="margin-top:5%; margin-bottom:5%" type="button" data-target="#editSupplierModal" data-toggle="modal" id="edit-supplier-btn" class=" toLocation btn  btn-primary btn-fill btn-md" data-href="{{route('suppliers')}}"> 
                                                View List
                                            </button>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <!-- USERS BUTTON-->
                            <div class="col-md-4 col-md-offset-2">
                                <div class="card card-user box">
                                    <div class="image" style="background-color:#1E6555;"></div>
                                    <div class="content bg">
                                        <div class="author">
                                            <br><br><br><br><br><br>
                                            <img class="" src="{{ asset('images/icons8-user-account-100.png') }}" alt="..."/><br><br><br>
                                              <h4 class="title"><b>Users</b></h4>
                                                <h5>User profiles</h5>

                                            <hr>
                                            <h5 class="title text-center"> 
                                               
                                            </h5>
                                             <button style="margin-top:5%; margin-bottom:5%" type="button" data-target="#editSupplierModal" data-toggle="modal" id="edit-supplier-btn" class=" toLocation btn  btn-primary btn-fill btn-md" data-href="{{route('usrmgmt')}}"> 
                                                View List
                                            </button>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <!-- LOGS BUTTON-->
                            <div class="col-md-4">
                                <div class="card card-user box">
                                    <div class="image" style="background-color:#962E3E;"></div>
                                    <div class="content bg">
                                        <div class="author">
                                            <br><br><br><br><br><br>
                                            <img class="" src="{{ asset('images/icons8-paper-100.png') }}" alt="..."/><br><br><br>
                                              <h4 class="title"><b>Logs</b></h4>
                                                <h5>User activities</h5>

                                            <hr>
                                            <h5 class="title text-center"> 
                                               
                                            </h5>
                                             <button style="margin-top:5%; margin-bottom:5%" type="button" data-target="#editSupplierModal" data-toggle="modal" id="edit-supplier-btn" class=" toLocation btn  btn-primary btn-fill btn-md" data-href="{{route('logs')}}"> 
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
                                    <div class="col-md-4 col-md-offset-4">
                                        <center><h5 class="title"><b>Sales Chart</b></h5></center>
                                        <p class="category"></p>
                                    </div> 
                                </div>
                                
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
                    </div>
                    
                    <!-- COLLECTOR INTERFACE-->
                    <div id="h2" class="animated fadeIn">
                        <!-- BUTTONS FOR LISTS ON WORKERS AND ITEMS IN INVENTORY-->
                        <div class="row">
                            <div class="col-md-4 col-md-offset-2">
                                <div class="card card-user box">
                                    <div class="image" style="background-color:#FFA929;"></div>
                                    <div class="content bg">
                                        <div class="author">
                                            <br><br><br><br><br><br>
                                            <img class="" src="{{ asset('images/icons8-workers-100.png') }}" alt="..."/><br><br><br>
                                              <h4 class="title"><b>Worker List</b></h4>
                                                <h5>Available Workers</h5>

                                            <hr>
                                            <h5 class="title text-center"> 
                                               
                                            </h5>
                                             <button style="margin-top:5%; margin-bottom:5%" type="button" data-target="#editSupplierModal" data-toggle="modal" id="edit-supplier-btn" data-href="{{ route('usrmgmt') }}"  class="toProfile btn  btn-primary btn-fill btn-md" data-id=''> 
                                                View 
                                            </button>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-user box">
                                    <div class="image" style="background-color:#FF7629;"></div>
                                    <div class="content bg">
                                        <div class="author">
                                            <br><br><br><br><br><br>
                                            <img class="" src="{{ asset('images/icons8-warehouse-100.png') }}" alt="..."/><br><br><br>
                                              <h4 class="title"><b>Inventory</b></h4>
                                                <h5>Items in Warehouse</h5>

                                            <hr>
                                            <h5 class="title text-center"> 
                                               
                                            </h5>
                                             <button style="margin-top:5%; margin-bottom:5%" type="button" data-target="#editSupplierModal" data-toggle="modal" id="edit-supplier-btn" data-href="{{ route('inventory') }}"  class="toProfile btn  btn-primary btn-fill btn-md" data-id=''> 
                                                View 
                                            </button>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <!-- LIST OF TERMS-->
                        <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                        <div class="card box2">
                            <div class="header">
                                
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="header">
                                                <h4 class="title">Participated Terms</h4>
                                            </div>
                                        </div>

                                        <form method="GET" action="{{ route('searchUsers') }}">
                                            <div class="col-md-4" style="margin-top:10px">
                                                <input type="text" name="titlesearch" class="form-control search" placeholder="Search . . ." value="{{ old('titlesearch') }}">
                                            </div>
                                        
                                            <div class="col-md-2" style="margin-top:10px">
                                                <button style="height: 40px;"; class="btn btn-success pe-7s-search"></button>
                                            </div>
                                        </form>   
                                    </div>
                                
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                
                                    <thead>
                                        <tr> 
                                            @if(count($pts)>0)
                                                <th>#</th>
                                                <th>Date Started</th>
                                                <th>Date Ended</th>
                                                <th>Location</th>
                                                <th>Complete</th> 
                                            @endif
                                        </tr>
                                        <!-- <th>View Details</th> -->
                                    </thead>
                                    <tbody>
                                            <?php $y=0; ?>
                                            @forelse($pts as $pt)
                                            <tr> 
                                                <td>{{$y += 1}}</td>
                                                <td>{{$pt -> start_date}}</td>
                                                <td>{{$pt -> end_date}}</td>
                                                <td>{{$pt -> location}}</td>
                                                <td>
                                                    @if($pt->finish_date == null)
                                                        <span class="red-dot"></span>
                                                    @else 
                                                        <span class="green-dot"></span>
                                                    @endif
                                                </td>
                                                </td>
                                                <td> 
                                                    <button data-href="{{ route('termsprofile.show', ['term' => $pt->term_id]) }}" class="toProfile btn btn-primary btn-fill">
                                                        View
                                                    </button>
                                                </td>
                                            </tr>
                                            @empty
                                                <h3 style="text-align: center"> No terms to show. </h3>
                                            @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                         <div style="margin-left: 1%"> 
                                    {{$pts->links()}} 
                                </div>
                    </div>
                        </div>
                    </div>
                    
                    <!-- WORKER INTEFACE-->
                    <div id="h3">
                        <div class="row">
                            <div class="row" >
                        <div class="col-md-8 col-md-offset-2">
                            <div class="card box2">
                                    
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="header">
                                                <h4 class="title">Participated Terms</h4>
                                            </div>
                                        </div>

                                        <form method="GET" action="{{ route('searchUsers') }}">
                                            <div class="col-md-4" style="margin-top:10px">
                                                <input type="text" name="titlesearch" class="form-control search" placeholder="Search . . ." value="{{ old('titlesearch') }}">
                                            </div>
                                        
                                            <div class="col-md-2" style="margin-top:10px">
                                                <button style="height: 40px;"; class="btn btn-success pe-7s-search"></button>
                                            </div>
                                        </form>   
                                    </div>
                                    
                               
                                <div class="content table-responsive table-full-width">
                                    <table class="table table-hover table-striped">
                                    
                                        <thead>
                                            <tr>
                                                @if(count($pts)>0)
                                                    <th>#</th>
                                                    <th>Date Started</th>
                                                    <th>Date Ended</th>
                                                    <th>Location</th>  
                                                @endif
                                            </tr>
                                            <!-- <th>View Details</th> -->
                                        </thead>
                                        <tbody>
                                            <?php $x=0; ?>
                                            @forelse($pts as $pt)
                                                <td>{{ $x+=1 }}</td>
                                                <td>{{$pt -> start_date}}</td>
                                                <td>{{$pt -> end_date}}</td>
                                                <td>{{$pt -> location}}</td>
                                                </td>
                                                <td> 
                                                    <button data-href="{{ route('termsprofile.show', ['term' => $pt->term_id]) }}" class="toProfile btn btn-primary btn-fill">
                                                        View
                                                    </button>
                                                </td>
                                                </tr>
                                                @empty
                                                <h3 style="text-align: center"> No terms to show. </h3>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div style="margin-left: 1%"> 
                                    {{$pts->links()}} 
                                </div>
                    </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

    <!--   Core JS Files   -->
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

    

    <!--  TERM PROFILE -->
    <script>
        $(document).on("click", ".toProfile", function () {
                window.location = $(this).data("href");
        });
    </script>


@endsection
