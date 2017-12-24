@extends('layouts.app')

@section('content')
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Light Bootstrap Dashboard by Creative Tim</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- addedd -->
    <!-- <script src="//code.jquery.com/jquery-1.12.3.js"></script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"> -->

    <!-- Bootstrap core CSS 3.3.7    -->
    <link href="/css/bootstrap.min.css">

    <!-- Animation library for notifications   -->
    <link href="/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="/css/light-bootstrap-dashboard.css" rel="stylesheet"/>

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
                    <li>
                        <a href="#">
                            <i class="pe-7s-graph"></i>
                            <p>Term Management</p>
                        </a>
                    </li>
                    <li>
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
                    <li class="active">
                        <a href="{{ route('usrmgmt') }}">
                            <i class="pe-7s-users"></i>
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
                            <div class="card">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="header">
                                            <h4 class="title"> System Users</h4> 
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

                                    <div class="col-md-2" style="margin-top:8px;">
                                        <button type="button" data-target="#addModal" data-toggle="modal" class="btn btn-success btn-fill" id="add-btn"> 
                                            Add User
                                        </button>
                                    </div> 
                                </div>

                                <div class="content table-responsive table-full-width">
                                    <table id="users-table" class="table table-hover table-striped" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                @if(count($users)>0)
                                                <th>@sortablelink('id', 'ID')</th>
                                                <th>@sortablelink('fname', 'First Name')</th>
                                                <th>@sortablelink('mname', 'Middle Initial')</th>
                                                <th>@sortablelink('lname', 'Last Name')</th>
                                                <th>Contact Number</th>
                                                <th>@sortablelink('user_type', 'Position')</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($users as $user)
                                                <tr onclick="readOnly()" data-target="profileModal" data-toggle="modal" class="view-edit-modal" data-id='{{$user->id}}'>    
                                                    <td>{{$user->id}}</td>
                                                    <td>{{$user->fname}}</td>
                                                    <td>{{$user->mname}}</td>
                                                    <td>{{$user->lname}}</td>
                                                    <td>{{$user->cnum}}</td>
                                                    <td>{{$user->user_type}}</td>
                                                    <td> 
                                                        <button data-target="#profileModal" id="view-edit-{{$user->id}}" data-toggle="modal" data-id='{{$user->id}}' class="edit-btn btn btn-primary btn-fill">
                                                            View
                                                        </button>
                                                    </td>
                                                    <td>
                                                        <button data-target="#profileModal" data-toggle="modal" data-id='{{$user->id}}' class="del-btn btn btn-danger btn-fill">
                                                            Remove
                                                        </button>
                                                    </td>
                                                </tr>
                                            @empty
                                                <h3 style="text-align: center"> No users stored. </h3>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <div style="margin-left: 1%"> 
                                    {{$users->links()}} 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                               
                                <div class="{{$errors->addUser->has('fname') ? ' has-error' : ''}}"> 
                                    <div class="col-md-9">    
                                        <label>First Name</label>
                                        <input type="text" id="fname" class="form-control"  name="fname" required  value="{{ old('fname') }}"> 
                                        @if ($errors->addUser->has('fname'))
                                            <span class="help-block">
                                                <strong>
                                                    {{ $errors->addUser->first('fname') }}
                                                </strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="{{$errors->addUser->has('mname') ? ' has-error' : ''}}"> 
                                    <div class="col-md-3"> 
                                        <label>M.I.</label>
                                        <input type="text" id="mname" class="form-control" required name="mname" value="{{ old('mname') }}">
                                        @if ($errors->addUser->has('mname'))
                                            <span class="help-block">
                                                <strong>
                                                    {{ $errors->addUser->first('mname') }}
                                                </strong>
                                            </span>
                                        @endif                   
                                    </div>      
                                </div>
                            </div>
                                                                        
                            <div class="row form-group">
                                <div class="{{$errors->addUser->has('lname') ? ' has-error' : ''}}">
                                    <div class="col-md-12">              
                                        <label>Last Name</label>
                                         <input type="text" id="lname" class="form-control" required name="lname" value="{{ old('lname') }}"> 
                                         @if ($errors->addUser->has('lname'))
                                             <span class="help-block">
                                                <strong>
                                                    {{ $errors->addUser->first('lname') }}</strong>
                                             </span>
                                        @endif
                                    </div>
                                </div> 
                            </div>

                            <!-- BIRTHDAY AND GENDER -->
                            <div class="other-details">
                                <div class="row form-group">
                                    <div class="{{ $errors->addUser->has('gender') ? ' has-error' : '' }}">
                                        <div class="col-md-5">
                                            <label for="sel1">Gender</label>
                                            <select class="form-control" name="gender" required id="gender">
                                                <option value="" data-hidden="true"  
                                                    selected="selected">
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
                                            @if ($errors->addUser->has('gender'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->addUser->first('gender') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="{{ $errors->addUser->has('bday') ? ' has-error' : '' }}">
                                        <div class="col-md-7">
                                            <label>Birthday</label>
                                            <input name="bday"  id="bday" class="form-control" type="text" onfocus="(this.type='date')" required onblur="if(!this.value)this.type='text'" value="{{ old('bday') }}">
                                                                                
                                            @if ($errors->addUser->has('bday'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->addUser->first('bday') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                                                                

                            <!-- USER CONTACT DETAILS -->
                            <div class="row form-group">
                                <div class="{{ $errors->addUser->has('cnum') ? ' has-error' : '' }}">
                                    <div class="col-md-12">  
                                        <label>Contact Number</label>
                                        <input type="number" required name="cnum" id="cnum2" class="form-control" value="{{ old('cnum') }}">
                                                                            
                                        @if ($errors->addUser->has('cnum'))
                                            <span class="help-block">
                                                <strong>{{$errors->addUser->first('cnum')}}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- IN-SYSTEM USER DETAILS -->
                            <div class="in-sys-details">
                                <div class="row form-group">
                                    <div class="{{ $errors->addUser->has('username') ? ' has-error' : '' }}">
                                        <div class="col-md-12">    
                                            <label>Username</label>
                                            <input type="text" required name="username" class="form-control" id="username" value="{{ old('username') }}">     
                                            @if ($errors->addUser->has('username'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->addUser->first('username') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row form-group">
                                    <div class="{{ $errors->addUser->has('password') ? ' has-error' : '' }}">
                                        <div class="col-md-12">    
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="password" id="password" required value="{{ old('password') }}">
                                            @if ($errors->addUser->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->addUser->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="{{ $errors->addUser->has('user_type') ? ' has-error' : '' }}">
                                    <div class="col-md-5">

                                        <label>User Type</label>
                                        <select class="form-control" id="user_type" required name="user_type" value="{{ old('user_type') }}">
                                            
                                            <option data-hidden="true" value="" @if (old('user_type') == "") selected="selected" @endif></option>

                                            <option value="0"   @if (old('user_type') == 0) selected="selected" @endif>Administrator</option>

                                            <option  value="1"  @if (old('user_type') == 1) selected="selected" @endif>Owner</option>

                                            <option  value="2"  @if (old('user_type') == 2) selected="selected" @endif>Collector</option>

                                            <option value="3"  @if (old('user_type') == 3) selected="selected" @endif>Peddler</option>

                                            <option  value="4" @if (old('user_type') == 4) selected="selected" @endif>Staff</option>

                                        </select>
                                        @if ($errors->addUser->has('user_type'))
                                            <span class="help-block">
                                            </span>
                                         @endif
                                    </div>
                                    
                                    <input type="hidden" value="1" name="user_status" id="user_status">                                      
                                </div>

                                <div class="col-md-7">

                                    <!-- SUBMIT BUTTON -->
                                    <button type="submit" class="btn btn-info btn-fill pull-right" id="form-button-add" style="margin-top: 12%">
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

    <!-- VIEW/EDIT/DELETE PROFILE MODAL -->
    <div class="modal fade" role="dialog" id="profileModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">User Profile</h4>
                </div>
                                    
                <div class="modal-body">
                    <div id="view-edit-content" class="row">
                        <!-- USER Edit FORM -->
                        <div class="col-md-12"> 
                            <form method="POST" class="form-horizontal" id="view-edit-profile">      
                                
                                {{ method_field('PUT') }}
                                {{ csrf_field() }}
                                

                                <!-- USER NAME DETAILS-->                                    
                                <div class="row form-group">                       
                                    <div class="{{$errors->editUser->has('profile_fname') ? ' has-error' : ''}}"> 
                                        <div class="col-md-9">    
                                            <label>First Name</label>
                                            <input type="text" id="profile_fname" class="form-control" name="profile_fname">
                                            @if ($errors->editUser->has('profile_fname'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{ $errors->editUser->first('fname') }}
                                                    </strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="{{$errors->editUser->has('profile_mname') ? ' has-error' : ''}}"> 
                                        <div class="col-md-3"> 
                                            <label>M.I.</label>
                                            <input type="text" id="profile_mname" class="form-control" required name="profile_mname">
                                            @if ($errors->editUser->has('profile_mname'))
                                                <span class="help-block">
                                                    <strong>
                                                        {{ $errors->editUser->first('mname') }}
                                                    </strong>
                                                </span>
                                            @endif                   
                                        </div>      
                                    </div>
                                </div>
                                                                            
                                <div class="row form-group">
                                    <div class="{{$errors->editUser->has('profile_lname') ? ' has-error' : ''}}">
                                        <div class="col-md-12">              
                                            <label>Last Name</label>
                                             <input type="text" id="profile_lname" class="form-control" required name="profile_lname"> 
                                             @if ($errors->editUser->has('profile_lname'))
                                                 <span class="help-block">
                                                    <strong>
                                                        {{ $errors->editUser->first('profile_lname') }}</strong>
                                                 </span>
                                            @endif
                                        </div>
                                    </div> 
                                </div>

                                <!-- BIRTHDAY AND GENDER -->
                                <div class="other-details">
                                    <div class="row form-group">
                                        <div class="{{ $errors->editUser->has('profile_gender') ? ' has-error' : '' }}">
                                            <div class="col-md-5">
                                                <label for="sel1">Gender</label>
                                                <select class="form-control select" name="profile_gender" required id="profile_gender">
                                                    <option data-hidden="true" 
                                                         @if (old('profile_gender') == '')  
                                                            selected="selected" @endif>
                                                    </option>

                                                    <option value="0" 
                                                        @if (old('profile_gender') == 0) 
                                                            selected="selected"  @endif>
                                                        Male
                                                    </option>
                                                    
                                                    <option value="1" 
                                                        @if (old('profile_gender') == 1) 
                                                            selected="selected" @endif>
                                                        Female
                                                    </option>
                                                </select>         
                                                @if ($errors->editUser->has('profile_gender'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->editUser->first('profile_gender') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="{{ $errors->editUser->has('profile_bday') ? ' has-error' : '' }}">
                                            <div class="col-md-7">
                                                <label>Birthday</label>
                                                <input name="profile_bday"  id="profile_bday" class="form-control" type="text" onfocus="(this.type='date')" required onblur="if(!this.value)this.type='text'">
                                                                                    
                                                @if ($errors->editUser->has('profile_bday'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->editUser->first('profile_bday') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                                    
                                <!-- USER CONTACT DETAILS -->
                                <div class="row form-group">
                                    <div class="{{ $errors->editUser->has('profile_cnum') ? ' has-error' : '' }}">
                                        <div class="col-md-12">  
                                            <label>Contact Number</label>
                                            <input type="number" required name="profile_cnum" id="profile_cnum" class="form-control">
                                                                                
                                            @if ($errors->editUser->has('profile_cnum'))
                                                <span class="help-block">
                                                    <strong>{{$errors->editUser->first('profile_cnum')}}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- IN-SYSTEM USER DETAILS -->
                                <div class="in-sys-details">
                                    <div class="row form-group">
                                        <div class="{{ $errors->editUser->has('profile_username') ? ' has-error' : '' }}">
                                            <div class="col-md-12">    
                                                <label>Username</label>
                                                <input type="text" required name="profile_username" class="form-control" id="profile_username">     
                                                @if ($errors->editUser->has('profile_username'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->editUser->first('profile_username') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!--  -->

                                    <div class="row form-group" style="margin-bottom: 0px">
                                        <div class="{{ $errors->editUser->has('profile_user_type') ? ' has-error' : '' }}">
                                            <div class="col-md-5">
                                                <label>User Type</label>
                                                <select class="form-control select" id="profile_user_type" required name="profile_user_type" >
                                                    
                                                    <option data-hidden="true" value="" @if (old('profile_user_type') == "") selected="selected" @endif></option>

                                                    <option value="0"   @if (old('profile_user_type') == 0) selected="selected" @endif>Administrator</option>

                                                    <option  value="1"  @if (old('profile_user_type') == 1) selected="selected" @endif>Owner</option>

                                                    <option  value="2"  @if (old('profile_profile_user_type') == 2) selected="selected" @endif>Collector</option>

                                                    <option value="3"  @if (old('profile_profile_profile_user_type') == 3) selected="selected" @endif>Peddler</option>

                                                    <option  value="4" @if (old('profile_user_type') == 4) selected="selected" @endif>Staff</option>

                                                </select>
                                                @if ($errors->editUser->has('profile_user_type'))
                                                    <span class="help-block">
                                                    </span>
                                                 @endif
                                            </div>                                    
                                        </div>

                                        <div class="col-md-7">
                                            <!-- SUBMIT BUTTON -->
                                            <button type="submit" class="btn btn-info btn-fill pull-right" id="form-button-edit" style="margin-top: 12%">
                                                Edit
                                            </button>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>

                                    <a id="change-pass-btn" class="change-pass" data-dismiss="modal" data-target="#passwordModal" data-toggle="modal"> Change Password </a> 
                                </div>      
                            </form>   
                                        
                        </div>
                    </div>

                    <!-- DELETE PROFILE MODAL -->
                    <div id="delete-content">
                        <p> You are about to remove a user. Do you want to proceed?</p>
                    </div>
                </div>

                <div class="modal-footer" id="delete-modal-footer">
                    <form method="POST" class="form-horizontal" id="delete-profile">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="DELETE">
                        <button  data-dismiss="modal" aria-hidden="true" class="btn btn-basic">
                            No
                        </button>
                        <button type="submit" id="form-button-delete" class="btn btn-info btn-fill pull-right">    Yes 
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- PASSWORD MODAL -->
    <div class="modal fade" role="dialog" id="passwordModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Change Password</h4>
                </div>
                
                 @if (!empty($error))
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endif
                @if (!empty($success))
                    <div class="alert alert-success">
                        {{ $success }}
                    </div>
                @endif

                <div class="modal-body">
                     <form class="form-horizontal" id="change-pass" method="POST">
                        {{ csrf_field() }}
                        
                        <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                            <label for="current_password" class="col-md-4 control-label">Current Password</label>
 
                            <div class="col-md-6">
                                <input id="current_password" type="password" class="form-control" name="current_password" required>
 
                                @if ($errors->has('current_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
 
                        <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                            <label for="new_password" class="col-md-4 control-label">New Password</label>
 
                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control" name="new_password" required>
 
                                @if ($errors->has('new_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
 
                        <div class="form-group">
                            <label for="new-password-confirm" class="col-md-4 control-label">Confirm New Password</label>
 
                            <div class="col-md-6">
                                <input id="new-password-confirm" type="password" class="form-control" name="new_password_confirmation" required>
                            </div>
                        </div>
 

                        <button  data-dismiss="modal" aria-hidden="true" class="btn btn-basic">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-info btn-fill pull-right">    Change
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
    
    <!--KEEP CREATE/EDIT MODAL OPEN IF THERE ARE VALIDATION ERRORS-->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if ({!!count($errors->addUser)!!} > 0)
                $("#addModal").modal();    
            }, false);
            // if({!!count($errors->editUser)!!} > 0)
                
            // }, false);

    </script>

    <!-- DISABLE INPUTS WHEN ON PROFILE QUICK VIEW -->
    <script type="text/javascript">
        function readOnly() {  
            $('.form-control').prop('readonly', true);
            $('.search').prop('readonly', false);
            document.getElementById('profile_gender').disabled = true;
            document.getElementById('profile_user_type').disabled = true;

            $('#password-grp').hide();
            $('#form-button-edit').hide();  
        }
    </script>

    <script>
        //CREATE USER
        $("#add-btn").click(function() {
            $('.form-control').prop('readonly', false);
            
            //MODAL
            document.getElementById('profile_gender').disabled = false;
            document.getElementById('profile_user_type').disabled = false; 
        });

        //VIEW-EDIT USER
        //PASS ID OF USER TO MODAL, MANIPULATE INPUT FIELDS, & DISPLAY USER INFO
        $(document).on("click", ".edit-btn", function () {
            var id = $(this).data('id');

            $.ajax({
                url: "getUser/" + id,
                type: 'GET',             
                data: { 'id' : id },
                success: function(response){
                    // DEBUGGING
                    console.log(response.id);

                    $('#change-pass-btn').data('id', id);

                    // SET FORM INPUTS
                    $('#profile_fname').val(response.fname);
                    $('#profile_mname').val(response.mname); 
                    $('#profile_lname').val(response.lname);

                    if (response.gender == "Male")
                        $('#profile_gender').val('0');
                    else $('#profile_gender').val('1'); //Female

                    $('#profile_cnum').val(response.cnum);
                    $('#profile_bday').val(response.bday);
                    $('#profile_username').val(response.username);
                    $('#profile_password').val(response.password);

                    if (response.user_type == "Administrator")
                        $('#profile_user_type').val('0'); 
                    else if (response.user_type == "Owner")
                        $('#profile_user_type').val('1'); 
                    else if (response.user_type == "Collector")
                        $('#profile_user_type').val('2'); 
                    else if (response.user_type == "Peddler")
                        $('#profile_user_type').val('3'); 
                    else $('#profile_user_type').val('4'); //Staff

                    // MODAL
                    $("#profileModal").modal('show'); 
                    $("#view-edit-content").show();
                    $("#delete-content").hide();
                    $("#delete-modal-footer").hide();
                    $("#password-grp").hide();
                },
                error: function(data){
                    console.log(data);
                }
            });

            //FORM
            $("#view-edit-profile").attr("action", "/create_users/" +id);
       
            //MODAL
            document.getElementById('profile_user_type').disabled = false; 
            document.getElementById('profile_gender').disabled = false;
            $('.form-control').prop('readonly', false);
            $("#delete-content").hide();
            $("#delete-modal-footer").hide();
            $('#form-button-edit').show(); 
        });

        //DELETE USER
        $(document).on("click", ".del-btn", function () {
            var id = $(this).data('id');

            //FORM
            $("#delete-profile").attr("action", "/create_users/" +id);

            //MODAL
            $(".modal-title").html = "Delete User";
            $("#view-edit-content").hide();
            $("#delete-content").show();
            $("#delete-modal-footer").show();
        }); 

        //CHANGE PASSWORD
        $(document).on("click", ".change-pass", function () {
            var id = $(this).data('id');
            //alert(id);
            //FORM
            $("#change-pass").attr("action", "/changePassword/" +id);
        }); 
    </script>
@endsection
