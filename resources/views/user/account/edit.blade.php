@extends('user.layout.master')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Edit Your Account Info</h3>
                            </div>
                            <hr>
                            <form action="{{ route('account#update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        @if (Auth::user()->image == null)
                                            @if (Auth::user()->gender == 'male')
                                                <img class="img-thumbnail shadow-sm  col-8" src="{{ asset('image/default_male_user_image.png') }}"
                                                    alt="">
                                            @else
                                                <img class="img-thumbnail shadow-sm  col-8" src="{{ asset('image/default_female_user_image.png') }}"
                                                    alt="">
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                class="img-thumbnail shadow-sm w-2 position-relative" />
                                        @endif
                                        <div class="my-4">
                                            <input type="file" name="image" id="image" class="form-control"
                                                multiple>
                                        </div>

                                    </div>

                                    <div class="col-6 ms-3">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input class="au-input au-input--full form-control" type="text" name="name"
                                                placeholder="Username" value="{{ old('name', Auth::user()->name) }}">
                                        </div>
                                        @error('name')
                                            <small class=" text-danger">{{ $message }}</small>
                                        @enderror

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input class="au-input au-input--full form-control" type="email" name="email"
                                                placeholder="Email" value="{{ old('email', Auth::user()->email) }}">
                                        </div>
                                        @error('email')
                                            <small class=" text-danger">{{ $message }}</small>
                                        @enderror

                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input class="au-input au-input--full form-control" type="number" name="phone"
                                                placeholder="09xxxxx" value="{{ old('phone', Auth::user()->phone) }}">
                                        </div>
                                        @error('phone')
                                            <small class=" text-danger">{{ $message }}</small>
                                        @enderror

                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select name="gender" id="" class="form-control">
                                                <option value="male" @if (Auth::user()->gender == 'male') selected @endif>
                                                    Male</option>
                                                <option value="female" @if (Auth::user()->gender == 'female') selected @endif>
                                                    Female</option>
                                            </select>
                                        </div>
                                        @error('gender')
                                            <small class=" text-danger">{{ $message }}</small>
                                        @enderror

                                        <div class="form-group">
                                            <label>Address</label>
                                            <input class="au-input au-input--full form-control" type="text" name="address"
                                                placeholder="Address" value="{{ old('address', Auth::user()->address) }}">
                                        </div>
                                        @error('address')
                                            <small class=" text-danger">{{ $message }}</small>
                                        @enderror

                                        <div class="form-group">
                                            <label>Date</label>
                                            <input class="au-input au-input--full form-control" type="text" name="created_at"
                                                value="{{ old('created_at', Auth::user()->created_at) }}">
                                        </div>
                                        @error('address')
                                            <small class=" text-danger">{{ $message }}</small>
                                        @enderror

                                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                            <span id="payment-button-amount">Update</span>

                                        </button>
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
