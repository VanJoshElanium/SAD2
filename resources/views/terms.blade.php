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
        .modal-title{
            text-align:center;
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
                            <p>Inventory</p>
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
                                    <div class="col-md-6">
                                        <h4 class="title">Ongoing Terms</h4>
                                        <p class="category">Terms not yet fully paid by the collector</p>
                                    </div>
                                    <div class="col-md-4">
                                                                            
                                        <span data-toggle="tooltip" data-placement="bottom" title="Select a month or date to view only those list of terms."> 
                                        <input name="initialTerm_Date"  id="initT_Date" class="form-control" type="text" onfocus="(this.type='date')" 
                                        placeholder="Search by Date. . ." required onblur="if(!this.value)this.type='text'"></span> 
                                        
                                    </div>    
                                    <div class="col-md-2">
                                        <button data-target="#addModal" id="" data-toggle="modal" data-id='' class="edit-btn btn btn-success btn-fill pull-right">
                                            Add Term
                                        </button>
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
                                        <th>Peddling End</th>
                                        <!-- <th>View Details</th> -->
                                    </thead>
                                    <tbody>
                                        @forelse($terms as $term)
                                            <tr data-target="" data-toggle="modal" class="" data-id='{{$term->term_id}}'>    
                                                <td>{{$term->term_id}}</td>
                                                <td>{{$term->start_date}}</td>
                                                <td>{{$term->finish_date}}</td>
                                                <td>{{$term->fname}} {{$term->mname}}. {{$term->lname}}</td>
                                                <td>
                                                    <button data-target="#peddlingEnd" id="" data-toggle="modal" data-id='' class="edit-btn btn  btn-success btn-fill">
                                                        Add Peddling End
                                                    </button>
                                                </td>
                                                <td> 
                                                    <button data-href="{{ route('termsprofile.show', ['term' => $term->term_id]) }}" class="toProfile btn btn-primary btn-fill">
                                                        View
                                                    </button>
                                                </td>
                                                <td>
                                                    <button data-target="#removeModal" data-toggle="modal" data-id='{{$term->term_id}}' class="del-btn  btn btn-danger btn-fill">
                                                        Remove
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <h3 style="text-align: center"> No terms stored. </h3>
                                        @endforelse
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
                                <h4 class="title">Completed Terms</h4>
                                <p class="category">Terms fully paid by the collector</p>
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
                                        <th>ID</th>
                                    	<th>Date Started</th>
                                        <th>Peddling Date Ended</th>
                                    	<th>Collection Date Ended</th>
                                    	<th>Collector</th>
                                        <th>View Details</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        	<td>1</td>
                                        	<td>02/12/17</td>
                                        	<td>03/12/17</td>
                                        	<td>02/12/18</td>
                                        	<td>Jules Barbarona</td>
                                        	<td>
                                                <!--This will open the termsprofile-->
                                            <button data-id='' class="btn  btn-info btn-fill">
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

    <!-- VIEW/EDIT TERM MODAL -->
    <div class="modal fade" role="dialog" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Term</h4>
                </div>
                
                <form method="POST" class="form-horizontal" action="/terms">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div id="view-edit-content" class="row">
                        <!-- Term edit form-->
                            <div class="col-md-12"> 
                                <!-- Collector initialization-->                                    
                                <div class="row form-group">                       
                                    <div class="{{ $errors->has('collector') ? ' has-error' : '' }}"> 
                                        <div class="col-md-8">    
                                            <label class="sel1">Collector Name</label>
                                                  <select class="form-control" required id="collector" name="collector">
                                                    <option value="" data-hidden="true" selected="selected">
                                                    </option>
                                                    @foreach($collectors as $collector)
                                                        <option value="{{$collector->user_id}}">
                                                            {{$collector->fname}}&nbsp
                                                            {{$collector->mname}}.
                                                            {{$collector->lname}}
                                                        </option>
                                                    @endforeach
                                                  </select>
                                            
                                                @if ($errors->has('collector'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('collector') }}</strong>
                                                    </span>
                                                @endif
                                            
                                        </div>
                                    </div>
                                </div>
                                <!--Term Date initialization.-->                                            
                                <div class="row form-group">
                                    <div class="{{ $errors->has('date_started') ? ' has-error' : '' }}">
                                        <div class="col-md-6">
                                            <label>Date Started</label>
                                            <input name="date_started"  id="date_started" class="form-control" type="text" onfocus="(this.type='date')" required onblur="if(!this.value)this.type='text'" value="{{ old('date_started') }}">
                                                                                
                                            @if ($errors->has('date_started'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('date_started') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div> 
                                </div>
                                                                    
                                <!-- Term Address -->
                                <div class="row form-group">
                                    <div class="{{ $errors->has('location') ? ' has-error' : '' }}">
                                        <div class="col-md-12">  
                                            <label>Location</label>
                                            <textarea rows='2' id="location" class="form-control"  name="location" required value="{{ old('location') }}"></textarea>

                                                @if ($errors->has('location'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('location') }}</strong>
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
                          Create
                        </button>      
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" id="peddlingEnd">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">End of Peddling Date</h4>
                </div>
                                    
                <div class="modal-body">
                    <div id="view-edit-content" class="row">
                        <!-- Term edit form-->
                        <div class="col-md-12"> 
                            <form method="POST" class="form-horizontal">      
                                  
                                <!--Term Date initialization.-->                                            
                                <div class="row form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <label>Date Ended</label>
                                        <input name="initialTerm_Date"  id="initT_Date" class="form-control" type="text" onfocus="(this.type='date')" required onblur="if(!this.value)this.type='text'">
                                                                            
                                        <span class="help-block">
                                            <strong>  </strong>
                                        </span>
                                    </div>
                                </div>
                                                                    
                    
                            </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!--ADD New Term button-->
                        <button  data-dismiss="modal" aria-hidden="true" class="btn btn-basic">
                            Cancel
                        </button>
                        <button type="button" class="btn btn-bg btn-success btn-fill">Add</button>
                          
                    </div>
                </div>
            </div>
        </div>

     <div class="modal fade" role="dialog" id="removeModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Remove Term</h4>
                </div>
                                    
                <div class="modal-body">
                    <!-- DELETE TERM MODAL -->
                    <p> You are about to remove a term. Do you want to proceed?</p>          
                </div>

                <div class="modal-footer" id="delete-modal-footer">
                    <form method="POST" class="form-horizontal" id="delete-term">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="DELETE">
                        <button  data-dismiss="modal" aria-hidden="true" class="btn btn-basic">
                            No
                        </button>
                        <button type="submit" id="form-button-delete" class="btn btn-success btn-fill pull-right">    
                            Yes 
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

    <!--   Core JS Files   -->
    <script src="/js/jquery.3.2.1.min.js" type="text/javascript"></script>
    <script src="/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Notifications Plugin    -->
    <script src="/js/bootstrap-notify.js"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

    <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
    <script src="/js/demo.js"></script>

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

    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            if ({!!count($errors)!!} > 0)
                $("#addModal").modal();    
            
            
            // if({!!count($errors->editUser)!!} > 0)
            //     $("#view-edit-{{ session()-> get( 'error_id' ) }}").click();

            // if ({!!count($errors->editPass)!!} > 0)
            //     $("#passwordModal").modal();   
        });
    </script>

    <script>     
        $(document).on("click", ".del-btn", function () {
            var id = $(this).data('id');

            //FORM
            $("#delete-term").attr("action", "/terms/" +id);

        });
    </script>

    <script>
        $(document).on("click", ".toProfile", function () {
                window.location = $(this).data("href");
        });
    </script>
@endsection
