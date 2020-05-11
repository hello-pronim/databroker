@extends('layouts.admin')

@section('additional_css')
    <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendors/custom/datatables/datatables.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
@endsection

@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator"><b style="color: #9102f7;">Company admin users</b></h3>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="#" class="btn btn-focus m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                    <span>
                                        <i class="la la-cart-plus"></i>
                                        <span>New User</span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="board_table">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Reg.Date</th>
                            <th>CompanyName</th>
                            <th>Industry</th>
                            <th>Admin Email</th>
                            <th>Admin Firstname</th>
                            <th>Admin Lastname</th>
                            <th>Admin Title</th>
                            <th>Admin Role</th>
                            <th>Users</th>
                            <th>Products</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)                      
                            <tr>
                                <td align="center">{{$user->userIdx}}</td>
                                <td>{{ date('d/m/Y H:i:s', strtotime($user->createdAt)) }}</td>
                                <td><a href="{{route('admin.company_users', ['cid'=>$user->companyIdx])}}">{{ $user->companyName}}</a></td>
                                <td>{{ $user->businessName}}</td>
                                <td>{{ $user->email}}</td>
                                <td>{{ $user->firstname}}</td>
                                <td>{{ $user->lastname }}</td>
                                <td>{{ $user->jobTitle }}</td>
                                <td>{{ $user->role }}</td>
                                <td>{{ $user['count_all'] . " invited " . "/" . $user['count_pending'] . " pending"}}</td>
                                <td>{{ $user->count_products }}</td>
                                <td>{{ $user->userIdx }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('additional_javascript')
    <script src="{{ asset('adminpanel/assets/vendors/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('js/plugins/sweetalert.min.js') }}"></script>
    <script src="{{ asset('adminpanel/js/users.js') }}"></script>            
@endsection

