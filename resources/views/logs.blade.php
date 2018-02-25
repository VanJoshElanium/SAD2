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
                    <li  class="active">
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
                        <a class="navbar-brand" href="#">Logs</a>
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
                        <!-- TABLE OF USERS -->
                        <div class="col-md-12">      
                            <div class="card box">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="header">
                                            <h4 class="title">Logs</h4> 
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
                                    <table id="users-table" class="table table-hover table-striped" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                @if(count($logs)>0)
                                                <th>ID</th>
                                                <th>Description</th>
                                                <th>Logtime</th>
                                                <th>User<th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($logs as $log)
                                                <tr data-target="profileModal" data-toggle="modal" class="view-edit-modal" data-id='{{$log->id}}'>    
                                                    <td>{{$log->id}}</td>
                                                    <td>{{$log->description}}</td>
                                                    <td>{{$log->created_at}}</td>
                                                    <td>{{$log->fname}} {{$log->mname}}. {{$log->lname}}</td>
                                                    <td> 
                                                        <button data-target="#viewLog" id="view-edit-{{$log->id}}" data-toggle="modal" data-id='{{$log->id}}' class="view-btn btn btn-primary btn-fill">
                                                            View
                                                        </button>
                                                    </td>
                                                    <!-- <td>
                                                        <button data-target="#removeLog" data-toggle="modal" data-id='{{$log->id}}' class="del-btn btn btn-danger btn-fill">
                                                            Remove
                                                        </button>
                                                    </td> -->
                                                </tr>
                                            @empty
                                                <h3 style="text-align: center"> No logs stored. </h3>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div style="margin-left: 1%"> 
                                    {{$logs->links()}} 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" id="viewLog">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <center><h4 class="modal-title">Log Details</h4></center>
          </div>
          <div class="modal-body">
               <table class="content table-responsive ">
                  <tbody>
                      <tr>
                          <td id="log_action"> Action: 
                              <span> </span>
                          </td>                                                
                      </tr>
                      <tr>
                           <td id="log_date"> Log Time:
                              <span>  </span>
                          </td>
                      </tr>
                      <tr>
                          <td id="log_user"> Caused By: 
                              <span>  </span>
                           </td>  
                      </tr>

                      <tr>
                        <td id="log_details"> Details:
                            <span> </span>
                        </td>
                      </tr>
                  </tbody>
              </table>
              <br>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-bg btn-default" data-dismiss="modal">Close</button>
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
        });
    </script>
    <script type="text/javascript">
        $('#myTabs a').click(function (e) {
          e.preventDefault()
          $(this).tab('show')
        });
    </script>

    <script>
        $(document).on("click", ".view-btn", function () {
            var id = $(this).data('id');

            $.ajax({
                url: "getLog/" + id,
                type: 'GET',             
                data: { 'id' : id },
                success: function(response){
                    // DEBUGGING
                    console.log(response[0].properties);

                    $('#log_action span').html(response[0].description);
                    $('#log_date span').html(response[0].created_at); 
                    $('#log_user span').html(response[0].fname + " " + response[0].mname + ". " + response[0].lname);
                    $('#log_details span').html(response[0].properties); 
                    
                },
                error: function(data){
                    console.log(data);
                }
            });
        });
    </script>
@endsection

