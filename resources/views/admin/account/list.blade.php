@extends('admin.layout.master')

@section('title', 'Admin List Page')

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
                                    <h2 class="title-1">Admin List</h2>

                                </div>
                            </div>
                            {{-- <div class="table-data__tool-right">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <a href="{{ route('category#list') }}"><i class="zmdi zmdi-plus"></i>add item</a>
                                </button>
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    CSV download
                                </button>
                            </div> --}}
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
                                {{-- <h4 class="text-secondary">Total - {{ $admins->total() }}</h4> --}}
                            </div>
                            <div class="col-3 offset-6">
                                <form action="{{ route('admin#list') }}" method="get">
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


                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>image</th>
                                        <th>name</th>
                                        <th>email</th>
                                        <th>gender</th>
                                        <th>phone</th>
                                        <th>address</th>
                                        <th>role</th>
                                    </tr>
                                </thead>
                                <tr class="spacer"></tr>
                                <tbody>
                                    @foreach ($admins as $admin)
                                        <tr class="tr-shadow">
                                            <td>
                                                @if ($admin->image == null)
                                                    @if ($admin->gender == 'male')
                                                        <img class="img-thumbnail shadow-sm  col-8"
                                                            src="{{ asset('image/default_male_user_image.png') }}"
                                                            alt="">
                                                    @else
                                                        <img class="img-thumbnail shadow-sm  col-8"
                                                            src="{{ asset('image/default_female_user_image.png') }}"
                                                            alt="">
                                                    @endif
                                                @else
                                                    <img class=" col-8" src="{{ asset('storage/' . $admin->image) }}"
                                                        alt="">
                                                @endif
                                            </td>
                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>{{ $admin->gender }}</td>
                                            <td>{{ $admin->phone }}</td>
                                            <td>{{ $admin->address }}</td>

                                            <td>
                                                {{-- <div class="table-data-feature">
                                                        <a href="@if (Auth::user()->id == $admin->id)
                                                            #
                                                        @else
                                                            {{route('admin#delete')}}
                                                        @endif">
                                                            <button class="item" data-toggle="tooltip"
                                                                data-placement="top" title="Delete">
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </button>
                                                        </a>
                                                    </div> --}}

                                                @if (Auth::user()->id == $admin->id)

                                                @else
                                                    <div class="table-data-feature">
                                                        <a href="{{ route('role#change', $admin->id) }}">
                                                            <button class="item me-3" data-toggle="tooltip"
                                                                data-placement="top" title="Change to user Role ">
                                                                <i class="fa-solid fa-people-arrows "></i>
                                                            </button>
                                                        </a>

                                                        <a href="{{ route('admin#delete', $admin->id) }}">
                                                            <button class="item" data-toggle="tooltip"
                                                                data-placement="top" title="Delete">
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </button>
                                                        </a>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- END DATA TABLE -->
                    </div>
                </div>
                <div class="">
                    {{ $admins->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
