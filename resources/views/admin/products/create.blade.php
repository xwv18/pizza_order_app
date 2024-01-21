@extends('admin.layout.master')

@section('title', 'Product Create Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{ route('products#list') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div>
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Create New Products</h3>
                            </div>
                            <hr>
                            <form action="{{ route('get#product') }}" method="post" novalidate="novalidate"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Name</label>
                                    <input id="cc-pament" name="name" type="text" value="{{ old('name') }}"
                                        class="form-control @error('name')
                                    is-invalid
                                    @enderror"
                                        aria-required="true" aria-invalid="false" placeholder="Ender Your Pizza...">
                                    @error('name')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Category</label>
                                    <select name="category"
                                        class=" form-control @error('category')
                                    is-invalid
                                    @enderror"
                                        id="">
                                        <option value="">Choose your category</option>
                                        @foreach ($categoryData as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                        id="" cols="30" rows="3" placeholder="Enter Your Description...">{{old('description')}}</textarea>
                                    @error('description')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Image</label>
                                    <input id="cc-pament" name="image" type="file"
                                        class="form-control @error('image')
                                    is-invalid
                                    @enderror"
                                        aria-required="true" aria-invalid="false" >
                                    @error('image')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                    <input id="cc-pament" name="waitingTime" type="number" value="{{ old('waitingTime') }}"
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
                                    <input id="cc-pament" name="price" type="number" value="{{ old('price') }}"
                                        class="form-control @error('price')
                                    is-invalid
                                    @enderror"
                                        aria-required="true" aria-invalid="false" placeholder="Ender Prices...">
                                    @error('price')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>


                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">Create</span>
                                        <span id="payment-button-sending" style="display:none;">Sending…</span>
                                        <i class="fa-solid fa-circle-right"></i>
                                    </button>
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
