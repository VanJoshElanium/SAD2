<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="../../../images/Prince and Princes logo/1.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Terms</title>
    
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
            color: whitesmoke;
        }
        .modal-header{
            background-color:darkgray;
        }
    </style>

</head>
<body>

<div class="wrapper">
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
                        <a href="/html/user.html">
                            <i class="pe-7s-user"></i>
                            <p>User Profile</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="{{route('terms') }}">
                            <i class="pe-7s-graph"></i>
                            <p>Term Management</p>
                        </a>
                    </li>
                    <li >
                        <a href="{{route('inventory') }}">
                            <i class="pe-7s-drawer"></i>
                            <p>Inventory Management</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('suppliers') }}">
                            <i class="pe-7s-box1"></i>
                            <p>Supplier Management</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('usrmgmt') }}">
                            <i class="pe-7s-users"></i>
                            <p>User Management</p>
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
        
            <!--NAVBAR-->
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                           <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Terms</a>
                   </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="/html/user.html">
<!--                                          -->
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
<!--                                 -->
                                </form>
                            </li>
                            <li class="separator hidden-lg"></li>
                        </ul>
                    </div>
                </div>
            </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card box">
                            <div class="header">
                                <div class="row">
                                    <div class="col-md-10"><h4 class="title">List of ongoing Terms</h4></div>
                                    <div class="col-md-2">
                                        <button data-target="#AddTerm" id="" data-toggle="modal" data-id='' class="edit-btn btn btn-success btn-fill">
                                            Add New Term
                                        </button>
                                    </div>
                                </div>
                                <p class="category">Here the terms that are still ongoing and are not fully paid yet.</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>ID</th>
                                    	<th>Date Started</th>
                                    	<th>Collector</th>
                                        <th>View Details</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        	<td>1</td>
                                        	<td>02/12/17</td>
                                        	<td>Jules Barbarona</td>
                                        	<td>
                                            <button data-id='' class="btn btn-sm btn-info btn-fill">
                                                View
                                            </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="card box">
                            <div class="header">
                            <div class="row">
                                <div class="col-md-6">
                                <h4 class="title">List of finished Terms</h4>
                                <p class="category">Here are the list of terms that were fully paid by the collectors.</p>
                                </div>    
                                <div class="col-md-4">
                                    <center><label>Select Date:</label></center>
                                <input name="initialTerm_Date"  id="initT_Date" class="form-control" type="text" onfocus="(this.type='date')" required onblur="if(!this.value)this.type='text'">
                                </div>
                            </div>    
                            </div>    
                            
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>ID</th>
                                    	<th>Date Started</th>
                                    	<th>Date Ended</th>
                                    	<th>Collector</th>
                                        <th>View Details</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        	<td>1</td>
                                        	<td>02/12/17</td>
                                        	<td>02/12/18</td>
                                        	<td>Jules Barbarona</td>
                                        	<td>
                                                <!--This will open the termsprofile-->
                                            <button data-id='' class="btn btn-sm btn-info btn-fill">
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
<!--Modal for Adding Term-->
    
    <!-- VIEW/EDIT/DELETE PROFILE MODAL -->
    <div class="modal fade" role="dialog" id="AddTerm">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Term</h4>
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
                                            <label class="sel1">Collector Name</label>
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
                                <!--Term Date initialization.-->                                            
                                <div class="row form-group">
                                    <div class="">
                                            <div class="col-md-6">
                                                <label>Date Started</label>
                                                <input name="initialTerm_Date"  id="initT_Date" class="form-control" type="text" onfocus="(this.type='date')" required onblur="if(!this.value)this.type='text'">
                                                                                    
                                                    <span class="help-block">
                                                        <strong>  </strong>
                                                    </span>
                                            
                                            </div>
                                    </div> 
                                </div>
                                                                    
                                <!-- Term Address -->
                                <div class="row form-group">
                                    <div class="">
                                        <div class="col-md-12">  
                                            <label>Address</label>
                                            <input type="text" required name="Term_address" id="T_address" class="form-control">
                                                                                
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
                          <button type="button" class="btn btn-bg btn-success btn-fill">Add</button>
                          <button type="button" class="btn btn-bg btn-default" data-dismiss="modal">Cancle</button></center>
                    </div>
                </div>
            </div>
        </div>
</body>

    <!--   Core JS Files   -->
    <script src="/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="/js/bootstrap.min.js" type="text/javascript"></script>

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
            	message: "Welcome to <b>Prince and Princess Enterprises</b> - Have a nice day!"

            },{
                type: 'info',
                timer: 4000
            });

    	});
	</script>

</html>
