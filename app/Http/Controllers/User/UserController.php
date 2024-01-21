<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // user home page
    public function home(){
        $pizza = Product::orderBy('created_at','desc')->get();
        $categories = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        // dd($cart);
        return view('user.main.home',compact('pizza','categories','cart','history'));
    }

    // password change
    public function passwordChangePage(){
        return view('user.account.changePassword');
    }

    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);
        $currentUserID = Auth::user()->id;
        $user = User::select('password')->where('id',$currentUserID)->first();
        $dbHashValue = $user->password;
        if(Hash::check($request->oldPassword,$dbHashValue)){
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id',Auth::user()->id)->update($data);
            Auth::logout();
            return redirect()->route('auth#loginPage');
        }
        return back()->with(['notMatch' => 'The Old Password NOt Matcch. Try Again !']);

    }

    // account detail
    public function accountInfo(){
        return view('user.account.details');
    }

    // account edit
    public function accountEdit(){
        return view('user.account.edit');
    }

    // account update
    public function accountUpdate(Request $request){
        $data = $this->accountRequestData($request);
        $id = Auth::user()->id;
        if($request->hasFile('image')){
            $oldImage = User::select('image')->where('id',$id)->first();
            $oldImage = $oldImage->image;
            if($oldImage != null){
                Storage::delete(['public/'.$oldImage]);
            }
            $imageNmae = uniqid()."_".$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$imageNmae);
            $data['image'] = $imageNmae;
        }
        User::where('id',$id)->update($data);
        return redirect()->route('account#info');
    }

    // category filter
    public function categoryFilter($categoryId){
        $pizza = Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
        $categories = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','categories','cart','history'));
    }

    // pizza detail
    public function pizzaDetail($id){
        $pizza = Product::where('id',$id)->first();
        // $categories = Category::get();
        return view('user.main.detail',compact('pizza'));
    }

    // order history
    public function history(){
        $orders = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate('3');
        return view('user.main.history',compact('orders'));
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

    // get data
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
}
