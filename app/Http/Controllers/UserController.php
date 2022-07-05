<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use DB;

class UserController extends Controller
{
    public function addUser(Request $request)
    {

        $rules = array(
            'name' => 'required|min:5',
            'email' => 'required|email',
            'password' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return $validator->errors();
        }else{
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
    }

    public function getUser($id=null)
    {
        if($id){
            $user = User::find($id);
        }else{
            $user = DB::table('users')->select('name','email')->paginate(5);
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
