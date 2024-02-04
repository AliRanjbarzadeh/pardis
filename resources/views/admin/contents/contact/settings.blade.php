@extends('admin.layouts.master')

@section('content')
	<div class="row">
		<div class="col-12">
			<form action="{{ route('admin.contacts.settings.store') }}" method="post" enctype="multipart/form-data">
				@csrf

				<div class="row">
					<div class="col-md-8">
						<div class="card mb-3">
							<div class="card-body">
								<h5 class="card-title">@lang('admin/global.words.basic_information')</h5>

								<div class="row mb-3">
									<div class="col-md-6 mb-sm-3">
										<label for="title" class="form-label">@lang('admin/page.fields.title')</label>
										<input type="text" class="form-control" id="title" name="title" placeholder="@lang('admin/page.placeholders.title')" value="{{ old('title', $page?->title ?? '') }}" data-seo-title data-seo-link/>
									</div>

									<div class="col-md-6">
										<label for="side_title" class="form-label">@lang('admin/contact.fields.side_title')</label>
										<input type="text" class="form-control" id="side_title" name="metas[side_title]" placeholder="@lang('admin/contact.placeholders.side_title')" value="{{ old('metas.side_title', $page?->getMetaValue('side_title') ?? '') }}"/>
									</div>
								</div>

								<div class="row mb-3">
									<div class="col-md-6 mb-sm-3">
										<label for="address" class="form-label">@lang('admin/contact.fields.address')</label>
										<input type="text" class="form-control" id="address" name="metas[address]" placeholder="@lang('admin/contact.placeholders.address')" value="{{ old('metas.address', $page?->getMetaValue('address') ?? '') }}"/>
									</div>

									<div class="col-md-6">
										<label for="phones" class="form-label">@lang('admin/contact.fields.phones')</label>
										<input type="text" class="form-control" id="phones" name="metas[phones]" placeholder="@lang('admin/contact.placeholders.phones')" value="{{ old('metas.phones', $page?->getMetaValue('phones') ?? '') }}"/>
									</div>
								</div>

								<div class="mb-3">
									<label for="form_title" class="form-label">@lang('admin/contact.fields.form.title')</label>
									<input type="text" class="form-control" id="form_title" name="metas[form][title]" placeholder="@lang('admin/contact.placeholders.form.title')" value="{{ old('metas.form.title', $page?->getMetaValue('form')['title'] ?? '') }}"/>
								</div>

								<div class="mb-3">
									<label for="description" class="form-label">@lang('admin/contact.fields.form.description')</label>
									<textarea class="form-control" id="description" name="metas[form][description]" rows="4" placeholder="@lang('admin/contact.placeholders.form.description')">{{ old('metas.form.description', $page?->getMetaValue('form')['description'] ?? '') }}</textarea>
								</div>

								<div class="mb-3">
									<label for="search" class="form-label">@lang('admin/global.fields.search')</label>
									<input type="text" class="form-control" id="map-search" placeholder="@lang('admin/global.placeholders.search')"/>
									<div id="map-search-result" class="map-search-result position-absolute border border-1 border-gray border-top-0 rounded-0 rounded-bottom end-0 start-0 bg-white d-none"></div>
									<div id="map" class="mt-2 w-100 h-px-400"></div>
								</div>

								<input id="map-location" type="hidden" name="metas[location]" value="{{ old('metas.location', $page?->getMetaValue('location', true)) }}">

								<button type="submit" class="btn btn-primary mt-3 w-25">
									<span class="tf-icon bx bx-save"></span>
									@lang('admin/global.actions.save')
								</button>
							</div>
						</div>
					</div>

					<!--Sidebar tools-->
					<div class="col-md-4">
						<!--Seo-->
						<div class="card mb-3">
							<div class="card-body">
								<h5 class="card-title">@lang('admin/seo.words.information')</h5>

								@include('admin.templates.seo-inputs', ['seo' => $page?->seo])
							</div>
						</div>

						<!--SocialNetwork Information-->
						@include('admin.templates.social-network', ['className' => 'mt-3', 'socialNetworks' => $page?->social_networks_for_input])
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection

@push('styles')
	<!--Neshan-->
	<link rel="stylesheet" href="https://static.neshan.org/sdk/leaflet/v1.9.4/neshan-sdk/v1.0.8/index.css"/>
@endpush

@push('scripts')
	<!-- Neshan -->
	<script type="text/javascript" src="https://static.neshan.org/sdk/leaflet/v1.9.4/neshan-sdk/v1.0.8/index.js"></script>

	<script type="text/javascript" src="{{ asset('assets/admin/js/pages/contact/settings.js') }}?ver={{ $resourceVersion }}"></script>
	<script type="text/javascript" src="{{ asset('assets/admin/shared/js/map.js') }}?ver={{ $resourceVersion }}"></script>
@endpush
