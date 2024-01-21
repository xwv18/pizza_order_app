<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // cart home page

    public function cartPage(){
        $carts = Cart::select('carts.*','products.name as product_name','products.price as product_price')
                ->leftJoin('products','products.id','carts.product_id')
                ->where('carts.user_id',Auth::user()->id)->get();
        // dd($carts->toArray());
        $totalPrice = 0;
        foreach($carts as $cart){
            $totalPrice += $cart->product_price * $cart->quantity;
        }
        // dd($totalPrice);

        return view('user.main.card',compact('carts','totalPrice'));
    }
}
