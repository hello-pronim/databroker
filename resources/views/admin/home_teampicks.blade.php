@extends('layouts.admin')

@section('additional_css')
    <link rel="stylesheet" href="{{ asset('adminpanel/assets/vendors/custom/datatables/datatables.bundle.css') }}">
@endsection

@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator"><b style="color: #9102f7;">Homepage</b> Team Picks Section</h3>
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
                                <a href="{{ route('admin.home_teampicks_add_new') }}" class="btn btn-focus m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                    <span>
                                        <i class="la la-cart-plus"></i>
                                        <span>New Team Picks</span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="{{ route('admin.preview_home', [ 'url' => 'admin.home_teampicks', 'model' => 'HomeTeamPicks' ]) }}" class="btn btn-focus m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                    <span>
                                        <i class="la la-cart-plus"></i>
                                        <span>Preview</span>
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
                            <th>Thumbnails</th>
                            <th>Status</th>
                            <th>Order</th>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Legion</th>
                            <th>Logo</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($boards as $board)                      
                            <tr>
                                <td>
                                    @if(file_exists(public_path("uploads/home/teampicks/tiny/".$board->image))) 
                                        {{ asset("uploads/home/teampicks/tiny/".$board->image) }}
                                    @else 
                                        {{ asset("uploads/home/teampicks/default.jpg") }}
                                    @endif
                                </td>
                                <td>{{ $board->active?'Published':'Preview' }}</td>
                                <td>{{ $board->order }}</td>
                                <td>{{ $board->title }}</td>
                                <td>{{ ($board->updated_at)->toDateString() }}</td>
                                <td>{{ $board->legion }}</td>
                                <td>
                                    @if(file_exists(public_path("uploads/home/teampicks/logo/".$board->logo))) 
                                        {{ asset("uploads/home/teampicks/logo/".$board->logo) }}
                                    @else 
                                        {{ asset("uploads/home/teampicks/default.jpg") }}
                                    @endif
                                </td>
                                <td>{{ $board->id }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <input type="file" id="upload_attach" accept=".gif,.jpg,.jpeg,.png" style="display: none;">
        <input type="file" id="upload_logo" accept=".gif,.jpg,.jpeg,.png" style="display: none;">
    </div>
</div>

@endsection

@section('additional_javascript')
    <script src="{{ asset('adminpanel/assets/vendors/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('adminpanel/js/home_teampicks.js') }}"></script>            
@endsection

