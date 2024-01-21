@extends('admin.layout.master')

@section('title', 'Admin Account Password Change Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Change Password</h3>
                            </div>
                            <hr>
                            <form action="{{ route('admin#changePassword') }}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                    <input id="cc-pament" name="oldPassword" type="password"
                                        class="form-control
                                      @if (@session('notMatch')) is-invalid @endif
                                    @error('oldPassword')
                                    is-invalid
                                    @enderror"
                                        aria-required="true" aria-invalid="false" placeholder="Ender Old Password">
                                    @error('oldPassword')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror

                                    @if (@session('notMatch'))
                                        <small class="invalid-feedback">{{ session('notMatch') }}</small>
                                    @endif

                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">New Password</label>
                                    <input id="cc-pament" name="newPassword" type="password"
                                        class="form-control @error('newPassword')
                                    is-invalid
                                    @enderror"
                                        aria-required="true" aria-invalid="false" placeholder="Ender New Password">
                                    @error('newPassword')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                                    <input id="cc-pament" name="confirmPassword" type="password"
                                        class="form-control @error('confirmPassword')
                                    is-invalid
                                    @enderror"
                                        aria-required="true" aria-invalid="false" placeholder="Ender Confirm Password">
                                    @error('confirmPassword')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>


                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">Change Password</span>
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
