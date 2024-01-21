@extends('admin.layout.master')

@section('title', 'User Order List')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- DATA TABLE -->
                        <div class="table-data__tool">
                            <div class="table-data__tool-left">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Order List</h2>

                                </div>
                            </div>

                        </div>

                        @if (session('deleteSuccess'))
                            <div class=" col-4 offset-8">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ session('deleteSuccess') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            </div>
                        @endif

                        <div class="row my-5">
                            <div class="col-3">
                                <h4 class="text-secondary">Total - {{ count($orders) }} </h4>
                            </div>
                            {{-- <div class="col-3 offset-6">
                                <form action="{{ route('products#list') }}" method="get">
                                    @csrf
                                    <div class="d-flex">
                                        <input type="text" name="searchKey" class="form-control" placeholder="Search..."
                                            value="{{ request('searchKey') }}">
                                        <button class="btn bg-primary text-white" type="submit">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                    </div>
                                </form>
                            </div> --}}
                            <div class="col-4 offset-5 d-flex">
                                <form action="{{ route('order#status') }}" method="get">
                                    @csrf
                                    <div class="d-flex">
                                        <div class="mx-3">
                                            Order Status
                                        </div>
                                        <select name="orderStatus" class=" form-control-sm w-1" id="orderStatus">
                                            <option value="">All
                                            </option>
                                            <option value="0" @if (request('orderStatus') == '0') selected @endif>Pending
                                            </option>
                                            <option value="1" @if (request('orderStatus') == '1') selected @endif>Success
                                            </option>
                                            <option value="2" @if (request('orderStatus') == '2') selected @endif>Reject
                                            </option>
                                        </select>
                                        <button class="btn btn-primary btn-sm">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>


                        @if (count($orders) != 0)
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2">
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>User Name</th>
                                            <th>Order Date</th>
                                            <th>Order Code</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tr class="spacer"></tr>
                                    <tbody id="listdata">
                                        @foreach ($orders as $order)
                                            <tr class="tr-shadow">
                                                <input type="hidden" class="orderId" value="{{ $order->id }}">
                                                <td>{{ $order->user_id }}</td>
                                                <td>{{ $order->user_name }}</td>
                                                <td>{{ $order->created_at->format('j-F-Y') }}</td>
                                                <td><a
                                                        href="{{ route('orderList#info', $order->order_code) }}">{{ $order->order_code }}</a>
                                                </td>
                                                <td class="price">{{ $order->total_price }} Ks</td>
                                                <td>
                                                    <select name="status" class=" form-control statusChange"
                                                        id="">
                                                        <option value="0"
                                                            @if ($order->status == 0) selected @endif>Pending
                                                        </option>
                                                        <option value="1"
                                                            @if ($order->status == 1) selected @endif>Success
                                                        </option>
                                                        <option value="2"
                                                            @if ($order->status == 2) selected @endif>Reject
                                                        </option>
                                                    </select>
                                                </td>

                                                <td>
                                                    <div class="table-data-feature">
                                                        <a href="{{ route('orderList#delete', $order->id) }}">
                                                            <button class="item" data-toggle="tooltip"
                                                                data-placement="top" title="Delete">
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </button>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="spacer"></tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <h3 class=" text-secondary text-center mt-5">There is no category here !</h3>
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
        $(document).ready(function() {
            // $('#orderStatus').change(function() {
            //     $orderStatus = $('#orderStatus').val();
            //     console.log($orderStatus);

            //     $.ajax({
            //         type: 'get',
            //         url: 'http://localhost/pizza_hunt/public/admin/order/ajax/status',
            //         data: {
            //             'status': $orderStatus,
            //         },
            //         dataType: 'json',
            //         success: function(response) {
            //             console.log(response);
            //             $list = '';
            //             for ($i = 0; $i < response.length; $i++) {
            //                 // console.log(`${response[$i].name}`);
            //                 console.log(response[$i].created_at);

            //                 $newDate = new Date(response[$i].created_at);

            //                 console.log($newDate);

            //                 $month = ['January', 'February', 'March', 'April', 'May', 'June',
            //                     'July', 'August', 'Septmber', 'October', 'November',
            //                     'December'
            //                 ];

            //                 $finalDate = $newDate.getDate() + "-" + $month[$newDate
            //                 .getMonth()] + "-" + $newDate.getFullYear();

            //                 if (response[$i].status == 0) {
            //                     $statusMessage = `
        //                     <select class=" form-control" id="">
        //                         <option value="0" selected>Pending</option>
        //                         <option value="1">Success</option>
        //                         <option value="2">Reject</option>
        //                     </select>
        //                     `;

            //                 } else if (response[$i].status == 1) {
            //                     $statusMessage = `
        //                     <select class=" form-control" id="">
        //                         <option value="0" >Pending</option>
        //                         <option value="1" selected>Success</option>
        //                         <option value="2">Reject</option>
        //                     </select>
        //                     `;

            //                 } else if (response[$i].status == 2) {
            //                     $statusMessage = `
        //                     <select class=" form-control" id="">
        //                         <option value="0" >Pending</option>
        //                         <option value="1" >Success</option>
        //                         <option value="2" selected>Reject</option>
        //                     </select>
        //                     `;

            //                 }

            //                 $list += `
        //                     <tr class="tr-shadow">
        //                         <td>${ response[$i].user_id }</td>
        //                         <td>${ response[$i].user_name }</td>
        //                         <td>${ $finalDate }</td>
        //                         <td>${ response[$i].order_code }</td>
        //                         <td>${ response[$i].total_price }</td>
        //                         <td>${$statusMessage}</td>

        //                         <td>
        //                             <div class="table-data-feature">
        //                                 <a href="">
        //                                     <button class="item" data-toggle="tooltip"
        //                                         data-placement="top" title="view">
        //                                         <i class="fa-regular fa-eye"></i>
        //                                     </button>
        //                                 </a>
        //                                 <a href="">
        //                                     <button class="item" data-toggle="tooltip"
        //                                         data-placement="top" title="Edit">
        //                                         <i class="zmdi zmdi-edit"></i>
        //                                     </button>
        //                                 </a>
        //                                 <a href="">
        //                                     <button class="item" data-toggle="tooltip"
        //                                         data-placement="top" title="Delete">
        //                                         <i class="zmdi zmdi-delete"></i>
        //                                     </button>
        //                                 </a>
        //                                 <button class="item" data-toggle="tooltip"
        //                                     data-placement="top" title="More">
        //                                     <i class="zmdi zmdi-more"></i>
        //                                 </button>
        //                             </div>
        //                         </td>
        //                     </tr>
        //                     <tr class="spacer"></tr>
        //                 `;

            //             }
            //             // console.log($list);
            //             $('#listdata').html($list);

            //         }
            //     });

            // });

            //Change status
            $('.statusChange').change(function() {
                $parentNote = $(this).parents('tr');
                $currentStatus = $(this).val();
                $orderId = $parentNote.find('.orderId').val();
                $data = {
                    'status': $currentStatus,
                    'orderId': $orderId
                };
                console.log($data);

                $.ajax({
                    type: 'get',
                    url: 'http://localhost/pizza_hunt/public/admin/order/ajax/change/status',
                    data: $data,
                    dataType: 'json',
                });

            });
        });
    </script>
@endsection
