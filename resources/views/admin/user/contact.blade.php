@extends('admin.layout.master')

@section('title', 'Contact Page')

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
                                    <h2 class="title-1">User Contact List</h2>

                                </div>
                            </div>

                        </div>
                        @if (session('categoryDelete'))
                            <div class=" col-4 offset-8">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ session('categoryDelete') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            </div>
                        @endif

                        <div class="row my-5">
                            <div class="col-3">
                                <h4 class="text-secondary">Total - {{$contacts->total()}}</h4>
                            </div>
                            <div class="col-3 offset-6">
                                <form action="{{ route('category#home') }}" method="get">
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

                        @if (count($contacts) != 0)
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2">
                                    <thead>
                                        <tr>
                                            <th>id no</th>
                                            <th>name</th>
                                            <th>user email</th>
                                            <th>Message</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tr class="spacer"></tr>
                                    <tbody>
                                        @foreach ($contacts as $contact)
                                            <tr class="tr-shadow">
                                                <td>{{ $contact->id }}</td>
                                                <td>{{ $contact->name }}</td>
                                                <td>{{ $contact->email}}</td>
                                                <td>{{ $contact->message}}</td>   {{-- <td>{{ Str::words(strip_tags($contact->message), 5, ' . . . .') }}</td> --}}
                                                <td style="margin: 0;">
                                                    <div class="table-data-feature">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Send">
                                                            <i class="zmdi zmdi-mail-send"></i>
                                                        </button>
                                                        <a href="#">
                                                            <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="view">
                                                            <i class="fa-regular fa-eye"></i>
                                                        </button>
                                                        </a>
                                                        <a href="{{ route('user#contactDelete', $contact->id) }}">
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
                    {{ $contacts->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
