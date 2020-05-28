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
                <h3 class="m-subheader__title m-subheader__title--separator"><b style="color: #9102f7;">Homepage</b> Featured Data Provider Section</h3>
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
                                <a href="{{ route('admin.home_featured_provider_add_new') }}" class="btn btn-focus m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
                                    <span>
                                        <i class="la la-cart-plus"></i>
                                        <span>New Provider</span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="{{ route('admin.preview_home', [ 'url' => 'admin.home_featured_provider', 'model' => 'HomeFeaturedProvider' ]) }}" class="btn btn-focus m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
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
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Company Name</th>
                            <th>Company URL</th>
                            <th>Company VAT</th>
                            <th>Published</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($boards as $board)                      
                            <tr>
                                <td align="center">
                                    <a href="{{ route('data.company_offers', ['companyName'=>str_replace(' ', '-', $board->companyName)]) }}">
                                    @if(file_exists(public_path("uploads/company/thumb/".$board->companyLogo))) 
                                        <img src='{{ asset("uploads/company/thumb/".$board->companyLogo) }}' style="height: 40px;">
                                    @else 
                                        <img src='{{ asset("uploads/company/default_thumb.png") }}' style="height: 40px;">
                                    @endif
                                    </a>
                                </td>
                                <td>{{ $board->firstname }}</td>
                                <td>{{ $board->lastname }}</td>
                                <td><a href="{{ route('data.company_offers', ['companyIdx'=>str_replace(' ', '-', $board->companyName)]) }}">{{$board->companyName}}</a></td>
                                <td>
                                    @if(preg_match("@^https?://@", $board->companyURL)) <a href="{{ $board->companyURL }}">{{$board->companyURL}}</a>
                                    @else <a href="https://{{ $board->companyURL }}">{{$board->companyURL}}</a>
                                    @endif
                                </td>
                                <td>{{ $board->companyVAT }}</td>
                                <td>{{ $board->active? "Published" : "Unpublished" }}</td>
                                <td>{{ $board->id }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <input type="file" id="upload_attach" accept=".gif,.jpg,.jpeg,.png,.svg" style="display: none;">
    </div>
</div>

@endsection

@section('additional_javascript')
    <script src="{{ asset('adminpanel/assets/vendors/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('adminpanel/js/home_featured_provider.js') }}"></script>            
@endsection

