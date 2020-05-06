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
                <h3 class="m-subheader__title m-subheader__title--separator"><b style="color: #9102f7;">Homepage</b> Featured Data Section</h3>
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
                                <a href="{{ route('admin.home_featured_data_edit') }}" class="btn btn-focus m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                    <span>
                                        <i class="la la-cart-plus"></i>
                                        <span>Edit Featured Data</span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="{{ route('admin.preview_home', [ 'url' => 'admin.home_featured_data', 'model' => 'HomeFeaturedData' ]) }}" class="btn btn-focus m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
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
                            <th align="center">Image</th>
                            <th>Status</th>
                            <th>Title</th>
                            <th>Provider</th>
                            <th align="center">Logo</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($boards as $board)                      
                            <tr>
                                <td align="center">
                                    @if(file_exists(public_path("uploads/home/featured_data/thumb/".$board->image))) 
                                        {{ asset("uploads/home/featured_data/thumb/".$board->image) }}
                                    @elseif(file_exists(public_path("uploads/home/featured_data/".$board->image))) 
                                        {{ asset("uploads/home/featured_data/".$board->image) }}
                                    @else
                                        {{ asset("uploads/default_thumb.jpg") }}
                                    @endif
                                </td>
                                <td>{{ $board->active?'Published':'Preview' }}</td>
                                <td>{{ $board->featured_data_title }}</td>
                                <td>{{ $board->companyName }}</td>
                                <td>
                                    @if(file_exists(public_path("uploads/company/thumb/".$board->companyLogo))) 
                                        {{ asset("uploads/company/thumb/".$board->companyLogo) }}
                                    @else 
                                        {{ asset("uploads/company/thumb/default.png") }}
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
        <input type="file" id="upload_logo" accept=".gif,.jpg,.jpeg,.png,.svg" style="display: none;">
    </div>
</div>

@endsection

@section('additional_javascript')
    <script src="{{ asset('adminpanel/assets/vendors/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('adminpanel/js/home_featured_data.js') }}"></script>            
@endsection

