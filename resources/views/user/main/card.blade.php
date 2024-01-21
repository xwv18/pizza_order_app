@extends('user.layout.master')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($carts as $cart)
                            <tr>
                                {{-- <input type="hidden" id="pizzaPrice" value="{{ $cart->product_price }}"> --}}
                                <td class="align-middle">
                                    <img src="img/product-1.jpg" alt="" style="width: 50px;">
                                    {{ $cart->product_name }}
                                    <input type="hidden" class="id" value="{{$cart->id}}">
                                    <input type="hidden" class="productId" value="{{$cart->product_id}}">
                                    <input type="hidden" class="userId" value="{{$cart->user_id}}">
                                </td>
                                <td  class="align-middle" id="pizzaPrice">{{ $cart->product_price }} Ks</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mr-3" style="width: 130px;">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-primary minus-btn btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>

                                        <input type="text" class="form-control bg-secondary border-0 text-center"
                                            value="{{ $cart->quantity }}" min="1" max="100" id="orderCount">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-primary  plus-btn btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle" id="total">{{ $cart->product_price * $cart->quantity }} Ks</td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"><i
                                            class="fa fa-times"></i></button></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="allTotalPrice">{{ $totalPrice }} Ks</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium"> 3000 Ks </h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalPrice">{{ $totalPrice + 3000 }} Ks</h5>
                        </div>
                        <button id="orderBtn" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
                        <button id="clearBtn" class="btn btn-block btn-secondary font-weight-bold my-3 py-3">Clear Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
@section('scriptSource')
    <script>
        $(document).ready(function() {
            // $('.fa-plus').click(function(e) {
            //     console.log($(e.target));
            // });

            // plus button
            $('.btn-plus').click(function() {
                $parentNode = $(this).parents('tr');
                // $price = $parentNode.find('#pizzaPrice').val();  (input hidden type)
                $price = Number($parentNode.find('#pizzaPrice').html().replace('Ks',''));
                $orderCount = Number($parentNode.find('#orderCount').val());
                $total = $price * $orderCount;
                $parentNode.find('#total').html($total + " Ks");
                // console.log($orderCount);
                // console.log($price);
                // console.log($total);

                //total All result
               summaryCaculation();
            });

            // minus button
            $('.btn-minus').click(function() {
                $parentNode = $(this).parents('tr');
                // $price = $parentNode.find('#pizzaPrice').val();
                $price = Number($parentNode.find('#pizzaPrice').html().replace('Ks',''));
                $orderCount = Number($parentNode.find('#orderCount').val());

                $total = $price * $orderCount;
                $parentNode.find('#total').html($total + " Ks");
                // console.log($orderCount);
                // console.log($price);
                // console.log($total);
                //total All result
               summaryCaculation();
            });

            // remove button
            $('.btnRemove').click(function(){
                $parentNode = $(this).parents('tr');
                $parentNode.remove();
                $id = $parentNode.find('.id').val();
                $productId = $parentNode.find('.productId').val();
                $userId = $parentNode.find('.userId').val();

                $.ajax({
                    type : 'get',
                    url : 'http://localhost/pizza_hunt/public/user/ajax/clear/current/product',
                    data : {'productId' : $productId, 'id' : $id},
                    dataType : 'json',

                });

               summaryCaculation();

            });

            $('#orderBtn').click(function(){

                $orderList = [];

                $random = Math.floor(Math.random() * 100000000001);

                $('#dataTable tbody tr').each(function(index, row){
                    $orderList.push({
                        'user_id' : $(row).find('.userId').val(),
                        'product_id' : $(row).find('.productId').val(),
                        'quantity' : $(row).find('#orderCount').val(),
                        'total_price' : Number($(row).find('#total').text().replace('Ks','')),
                        'order_code' : 'POS' +$random,
                    });
                });
                console.log($orderList);

                $.ajax({
                    type : 'get',
                    url : 'http://localhost/pizza_hunt/public/user/ajax/order',
                    data : Object.assign({},$orderList),
                    dataType : 'json',
                    success : function(response){
                        if(response.status == 'success'){
                                window.location.href = "http://localhost/pizza_hunt/public/user/home";
                            }
                    }
                });
            });

            $('#clearBtn').click(function(){
                $('#dataTable tbody tr').remove();
                $('#allTotalPrice').html('0 Ks');
                $('#finalPrice').html('3000 Ks');


                $.ajax({
                    type : 'get',
                    url : 'http://localhost/pizza_hunt/public/user/ajax/clear/cart',
                    dataType : 'json',

                });
            });

            function summaryCaculation(){
                $totalPrice = 0;
                $('#dataTable tbody tr').each(function(index, row){
                    $totalPrice += Number($(row).find('#total').text().replace(' Ks', ' '));
                });
                $('#allTotalPrice').html(`${$totalPrice} Ks`);
                $('#finalPrice').html(`${$totalPrice + 3000} Ks`);
            }


        })
    </script>
@endsection
