<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function addUser(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        $result = $user->save();

        if($result){
            return ["result" => "Data saved!"];
        }else{
            return ["result" => "Data not saved!"];
        }
    }

    public function getUser($id=null)
    {
        if($id){
            $user = User::find($id);
        }else{
            $user = User::all();
        }

        return $user;    
    }

    public function updateUser(Request $request)
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        $result = $user->save();
        if($result){
            return ["result" => "User updated successfully!"];
        }else {
            return ["result" => "User not updated!"];
        }
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $result = $user->delete();

        if($result){
            return ["result" => "User deleted successfully!"];
        }else {
            return ["result" => "User not deleted!"];
        }

    }
}
