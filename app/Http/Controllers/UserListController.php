<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserListController extends Controller
{
    // user list
    public function userList(){
        $users = User::where('role','user')->paginate(3);
        // dd($users);
        $searchUser = User::when(request('searchKey'),function($query){
            $searchKey = request('searchKey');
            $query->where('name','like','%'.$searchKey.'%');

        }) ->paginate(3);;
        // $searchUser->append(request()->all());
        return view('admin.user.list',compact('users','searchUser'));
    }

    //user role change
    public function userRoleChange(Request $request){
        // $users = User::where('role','user')->get();
        User::where('id',$request->id)->update([
            'role' => $request->role
        ]);
        return view('admin.user.list',compact('users'));
    }

    //user list delete
    public function userListDelete($id)
    {
        User::where('id', $id)->delete();
        return redirect()->route('user#list');
    }
}


