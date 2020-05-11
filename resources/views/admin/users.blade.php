@extends('layouts.admin')

@section('additional_css')
    <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendors/custom/datatables/datatables.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
    <style type="text/css">
        #admin_users tr:hover{cursor: pointer;}
        #admin_users tr.shown{background-color: #f7f8fa;}
        #admin_users .table-child{background-color: #f7f8fa;}
        #admin_users .table-child td{padding: 10px 20px;}
        #admin_users .table-child-title{position: absolute;left: 200px;}
        #admin_users .hidden{display: none;}
    </style>
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
            <div class="m-portlet__body">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="admin_users">
                    <thead>
                        <tr>
                            <th class="hidden"></th>
                            <th></th>
                            <th>User ID</th>
                            <th>Date Registered</th>
                            <th>Company Name</th>
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
                                <td class="hidden">{{$user->count_all}}</td>
                                <td class="details-control">
                                @if($user->count_all!=0)
                                    <h4>+</h4>
                                @endif
                                </td>
                                <td class="details-control" align="center">{{$user->userIdx}}</td>
                                <td class="details-control">{{ date('d/m/Y', strtotime($user->createdAt)) }}</td>
                                <td class="details-control">{{ $user->companyName}}</a>
                                <td class="details-control">{{ $user->businessName}}</td>
                                <td class="details-control">{{ $user->email}}</td>
                                <td class="details-control">{{ $user->firstname}}</td>
                                <td class="details-control">{{ $user->lastname }}</td>
                                <td class="details-control">{{ $user->jobTitle? $user->jobTitle : "N/A" }}</td>
                                <td class="details-control">{{ $user->role }}</td>
                                <td class="details-control">{{ $user['count_all'] . " invited " . "/" . $user['count_pending'] . " pending"}}</td>
                                <td class="details-control">{{ $user->count_products }}</td>
                                <td class="details-control">{{ $user->userIdx }}</td>
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

