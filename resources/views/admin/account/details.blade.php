@extends('admin.layout.master')

@section('title', 'Admin Account Detail Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Info</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-3 offset-1 shadow-sm">
                                    @if (Auth::user()->image == null)
                                        @if (Auth::user()->gender == 'male')
                                            <img class="img-thumbnail shadow-sm  col-8" src="{{ asset('image/default_male_user_image.png') }}"
                                                alt="">
                                        @else
                                            <img class="img-thumbnail shadow-sm  col-8" src="{{ asset('image/default_female_user_image.png') }}"
                                                alt="">
                                        @endif
                                    @else
                                        <img src="{{ asset('storage/' . Auth::user()->image) }}" class="img-thumbnail" />
                                    @endif
                                </div>
                                <div class="col-6 mx-4">
                                    <div class="text-secondary my-3">
                                        <i class="fa-solid fa-user me-2"></i>
                                        {{ Auth::user()->name }}
                                    </div>
                                    <div class="text-secondary my-3">
                                        <i class="fa-solid fa-envelope me-2"></i>
                                        {{ Auth::user()->email }}
                                    </div>
                                    <div class="text-secondary my-3">
                                        <i class="fa-solid fa-phone me-2"></i>
                                        {{ Auth::user()->phone }}
                                    </div>
                                    <div class="text-secondary my-3">
                                        <i class="fa-solid fa-venus-mars"></i>
                                        {{ Auth::user()->gender }}
                                    </div>
                                    <div class="text-secondary my-3">
                                        <i class="fa-solid fa-address-book me-2"></i>
                                        {{ Auth::user()->address }}
                                    </div>
                                    <div class="text-secondary my-3">
                                        <i class="fa-solid fa-user-clock me-2"></i>
                                        {{ Auth::user()->created_at }}
                                    </div>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-2 offset-9 ">
                                    <a href="{{ route('adminAccount#edit') }}">
                                        <i class="fa-solid fa-pen-to-square me-2"></i> Edit Profile
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
