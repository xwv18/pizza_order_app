<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderList;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    // data list
    public function dataList(Request $request)
    {
        // logger($request->status);
        if ($request->status == 'desc') {
            $data = Product::orderBy('created_at', 'desc')->get();
        } else {
            $data = Product::orderBy('created_at', 'asc')->get();
        }

        return response()->json($data, 200);
    }

    // return pizza list
    public function  addToCart(Request $request)
    {
        $data = $this->getOrderData($request);
        Cart::create($data);
        $response = [
            'message' => 'Add To Cart Complete',
            'status' => 'success',
        ];
        return response()->json($response, 200);
        // logger($data);
        // return $data;
    }

    // order
    public function order(Request $request)
    {
        // logger($request->all());
        $totalPrice = 0;
        foreach ($request->all() as $item) {
            $data =OrderList::create([
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'total_price' => $item['total_price'],
                'order_code' => $item['order_code'],
            ]);
            $totalPrice += $data->total_price;
        };

        // logger($totalPrice+3000);

        Cart::where('user_id',Auth::user()->id)->delete();


        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $data->order_code,
            'total_price' => $totalPrice + 3000,
        ]);


        return response()->json([
            'message' => 'order complete',
            'status' => 'success',
        ], 200);
    }

    // clear cart
    public function clearCart(){
        Cart::where('user_id',Auth::user()->id)->delete();
    }

    // clear current product
    public function clearCurrentProduct(Request $request){

        Cart::where('user_id',Auth::user()->id)
                ->where('product_id',$request->productId)
                ->where('id',$request->id)
                ->delete();
    }

    //view count
    public function viewCount (Request $request){
        $product = Product::where('id',$request->product_id)->first();
        $viewCount = [
            'view_count' => $product->view_count +1
        ];
        Product::where('id',$request->product_id)->update($viewCount);
    }

    // private function
    private function getOrderData($request)
    {
        return [
            'user_id' => $request->userId,
            'product_id' => $request->pizzaId,
            'quantity' => $request->count,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
