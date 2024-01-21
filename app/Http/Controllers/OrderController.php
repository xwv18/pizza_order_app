<?php


namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderList;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // admin order list
    public function orderList(){
        $orders = Order::select('orders.*','users.name as user_name')
        ->leftJoin('users','users.id','orders.user_id')
        ->orderBy('created_at','desc')
        ->get();
        // dd($orders);
        return view('admin.order.list',compact('orders'));
    }

    // order status
    public function orderStatus(Request $request){
        // dd($request->all());
        // $orderRequest = $request->status == null ? "" : $request->status;
        // logger($orderRequest);

        // ->orWhere('orders.status',$request->status)
        //  ->get();
        $orders = Order::select('orders.*','users.name as user_name')
        ->leftJoin('users','users.id','orders.user_id')
        ->orderBy('created_at','desc');

        if($request->orderStatus == null){
            $orders = $orders->get();
        }else{
            $orders = $orders->where('orders.status',$request->orderStatus)->get();
        }
        // dd($request->orderStatus);
        return view('admin.order.list',compact('orders'));
    }


    //order change status

    public function orderChangeStatus(Request $request){
        // logger($request->all());
        Order::where('id',$request->orderId)->update([
            'status'=> $request->status
        ]);

        $orders = Order::select('orders.*','users.name as user_name')
        ->leftJoin('users','users.id','orders.user_id')
        ->orderBy('created_at','desc')
        ->get();

        return view('admin.order.list',compact('orders'));
    }

    //order list info
    public function orderListInfo($orderCode){
        $order = Order::where('order_code',$orderCode)->first();
        $orderList = OrderList::select('order_lists.*','users.name as user_name','products.name as product_name','products.image as product_image','users.email as user_email')
                    ->leftJoin('users','users.id','order_lists.user_id')
                    ->leftJoin('products','products.id','order_lists.product_id')
                    ->where('order_code',$orderCode)
                    ->get();

        // dd($orderList->toArray());
        return view('admin.order.productList',compact('orderList','order'));
    }

    //order list delete
    public function orderListDelete($id)
    {
        Order::where('id', $id)->delete();
        return redirect()->route('admin#orderList');
    }



}
