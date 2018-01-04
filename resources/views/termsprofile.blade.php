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
        .bgd{
            background-image: url(../images/bg-6-full.jpg);
        }
        .box{
            border: 0px solid #888888;
            box-shadow: 5px 5px 8px 5px #888888;
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

            <!-- CONTENT -->
            <div class="content">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <div class="card box">
                                 <div>
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
                          </ul>
                                     <br>
                          <!-- Tab Contents-->
                          <div class="tab-content">
                              <!-- Workers and location Tab -->
                            <div role="tabpanel" class="tab-pane fade in active" id="mbrNloc">
                                  <div class="row">
                                    <div class="col-md-8">
                                        <div class="card">
                                        <div class="header">
                                            <div class="col-md-4"><h4 class="title">List of Peddlers</h4></div>
                                            <div class="col-md-8">
                                                <span class="pull-right">
                                                <button type="button" data-target="#addModal" data-toggle="modal" class="btn btn-success btn-fill" id="add-btn">Add Peddler</button>
                                                <button type="button" data-target="#addModal" data-toggle="modal" class="btn btn-warning btn-fill" id="add-btn"> 
                                                Remove Peddler
                                                </button>    
                                                </span>
                                            </div>
                                        </div>
                                        <div class="content table-responsive table-full-width">
                                            <table class="table table-hover table-striped">
                                                <thead>
                                                    <th>Name</th>
                                                    <th>Position</th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Marko G. Garduvilia</td> 
                                                        <td>Team Leader</td>
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
                                                <button type="button" data-target="#addModal" data-toggle="modal" class="btn btn-warning btn-fill" id="add-btn"> 
                                                    Remove Item
                                                </button>   
                                                <button type="button" data-target="#addModal" data-toggle="modal" class="btn btn-success btn-fill" id="add-btn"> 
                                                    Add Items
                                                </button>
                                                <button type="button" data-target="#addModal" data-toggle="modal" class="btn btn-info btn-fill" id="add-btn"> 
                                                    Update Quantity
                                                </button>
                                                </span>    
                                            </div>
                                        </div>
                                        <div class="content table-responsive table-full-width">
                                            <table class="table table-hover table-striped">
                                                <thead>
                                                    <th>Item Name</th>
                                                    <th>Item Selling Price</th>
                                                    <th>Original Quantity</th>
                                                    <th>Damaged Quantity</th>
                                                    <th>Returns Quantity</th>
                                                    <th>Sold Quantity</th>
                                                    <th>Note</th>
                                                </thead>
                                                <tbody class="qtty">
                                                    <tr>
                                                        <td>Table</td>
                                                        <td>&#8369; 300.00</td>
                                                        <td>45</td>
                                                        <td>4</td>
                                                        <td>7</td>
                                                        <td>34</td>
                                                        <td>
                                                        <button type="button" class="btn btn-sm btn-info" data-toggle="popover" data-placement="bottom" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?">View Note</button>
                                                        </td>
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
                            <!-- Sales Tab -->
                            <div role="tabpanel" class="tab-pane fade" id="expense">
                                  <div class="row">
                                    <div class="col-md-8">
                                        <div class="card">
                                        <div class="header">
                                            <div class="col-md-4"><h4 class="title">Expense List</h4></div>
                                            <div class="col-md-8">
                                                <span class="pull-right">
                                                <button type="button" data-target="#addModal" data-toggle="modal" class="btn btn-success btn-fill" id="add-btn">Add Expense</button>
                                                <button type="button" data-target="#addModal" data-toggle="modal" class="btn btn-warning btn-fill" id="add-btn"> 
                                                    Edit Expense
                                                </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="content table-responsive table-full-width">
                                            <table class="table table-hover table-striped">
                                                <thead>
                                                    <th>Expense Details</th>
                                                    <th>Amount</th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Gasoline expense</td> 
                                                        <td>&#8369; 1,000.00</td>
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
                            <!-- ??? Tab -->
                            <div role="tabpanel" class="tab-pane fade" id="sales">
                                  <div class="row">
                                    <div class="col-md-8">
                                        <div class="card">
                                        <div class="header">
                                            <div class="col-md-4"><h4 class="title">Collection List</h4></div>
                                                <span class="pull-right">
                                                <button type="button" data-target="#addModal" data-toggle="modal" class="btn btn-success btn-fill" id="add-btn">Add Collection</button>
                                                <button type="button" data-target="#addModal" data-toggle="modal" class="btn btn-warning btn-fill" id="add-btn"> 
                                                    Edit Collection
                                                </button>
                                                </span>
                                        </div>
                                        <div class="content table-responsive table-full-width">
                                            <table class="table table-hover table-striped">
                                                <thead>
                                                    <th>Date</th>
                                                    <th>Amount</th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>01/01/18</td> 
                                                        <td>&#8369; 250.00</td>
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
                                                <h4 class="title">Total Revenue of Owner</h4>    
                                                <p class="category">&#8369; 250.00</p>
                                                <br><br>
                                                <h4 class="title">Total Payment</h4>    
                                                <p class="category">&#8369; 10,450.00</p>
                                                <br><br><br>   
                                                <h4 class="title">Current Payment</h4>    
                                                <p class="category">&#8369; 250.00</p>
                                                <br><br>
                                                <hr>     
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

