@extends('admin.layout.master')

@section('title', 'Detail Product Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="ms-5">
                                <i class="fa-solid fa-arrow-left text-dark" onclick=" history.back()"></i>
                            </div>
                            <div class="card-title">
                                <h3 class="text-center title-2">Product Detail</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-3 offset-1 shadow-sm">
                                    <img src="{{ asset('storage/'.$product->image) }}" class="img-thumbnail" />
                                </div>
                                <div class="col-6 mx-4">
                                    <div class="text-secondary my-3">
                                        <i class="fa-solid fa-pizza-slice me-3"></i>
                                        {{$product->name}}
                                    </div>
                                    <div class="text-secondary my-3">
                                        <i class="fa-solid fa-money-bill-1 me-3"></i>
                                        {{$product->price}} Kyats
                                    </div>
                                    <div class="text-secondary my-3">
                                        <i class="fa-solid fa-file-lines me-3"></i>
                                        {{$product->description}}
                                    </div>
                                    <div class="text-secondary my-3">
                                        <i class="fa-solid fa-list-ol me-3"></i>
                                        {{$product->category_name}}
                                    </div>
                                    <div class="text-secondary my-3">
                                        <i class="fa-solid fa-clock me-3"></i>
                                        {{$product->waiting_time}} minus
                                    </div>
                                    <div class="text-secondary my-3">
                                        <i class="fa-solid fa-eye me-3"></i>
                                        {{$product->view_count}}
                                    </div>
                                    <div class="text-secondary my-3">
                                        <i class="fa-solid fa-user-clock me-3"></i>
                                        {{$product->created_at}}
                                    </div>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-3 offset-9 ">
                                    <a href="{{route('product#edit',$product->id)}}">
                                        <i class="fa-solid fa-pen-to-square me-2"></i> Edit Product
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
