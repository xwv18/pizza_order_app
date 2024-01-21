@extends('admin.layout.master')

@section('title', 'User List Page')

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
                                    <h2 class="title-1">User List</h2>

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
                                <h4 class="text-secondary">Total - {{ $users->total() }}</h4>
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
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>address</th>
                                        <th>role</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tr class="spacer"></tr>
                                <tbody>
                                    @foreach ($users as $user )
                                    <tr>
                                        <td id="userId">{{ $user->id}}</td>
                                        <td>
                                            @if ($user->image == null)
                                            @if ($user->gender == 'male')
                                                <img style="width: 120px;" class="img-thumbnail shadow-sm"
                                                    src="{{ asset('image/default_male_user_image.png') }}"
                                                    alt="">
                                            @else
                                                <img style="width: 120px;" class="img-thumbnail shadow-sm"
                                                    src="{{ asset('image/default_female_user_image.png') }}"
                                                    alt="">
                                            @endif
                                        @else
                                            <img style="width: 120px;" class="" src="{{ asset('storage/' . $user->image) }}"
                                                alt="">
                                        @endif</td>
                                        <td>{{ $user->name}}</td>
                                        <td>{{ $user->email}}</td>
                                        <td>{{ $user->phone}}</td>
                                        <td>{{ $user->address}}</td>
                                        <td>
                                            <select name="status" class=" form-control statusChange"
                                            id="">
                                            <option value="admin"
                                                @if ($user->role == 'admin') selected @endif>Admin
                                            </option>
                                            <option value="user"
                                                @if ($user->role == 'user') selected @endif>User
                                            </option>
                                        </select>
                                        </td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="{{route('userList#delete',$user->id)}}">
                                                    <button class="item" data-toggle="tooltip"
                                                        data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- END DATA TABLE -->
                    </div>
                </div>
                <div class="">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
@section('scriptSection')
    <script>
        $(document).ready(function(){
            $('.statusChange').change(function(){
                $parentNote = $(this).parents('tr');
                $currentRole = $(this).val();
                $currentUserId = $parentNote.find('#userId').html();
                $data = {
                    'role' : $currentRole,
                    'id' : $currentUserId
                }
                // console.log($data);
                $.ajax({
                    type: 'get',
                    url: '/pizza_hunt/public/admin/user/ajax/role/change',
                    data: $data,
                    dataType: 'json',
                });
                location.reload();
            });
        })
    </script>
@endsection
