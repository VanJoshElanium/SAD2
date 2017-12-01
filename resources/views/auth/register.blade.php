@extends('layouts.app')

@section('content')
<div class="container">
<div class="container-fluid">
<div class="row">
                        <!-- USER ADD/EDIT FORM -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">User Profile</h4>
                                    <hr style="width: 100%; color: #d3d3d3; height: 1px;background-color:#d3d3d3; padding: 0px" />
                                </div>
                                <div class="content">

                                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                                        {{ csrf_field() }}
                                        
                                        <h5 class="pull-right usrmgmt-h5"> 
                                            Personal Details 
                                        </h5>

                                        <!-- USER NAME -->                                
                                         
                                        <div class="row"> 
                                            <div class="{{ $errors->has('fname') ? ' has-error' : '' }}">         
                                                <div class="col-md-9">    
                                                    <label>First Name</label>
                                                    <input type="text" id="fname" class="form-control"  name="fname" value="{{ old('fname') }}" required> @if ($errors->has('fname'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('fname') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="{{ $errors->has('mname') ? ' has-error' : '' }}"> 
                                                <div class="col-md-3"> 
                                                    <label>M.I.</label>
                                                    <input type="text" id="mname" class="form-control" required name="mname" value="{{ old('mname') }}">
                                                    @if ($errors->has('mname'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('mname') }}</strong>
                                                        </span>
                                                    @endif                   
                                               </div>    
                                            </div>
                                        </div>
                                            
                                        <div class="row">
                                            <div class="{{ $errors->has('lname') ? ' has-error' : '' }}">
                                                <div class="col-md-12">              
                                                    <label>Last Name</label>
                                                        <input type="text" id="lname" class="form-control" required name="lname" value="{{ old('lname') }}"> @if ($errors->has('lname'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('fname') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div> 
                                        </div>

                                        <!-- BIRTHDAY AND GENDER -->
                                        <div class="other-details">
                                            <div class="row">
                                                <div class="{{ $errors->has('gender') ? ' has-error' : '' }}">
                                                    <div class="col-md-5">       
                                                      <label for="sel1">Gender</label>
                                                      <select class="form-control" name="gender" required id="gender">
                                                        <option data-hidden="true" value=""></option>
                                                        <option value="0" @if (old('gender') == '0') selected="selected" @endif>Male</option>
                                                        <option value="1" @if (old('gender') == '1') selected="selected" @endif>Female</option>
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
                                                        <input name="bday"  id="bday"class="form-control" type="text" onfocus="(this.type='date')" required onblur="if(!this.value)this.type='text'" value="{{ old('bday') }}">
                                                    
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
                                        <div class="row">
                                            <div class="{{ $errors->has('cnum') ? ' has-error' : '' }}">
                                                <div class="col-md-12">  
                                                    <label>Contact Number</label>
                                                    <input type="number" required name="cnum" id="cnum" class="form-control" value="{{ old('cnum') }}">
                                                
                                                    @if ($errors->has('cnum'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('cnum') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <h5 class="pull-right"> In-System Details </h5>
                                        <!-- IN-SYSTEM USER DETAILS -->
                                        <div class="in-sys-details">
                                            <div class="row">
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
                                            <div class="row">
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

                                            <div class="row">
                                                <div class="{{ $errors->has('user_type') ? ' has-error' : '' }}">
                                                    <div class="col-md-5">
                                                        <label>User Type</label>
                                                        <select class="form-control" id="user_type" required name="user_type" value="{{ old('user_type') }}">
                                                            <option data-hidden="true" value=""></option>
                                                            <option value="0" @if (old('user_type') == '0') selected="selected" @endif>Administrator</option>
                                                            <option value="1" @if (old('user_type') == '1') selected="selected" @endif>Owner</option>
                                                            <option value="2" @if (old('user_type') == '2') selected="selected" @endif>Collector</option>
                                                            <option value="3" @if (old('user_type') == '3') selected="selected" @endif>Permanent Staff</option>
                                                            <option value="4" @if (old('user_type') == '4') selected="selected" @endif>Temporary Staff</option>
                                                        </select>
                                                        @if ($errors->has('user_type'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('user_type') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                    
                                                </div>

                                                <div class="col-md-7">
                                                    <!-- SUBMIT BUTTON -->
                                                    <button type="submit" class="btn btn-info btn-fill pull-right" id="form-button" style="margin-top: 12%">Do Something
                                                    </button>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>      
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- TABLE OF USERS 
                        <div class="col-md-8">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">P&P MIS Users</h4>
                                    <p class="category">All users of the P&P Management Information System </p>
                                </div>
                                <div class="content table-responsive table-full-width">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Salary</th>
                                            <th>Country</th>
                                            <th>City</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Dakota Rice</td>
                                                <td>$36,738</td>
                                                <td>Niger</td>
                                                <td>Oud-Turnhout</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Minerva Hooper</td>
                                                <td>$23,789</td>
                                                <td>Curaçao</td>
                                                <td>Sinaai-Waas</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Sage Rodriguez</td>
                                                <td>$56,142</td>
                                                <td>Netherlands</td>
                                                <td>Baileux</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Philip Chaney</td>
                                                <td>$38,735</td>
                                                <td>Korea, South</td>
                                                <td>Overland Park</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Doris Greene</td>
                                                <td>$63,542</td>
                                                <td>Malawi</td>
                                                <td>Feldkirchen in Kärnten</td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>Mason Porter</td>
                                                <td>$78,615</td>
                                                <td>Chile</td>
                                                <td>Gloucester</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>-->
</div>
</div>
</div>
@endsection
