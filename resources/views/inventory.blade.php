@extends('layouts.app')

@section('content')
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Light Bootstrap Dashboard by Creative Tim</title>

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
    </style>
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
                        <a class="navbar-brand" href="#">Inventory</a>
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
                    <div class="col-md-12 animated fadeInUp">
                        <div class="card box">
                                 <div>
                                        <!-- Nav tabs -->
                          <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#Undamaged_Itm" aria-controls="home" role="tab" data-toggle="tab">
                                <span data-toggle="tooltip" data-placement="bottom" title="This tab contains UNDAMAGED items only.">Undamaged Items</span></a></li>
                            <li role="presentation"><a href="#Damaged_Itm" aria-controls="profile" role="tab" data-toggle="tab">
                                <span data-toggle="tooltip" data-placement="bottom" title="This tab contains DAMAGED items only.">Damaged Items</span></a></li>
                          </ul>

                          <!-- Tab Contents-->
                          <div class="tab-content">
                              <!-- Undamaged Items Tab -->
                            <div role="tabpanel" class="tab-pane fade in active" id="Undamaged_Itm">
                                  <div class="row">
                                    <div class="col-md-12">                                      
                                        <div class="header">
                                            <div class="btn-group" role="group" aria-label="...">
                                            <button type="button" class="btn btn-default" onclick="">Remove</button>
                                            <button type="button" class="btn btn-default" onclick="">Retrieve</button>
                                            <button type="button" class="btn btn-default" onclick="">Update</button>
                                            </div>
                                        </div>
                                        <div class="content table-responsive table-full-width">
                                            <table class="table table-hover table-striped">
                                                <thead>
                                                    <th>Name</th>
                                                    <th>Quantity</th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Chair</td>
                                                        <td>33</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                              </div>
                            <!-- Damaged Items Tab -->
                            <div role="tabpanel" class="tab-pane fade" id="Damaged_Itm">
                                            <div class="row">
                                <div class="col-md-12">
                                <div class="header">
                                            <div class="btn-group" role="group" aria-label="...">
                                            <button type="button" class="btn btn-default" onclick="">Update</button>
                                </div>
                                    <div class="content table-responsive table-full-width">
                                        <table class="table table-hover table-striped">
                                            <thead>
                                                <th>Name</th>
                                                <th>Quantity</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Table</td>
                                                    <td>100</td>
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

            <!-- FOOTER -->
            <footer class="footer">
                <div class="container-fluid">
                    <p class="copyright pull-right">
                       &copy; <script>document.write(new Date().toDateString())</script>
                    </p>
                </div>
            </footer>

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

