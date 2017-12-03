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
</head>

<body>
    <div class="wrapper">
        
        <!-- SIDEBAR -->
        <div class="sidebar" data-color="purple" data-image="/images/sidebar-5.jpg">
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="{{ route('dashboard') }}" class="simple-text">
                        Prince & Princess
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
                        <a href="/html/user.html">
                            <i class="pe-7s-user"></i>
                            <p>User Profile</p>
                        </a>
                    </li>
                    <li>
                        <a href="/html/table.html">
                            <i class="pe-7s-note2"></i>
                            <p>Table List</p>
                        </a>
                    </li>
                    <li>
                        <a href="/html/typography.html">
                            <i class="pe-7s-news-paper"></i>
                            <p>Typography</p>
                        </a>
                    </li>
                    <li>
                        <a href="/html/icons.html">
                            <i class="pe-7s-science"></i>
                            <p>Icons</p>
                        </a>
                    </li>
                    <li>
                        <a href="/html/notifications.html">
                            <i class="pe-7s-bell"></i>
                            <p>Notifications</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="{{ route('usrmgmt') }}">
                            <i class="pe-7s-settings"></i>
                            <p>User Management</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-panel">

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
                        <a class="navbar-brand" href="#">User Management</a>
                   </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="/users" method="POST" style="display: none;">
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
                    <!-- ADD, EDIT, REMOVE BUTTONS -->
                    <div class="row" style="margin-bottom: 2.5%; float: right; padding-right:15px;">
                        <button data-target="#addModal" data-toggle="modal" class="btn btn-info btn-fill" id="add-btn">
                            Add
                        </button>

                        <button class="btn btn-info btn-fill" id="edit-btn">
                            Edit
                        </button>

                        <button class="btn btn-info btn-fill" id="del-btn">
                            Delete
                        </button>
                    </div>    

                    <div class="row">
                        <!-- TABLE OF USERS -->
                        <div class="col-md-12">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">P&P MIS Users</h4>
                                    <p class="category">All users of the P&P Management Information System </p>
                                </div>
                                <div class="content table-responsive table-full-width">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>Name</th>
                                            <th>Contact Number</th>
                                            <th>User Type</th>
                                        </thead>
                                        <tbody>
                                            @forelse($users as $user)
                                                <tr onclick="readOnly()" data-target="#profileModal" data-toggle="modal" class="profile-quick-view" data-id='{{$user->id}}'>    
                                                  <td>
                                                    {{$user->fname}} {{$user->mname}} {{$user->lname}}
                                                  </td>
                                                  <td>{{$user->cnum}}</td>
                                                  <td>{{$user->user_type}}</td>
                                                </tr>
                                            @empty
                                                <h1> No users stored. </h1>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <p class="copyright pull-right">
                        &copy; <script>document.write(new Date().getFullYear())</script> 
                        GMR
                    </p>
                </div>
            </footer>

        </div>
    </div>

    <!-- ADD MODAL -->
    <div class="modal fade" role="dialog" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">New User</h4>
                </div>
                                    
                <div class="modal-body">
                    <div class="row">
                        <!-- USER ADD FORM -->
                        <div class="col-md-12"> 
                            <form class="form-horizontal" method="POST" action="/create_users">

                            {{ csrf_field() }}

                            <!-- USER NAME DETAILS-->                                    
                            <div class="row form-group"> 
                               
                                <div class="{{$errors->has('fname') ? ' has-error' : ''}}"> 
                                    <div class="col-md-9">    
                                        <label>First Name</label>
                                        <input type="text" id="fname" class="form-control"  name="fname" required> 
                                        @if ($errors->has('fname'))
                                            <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('fname') }}
                                                </strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="{{$errors->has('mname') ? ' has-error' : ''}}"> 
                                    <div class="col-md-3"> 
                                        <label>M.I.</label>
                                        <input type="text" id="mname" class="form-control" required name="mname" value="{{ old('mname') }}">
                                        @if ($errors->has('mname'))
                                            <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('mname') }}
                                                </strong>
                                            </span>
                                        @endif                   
                                    </div>      
                                </div>
                            </div>
                                                                        
                            <div class="row form-group">
                                <div class="{{$errors->has('lname') ? ' has-error' : ''}}">
                                    <div class="col-md-12">              
                                        <label>Last Name</label>
                                         <input type="text" id="lname" class="form-control" required name="lname" value="{{ old('lname') }}"> 
                                         @if ($errors->has('lname'))
                                             <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('lname') }}</strong>
                                             </span>
                                        @endif
                                    </div>
                                </div> 
                            </div>

                            <!-- BIRTHDAY AND GENDER -->
                            <div class="other-details">
                                <div class="row form-group">
                                    <div class="{{ $errors->has('gender') ? ' has-error' : '' }}">
                                        <div class="col-md-5">
                                            <label for="sel1">Gender</label>
                                            <select class="form-control" name="gender" required id="gender">
                                                <option data-hidden="true" 
                                                    @if (old('gender') == '') 
                                                        selected="selected" @endif>
                                                </option>

                                                <option value="0" 
                                                    @if (old('gender') == 0) 
                                                        selected="selected"  @endif>
                                                    Male
                                                </option>
                                                
                                                <option value="1" 
                                                    @if (old('gender') == 1) 
                                                        selected="selected" @endif>
                                                    Female
                                                </option>
                                            </select>         
                                            @if ($errors->has('gender'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('gender') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="{{ $errors->has('bday') ? ' has-error' : '' }}">
                                        <div class="col-md-7">
                                            <label>Birthday</label>
                                            <input name="bday"  id="bday" class="form-control" type="text" onfocus="(this.type='date')" required onblur="if(!this.value)this.type='text'" value="{{ old('bday') }}">
                                                                                
                                            @if ($errors->has('bday'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('bday') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                                                                

                            <!-- USER CONTACT DETAILS -->
                            <div class="row form-group">
                                <div class="{{ $errors->has('cnum') ? ' has-error' : '' }}">
                                    <div class="col-md-12">  
                                        <label>Contact Number</label>
                                        <input type="number" required name="cnum" id="cnum" class="form-control" value="{{ old('cnum') }}">
                                                                            
                                        @if ($errors->has('cnum'))
                                            <span class="help-block">
                                                <strong>{{$errors->first('cnum')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- IN-SYSTEM USER DETAILS -->
                            <div class="in-sys-details">
                                <div class="row form-group">
                                    <div class="{{ $errors->has('username') ? ' has-error' : '' }}">
                                        <div class="col-md-12">    
                                            <label>Username</label>
                                            <input type="text" required name="username" class="form-control" id="username" value="{{ old('username') }}">     
                                            @if ($errors->has('username'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('username') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row form-group">
                                    <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <div class="col-md-12">    
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="password" id="password" required value="{{ old('password') }}">
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="{{ $errors->has('user_type') ? ' has-error' : '' }}">
                                    <div class="col-md-5">

                                        <label>User Type</label>
                                        <select class="form-control" id="user_type" required name="user_type" value="{{ old('user_type') }}">
                                            
                                            <option data-hidden="true" value="" @if (old('user_type') == "") selected="selected" @endif></option>

                                            <option value="0"   @if (old('user_type') == 0) selected="selected" @endif>Administrator</option>

                                            <option  value="1"  @if (old('user_type') == 1) selected="selected" @endif>Owner</option>

                                            <option  value="2"  @if (old('user_type') == 2) selected="selected" @endif>Collector</option>

                                            <option value="3"  @if (old('user_type') == 3) selected="selected" @endif>Staff</option>

                                            <option  value="4" @if (old('user_type') == 4) selected="selected" @endif>Worker</option>

                                        </select>
                                        @if ($errors->has('user_type'))
                                            <span class="help-block">
                                            </span>
                                         @endif
                                    </div>
                                    <input type="hidden" value="1" name="user_status" id="user_status">                                      
                                </div>

                                <div class="col-md-7">

                                    <!-- SUBMIT BUTTON -->
                                    <button type="submit" class="btn btn-info btn-fill pull-right" id="form-button" style="margin-top: 12%">
                                        Create
                                    </button>
                                    <div class="clearfix"></div>
                                </div>
                                </div>
                            </div>      
                            </form>                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- EDIT MODAL -->

    <!-- DELETE MODAL -->

    <!-- PROFILE MODAL -->
    <div class="modal hide fade" role="dialog" id="profileModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">User Profile</h4>
                </div>
                                    
                <div class="modal-body">
                    <div class="row">
                        <!-- USER ADD FORM -->
                        <div class="col-md-12"> 
                            <form class="form-horizontal" method="POST" action="/create_users">

                            {{ csrf_field() }}

                            <!-- USER NAME DETAILS-->                                    
                            <div class="row form-group"> 
                               
                                <div class="{{$errors->has('fname') ? ' has-error' : ''}}"> 
                                    <div class="col-md-9">    
                                        <label>First Name</label>
                                        <input type="text" id="fname2" class="form-control"  name="fname" required>
                                        @if ($errors->has('fname'))
                                            <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('fname') }}
                                                </strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="{{$errors->has('mname') ? ' has-error' : ''}}"> 
                                    <div class="col-md-3"> 
                                        <label>M.I.</label>
                                        <input type="text" id="mname" class="form-control" required name="mname" value="{{ old('mname') }}">
                                        @if ($errors->has('mname'))
                                            <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('mname') }}
                                                </strong>
                                            </span>
                                        @endif                   
                                    </div>      
                                </div>
                            </div>
                                                                        
                            <div class="row form-group">
                                <div class="{{$errors->has('lname') ? ' has-error' : ''}}">
                                    <div class="col-md-12">              
                                        <label>Last Name</label>
                                         <input type="text" id="lname" class="form-control" required name="lname" value="{{ old('lname') }}"> 
                                         @if ($errors->has('lname'))
                                             <span class="help-block">
                                                <strong>
                                                    {{ $errors->first('lname') }}</strong>
                                             </span>
                                        @endif
                                    </div>
                                </div> 
                            </div>

                            <!-- BIRTHDAY AND GENDER -->
                            <div class="other-details">
                                <div class="row form-group">
                                    <div class="{{ $errors->has('gender') ? ' has-error' : '' }}">
                                        <div class="col-md-5">
                                            <label for="sel1">Gender</label>
                                            <select class="form-control select" name="gender" required id="gender2">
                                                <option data-hidden="true" 
                                                    @if (old('gender') == '') 
                                                        selected="selected" @endif>
                                                </option>

                                                <option value="0" 
                                                    @if (old('gender') == 0) 
                                                        selected="selected"  @endif>
                                                    Male
                                                </option>
                                                
                                                <option value="1" 
                                                    @if (old('gender') == 1) 
                                                        selected="selected" @endif>
                                                    Female
                                                </option>
                                            </select>         
                                            @if ($errors->has('gender'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('gender') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="{{ $errors->has('bday') ? ' has-error' : '' }}">
                                        <div class="col-md-7">
                                            <label>Birthday</label>
                                            <input name="bday"  id="bday" class="form-control" type="text" onfocus="(this.type='date')" required onblur="if(!this.value)this.type='text'" value="{{ old('bday') }}">
                                                                                
                                            @if ($errors->has('bday'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('bday') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                                                                

                            <!-- USER CONTACT DETAILS -->
                            <div class="row form-group">
                                <div class="{{ $errors->has('cnum') ? ' has-error' : '' }}">
                                    <div class="col-md-12">  
                                        <label>Contact Number</label>
                                        <input type="number" required name="cnum" id="cnum" class="form-control" value="{{ old('cnum') }}">
                                                                            
                                        @if ($errors->has('cnum'))
                                            <span class="help-block">
                                                <strong>{{$errors->first('cnum')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- IN-SYSTEM USER DETAILS -->
                            <div class="in-sys-details">
                                <div class="row form-group">
                                    <div class="{{ $errors->has('username') ? ' has-error' : '' }}">
                                        <div class="col-md-12">    
                                            <label>Username</label>
                                            <input type="text" required name="username" class="form-control" id="username" value="{{ old('username') }}">     
                                            @if ($errors->has('username'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('username') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row form-group">
                                    <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <div class="col-md-12">    
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="password" id="password" required value="{{ old('password') }}">
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="{{ $errors->has('user_type') ? ' has-error' : '' }}">
                                    <div class="col-md-5">

                                        <label>User Type</label>
                                        <select class="form-control select" id="user_type2" required name="user_type" value="{{ old('user_type') }}">
                                            
                                            <option data-hidden="true" value="" @if (old('user_type') == "") selected="selected" @endif></option>

                                            <option value="0"   @if (old('user_type') == 0) selected="selected" @endif>Administrator</option>

                                            <option  value="1"  @if (old('user_type') == 1) selected="selected" @endif>Owner</option>

                                            <option  value="2"  @if (old('user_type') == 2) selected="selected" @endif>Collector</option>

                                            <option value="3"  @if (old('user_type') == 3) selected="selected" @endif>Staff</option>

                                            <option  value="4" @if (old('user_type') == 4) selected="selected" @endif>Worker</option>

                                        </select>
                                        @if ($errors->has('user_type'))
                                            <span class="help-block">
                                            </span>
                                         @endif
                                    </div>
                                    <input type="hidden" value="1" name="user_status" id="user_status">                                      
                                </div>

                                <div class="col-md-7">

                                    <!-- SUBMIT BUTTON -->
                                    <button type="submit" class="btn btn-info btn-fill pull-right" id="form-button" style="margin-top: 12%">
                                        Create
                                    </button>
                                    <div class="clearfix"></div>
                                </div>
                                </div>
                            </div>      
                            </form>                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @if (Session::has('message'))
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"> 
                &times 
            </button>
            {!! Session::get('message') !!}
        </div>
    @endif
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
    
    <!--KEEP CREATE MODAL OPEN IF THERE ARE VALIDATION ERRORS-->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if ({!!count($errors)!!} > 0)
                $("#addModal").modal();    
        }, false);
    </script>

    <!-- DISABLE INPUTS WHEN ON PROFILE QUICK VIEW -->
    <script type="text/javascript">
        function readOnly() {
            /*
            $('.form-control').prop('readonly', true);
            document.getElementById('gender2').disabled = true;
            document.getElementById('user_type2').disabled = true; 
            */
        }
    </script>

    <!--PASS ID OF USER TO MODAL -->
    <script>
        $(document).on("click", ".profile-quick-view", function () {
            var id = $(this).data('id');
            var fname="{!!\App\Helpers\UserHelper::getUser(".id .)!!}";
            $("#fname2").val(fname);
            alert(fname);

            $.ajax({
                url: "getUser/"+id,
                type: 'GET',             
                data: {'id':id},
                success: function(response){
                    document.getElementById("profileModal").classList.remove('hide');
                    $("#profileModal").modal('show'); 
                },
                error: function(data){
                    console.log(data);
                }
            });
        });
    </script>
@endsection
