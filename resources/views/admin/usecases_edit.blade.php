@extends('layouts.admin')

@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<!-- BEGIN: Subheader -->
	<div class="m-subheader ">
		<div class="d-flex align-items-center">
			<div class="mr-auto">
				<h3 class="m-subheader__title m-subheader__title--separator"><b style="color: #9102f7;">{{ $categories[($communityIdx-1)]->communityName }}</b> Edit Article</h3>
				<ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
					<li class="m-nav__item m-nav__item--home">
						<a href="{{ route('admin.usecases', [ 'id' => $communityIdx ]) }}" class="m-nav__link m-nav__link--icon">
							<i class="m-nav__link-icon la la-home"></i>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- END: Subheader -->
	<div class="m-content">
		<!--begin::Portlet-->
		<div class="m-portlet">
			<!--begin::Form-->
			<form class="m-form m-form--fit m-form--label-align-right" id="board_form" novalidate="novalidate">
				<input type="hidden" name="id" value="{{ $id??'' }}">
				<div class="m-portlet__body">
					<div class="m-form__content">
						<div class="m-alert m-alert--icon alert alert-danger m--hide" role="alert" id="m_form_1_msg">
							<div class="m-alert__icon">
								<i class="la la-warning"></i>
							</div>
							<div class="m-alert__text">
								Oh snap! Change a few things up and try submitting again.
							</div>
							<div class="m-alert__close">
								<button type="button" class="close" data-close="alert" aria-label="Close">
								</button>
							</div>
						</div>
					</div>
					<div class="form-group m-form__group row">
						<div class="col-md-7 m-form__group-sub">
							<label class="form-control-label">Article Title *</label>
							<input type="text" class="form-control m-input" name="articleTitle" placeholder="Enter article title" value="{{ $board->articleTitle??'' }}">
						</div>
						<div class="col-md-2 m-form__group-sub">
							<label class="form-control-label">Published Date *</label>
							<input type="text" class="form-control m-input" name="published" placeholder="Date like 2000-01-30" value="{{ ($board->published)->toDateString()??'' }}">
						</div>
						<div class="col-md-3 m-form__group-sub">
							<label class="form-control-label">Board Category *</label>
							<select class="form-control m-input" name="communityIdx">
								<option value="">Select</option>
								@foreach($categories as $category)
                                    @if(($board) && ($board->communityIdx == $category->communityIdx))
                                        <option value="{{ $category->communityIdx }}"  selected>
                                            {{ $category->communityName }}
                                        </option>
                                    @else
                                        <option value="{{ $category->communityIdx }}" >
                                            {{ $category->communityName }}
                                        </option>
                                    @endif
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group m-form__group row">
						<div class="col-md-4 m-form__group-sub">
							<label class="form-control-label">Meta Title</label>
							<input type="text" class="form-control m-input" name="meta_title" placeholder="Enter meta title" value="{{ $board->meta_title }}">
						</div>
						<div class="col-md-8 m-form__group-sub">
							<label class="form-control-label">Meta Description</label>
							<input type="text" class="form-control m-input" name="meta_desc" placeholder="Enter meta description" value="{{ $board->meta_desc }}">
						</div>
					</div>
					<div class="form-group m-form__group row">
						<div class="col-md-12 m-form__group-sub">
							<label for="exampleTextarea">Article Content</label>
							<textarea class="form-control m-input summernote" rows="5" name="articleContent" placeholder="Enter article content">{{ $board->articleContent??'' }}</textarea>
						</div>
					</div>
				</div>
				<div class="m-portlet__foot m-portlet__foot--fit">
					<div class="m-form__actions m-form__actions">
						<div class="row">
							<div class="col-lg-9 ml-lg-auto">
								<button type="submit" class="btn btn-success">Save</button>
								<a href="{{ route('admin.usecases', [ 'id' => $communityIdx ]) }}" class="btn btn-secondary">Cancel</a>
							</div>
						</div>
					</div>
				</div>
            </form>
			<!--end::Form-->
		</div>
		<input id="communityIdx_id" name="communityIdx_id" type="hidden" value="{{ $communityIdx }}"/>
		<!--end::Portlet-->
	</div>
</div>
@endsection

@section('additional_javascript')
    <script src="{{ asset('adminpanel/js/usecases_add_new.js') }}"></script>        
@endsection

