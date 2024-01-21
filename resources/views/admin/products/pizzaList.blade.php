@extends('admin.layout.master')

@section('title', 'Product List Page')

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
                                    <h2 class="title-1">Product List</h2>

                                </div>
                            </div>
                            <div class="table-data__tool-right">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <a href="{{ route('product#create') }}"><i class="zmdi zmdi-plus"></i>add product</a>
                                </button>
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    CSV download
                                </button>
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
                                <h4 class="text-secondary">Total - {{ $products->total() }}</h4>
                            </div>
                            <div class="col-3 offset-6">
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
                            </div>

                        </div>


                        @if (count($products) != 0)
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Category</th>
                                            <th>Waiting Time</th>
                                            {{-- <th>Created Date</th> --}}
                                            <th>View Count</th>
                                            <th style="margin: 0px;"></th>
                                        </tr>
                                    </thead>
                                    <tr class="spacer"></tr>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr class="tr-shadow">
                                                <td><img src="{{asset('storage/'.$product->image)}}" style="width: 100px;" class=" img-thumbnail shadow-sm"></td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->price }} Ks</td>
                                                <td>{{ $product->category_name }}</td>
                                                <td>{{ $product->waiting_time }} minus</td>
                                                {{-- <td>{{ $product->created_at->format('j-F-Y') }}</td> --}}
                                                <td>{{$product->view_count}}</td>
                                                <td style="margin: 0px;">
                                                    <div class="table-data-feature">
                                                        <a href="{{route('product#detail',$product->id)}}">
                                                            <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="view">
                                                            <i class="fa-regular fa-eye"></i>
                                                        </button>
                                                        </a>
                                                        <a href="{{route('product#edit',$product->id)}}">
                                                            <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                        </a>
                                                        <a href="{{route('delete#product', $product->id)}}">
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
                    {{ $products->links() }}
                </div>
           </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
