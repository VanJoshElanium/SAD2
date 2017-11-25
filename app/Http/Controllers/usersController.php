<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class usersController extends Controller
{
    public function index(){
    	//Creates an array called users, stores two : Ann & Harry
    	$users = [
		'0' => [
			'fname' => 'Ann',
			'lname' => 'Gaynor',
			'loc' => 'PH'
		],
		'1' => [
			'fname' => 'Harry',
			'lname' => 'Styles',
			'loc' => 'UK'
		]
	];
		//Pass the array users to Views/admin/users/blade.index.php
    	return view('admin.users.index', compact('users'));
    }

    public function create(){
    	return view('admin.users.create');
    }

    public function store(Request $request)
    {
    	User::create($request->all());
    	return 'SUCCESS';
    	//return $request->all();
    }
}
