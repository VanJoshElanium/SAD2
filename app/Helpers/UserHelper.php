<?php
namespace App\Helpers;

use App\User;
class UserHelper
{
  public static function getUser($id)
  {
    //$users = User::all();
    //$user_id = $_GET['id'];
    $usrdata = User::where('id' , '=', $id)->value('fname');
    return $usrdata;
  }
}