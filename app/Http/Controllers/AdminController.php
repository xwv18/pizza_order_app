<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // change password

    public function passwordChangePage(){
        return view('admin.account.changePassword');
    }

    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);
        $currentUserID = Auth::user()->id;
        $user = User::select('password')->where('id',$currentUserID)->first();
        $dbHashValue = $user->password;

        if(Hash::check($request->oldPassword, $dbHashValue)){
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);
            Auth::logout();
            return redirect()->route('auth#loginPage');
        }
        return back()->with(['notMatch' => 'The Old Password NOt Matcch. Try Again !']);


        // $hashValue = Hash::make('admin');
        // if(Hash::check('admin', $hashValue)){
        //     dd('password same');
        // }else{
        //     dd('incorrect');
        // }
    }

    // account
    // Info
    public function accountInfo(){
        return view('admin.account.details');
    }
    // edit
    public function accountEdit(){
        return view('admin.account.edit');
    }
    // update
    public function accountUpdate(Request $request){
        $data = $this->accountRequestData($request);
        $id = Auth::user()->id;
        if($request->hasFile('image')){
            $oldImage = User::select('image')->where('id',$id)->first();
            $oldImage = $oldImage->image;
            if($oldImage != null){
                Storage::delete('public/'.$oldImage);
            }

            $imageName = uniqid()."_".$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$imageName);
            $data['image'] = $imageName;
        }
        User::where('id',$id)->update($data);
        return redirect()->route('account#info');
        // dd('success update ');
    }

    // admin list
    public function adminList(){
        $admins = User::when(request('searchKey'),function($value){
            $searchKey = request('searchKey');
            $value->orWhere('name','like','%'.$searchKey.'%')
            ->orWhere('email','like','%'.$searchKey.'%')
            ->orWhere('gender','like','%'.$searchKey.'%')
            ->orWhere('phone','like','%'.$searchKey.'%')
            ->orWhere('address','like','%'.$searchKey.'%');
        })
        ->where('role','admin')
        ->paginate(2);
        $admins->appends(request()->all());
        // dd($admin->toArray());
        return view('admin.account.list',compact('admins'));
    }

    // account delete
    public function adminDelete($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Admin Account Deleted...']);
    }

    // change role

    public function roleChange($id){
        $account = User::where('id',$id)->first();
        // dd($account);
        return view('admin.account.roleChange',compact('account'));
    }

    // role change update
    public function roleChangeUpdate($id, Request $request){
        $data = $this->roleChangeData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list');
    }

    // private function
    // password Vlidation Check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
        'oldPassword' => 'required|min:6',
        'newPassword' => 'required|min:6',
        'confirmPassword' => 'required|min:6|same:newPassword',
    ])->validate();

    }

    private function accountRequestData($request){
        return [
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'image' => $request->image,
        'created_at' => Carbon::now(),
        ];
    }

    private function roleChangeData($request){
        return [
            'role' => $request->role
        ];
    }


}
