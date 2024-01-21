@extends('admin.layout.master')

@section('title', 'Edit Product Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Edit Product</h3>
                            </div>
                            <hr>
                            <form action="{{route('product#update')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="productID" value="{{$product->id}}">
                                    <div class="col-4 offset-1">

                                            <img src="{{ asset('storage/'.$product->image) }}"
                                                class="img-thumbnail shadow-sm w-2 position-relative" />

                                        <div class="my-4">
                                            <input type="file" name="image" id="image" class="form-control" multiple>
                                        </div>

                                    </div>

                                    <div class="col-6 ms-3">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input class="au-input au-input--full" type="text" name="name"
                                                placeholder="Username" value="{{old('name',$product->name)}}">
                                        </div>
                                        @error('name')
                                            <small class=" text-danger">{{ $message }}</small>
                                        @enderror

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Category</label>
                                            <select name="category"
                                                class=" form-control @error('category')
                                            is-invalid
                                            @enderror"
                                                id="">
                                                <option value="">Choose your category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" @if ($product->category_id == $category->id)
                                                        selected
                                                    @endif>{{ $category->name }}</option>
                                                @endforeach
                                                @error('category')
                                                    <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Description</label>
                                            <textarea name="description"
                                                class=" form-control @error('description')
                                            is-invalid
                                            @enderror"
                                                id="" cols="30" rows="3" placeholder="Enter Your Description...">{{old('description',$product->description)}}</textarea>
                                            @error('description')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                            <input id="cc-pament" name="waitingTime" type="number" value="{{ old('waitingTime',$product->waiting_time) }}"
                                                class="form-control @error('waitingTime')
                                            is-invalid
                                            @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Waiting Time...">
                                            @error('waitingTime')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Price</label>
                                            <input id="cc-pament" name="price" type="number" value="{{ old('price',$product->price) }}"
                                                class="form-control @error('price')
                                            is-invalid
                                            @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="Ender Prices...">
                                            @error('price')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <button class="au-btn au-btn--block au-btn--green m-b-20"
                                            type="submit">Update</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
