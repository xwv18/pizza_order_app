@extends('admin.layout.master')

@section('title', 'Admin Role Change Page')

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
                                <h3 class="text-center title-2">Change Role</h3>
                            </div>
                            <hr>
                            <form action="{{ route('role#update',$account->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        @if ($account->image == null)
                                            @if ($account->gender == 'male')
                                                <img class="img-thumbnail shadow-sm  col-8" src="{{ asset('image/default_male_user_image.png') }}"
                                                    alt="">
                                            @else
                                                <img class="img-thumbnail shadow-sm  col-8" src="{{ asset('image/default_female_user_image.png') }}"
                                                    alt="">
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/' . $account->image) }}"
                                                class="img-thumbnail shadow-sm w-2 position-relative" />
                                        @endif

                                    </div>

                                    <div class="col-6 ms-3">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input disabled class="au-input au-input--full" type="text" name="name"
                                                placeholder="Username" value="{{ old('name', $account->name) }}">
                                        </div>


                                        <div class="form-group">
                                            <label>Role</label>
                                            <select name="role" id="" class="form-control">
                                                <option value="admin" @if ($account->role == 'admin') selected @endif>
                                                    Admin</option>
                                                <option value="user" @if ($account->role == 'user') selected @endif>
                                                    User</option>
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label>Email</label>
                                            <input disabled class="au-input au-input--full" type="email" name="email"
                                                placeholder="Email" value="{{ old('email', $account->email) }}">
                                        </div>


                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input disabled class="au-input au-input--full" type="number" name="phone"
                                                placeholder="09xxxxx" value="{{ old('phone', $account->phone) }}">
                                        </div>



                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select disabled name="gender" id="" class="form-control">
                                                <option value="male" @if ($account->gender == 'male') selected @endif>
                                                    Male</option>
                                                <option value="female" @if ($account->gender == 'female') selected @endif>
                                                    Female</option>
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label>Address</label>
                                            <input disabled class="au-input au-input--full" type="text" name="address"
                                                placeholder="Address" value="{{ old('address', $account->address) }}">
                                        </div>


                                        <div class="form-group">
                                            <label>Date</label>
                                            <input disabled class="au-input au-input--full" type="text" name="created_at"
                                                value="{{ old('created_at', $account->created_at) }}">
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
