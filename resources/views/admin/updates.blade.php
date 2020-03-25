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
                <h3 class="m-subheader__title m-subheader__title--separator">Updates Article</h3>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-content">
        <h1>Comming Soon</h1>
    </div>
</div>

@endsection

@section('additional_javascript')
    <script src="{{ asset('adminpanel/assets/vendors/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('adminpanel/js/usecases.js') }}"></script>            
@endsection

