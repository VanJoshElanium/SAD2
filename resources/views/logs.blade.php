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
                                            <center><label>Select Date:</label></center>
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
    <div class="modal fade" role="dialog" id="itemDetails">
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
                            Date:</span></b> <span> 01/12/18</span></p></td>                                                
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
  </div>
<!-- This is the Modal content for the Password -->
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
                            Date:</span></b> <span> 01/12/18</span></p></td>                                                
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
@endsection

