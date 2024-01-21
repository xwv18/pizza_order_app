@extends('admin.layout.master')

@section('title', 'Product List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-5">
                                <div class="card my-4">
                                    <div class="card-body">
                                        <div class="row text-center " style="border-bottom: 1px solid black;">
                                            <h4 class="my-3">Order Info</h4>
                                        </div>
                                        <div class="row my-2">
                                            <i class=" col-1 fa-solid fa-user"></i>
                                            <h5 class="col-4">User ID</h5>
                                            <div class="col">{{$orderList[0]->user_id}}</div>
                                        </div>
                                        <div class="row my-2">
                                            <i class="col-1 fa-solid fa-signature"></i>
                                            <h5 class="col-4">User Name</h5>
                                            <div class="col">{{$orderList[0]->user_name}}</div>
                                        </div>
                                        <div class="row my-2">
                                            <i class="col-1 fa-solid fa-envelope"></i>
                                            <h5 class="col-4">User Email</h5>
                                            <div class="col">{{$orderList[0]->user_email}}</div>
                                        </div>
                                        <div class="row my-2">
                                            <i class="col-1 fa-solid fa-barcode"></i>
                                            <h5 class="col-4">Order Code</h5>
                                            <div class="col">{{$orderList[0]->order_code}}</div>
                                        </div>
                                        <div class="row my-2">
                                            <i class="col-1 fa-solid fa-money-bill-1-wave"></i>
                                            <h5 class="col-4">Total Price</h5>
                                            <div class="col">{{$order->total_price}} Ks + <small class=" text-danger">include delivery fee</small> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (count($orderList) != 0)
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Product image</th>
                                            <th>product name</th>
                                            <th>Order Date</th>
                                            <th>Quantity</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tr class="spacer"></tr>
                                    <tbody id="listdata">
                                        @foreach ($orderList as $list)
                                        <tr class="tr-shadow">
                                            <td>{{ $list->id }}</td>
                                            <td><img src="{{asset('storage/'.$list->product_image)}}" class=" img-thumbnail" style="width:80px;"></td>
                                            <td>{{ $list->product_name }}</td>
                                            <td>{{ $list->created_at->format('j-F-Y')}}</td>
                                            <td>{{ $list->quantity}}</td>
                                            <td class="price">{{ $list->total_price }} Ks</td>

                                        <tr class="spacer"></tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <h3 class=" text-secondary text-center mt-5">There is no order here !</h3>
                        @endif
                        <!-- END DATA TABLE -->
                    </div>
                </div>
                <div class="">
                    {{-- {{ $orders->links() }} --}}
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
@section('scriptSection')
    <script>

    </script>
@endsection
