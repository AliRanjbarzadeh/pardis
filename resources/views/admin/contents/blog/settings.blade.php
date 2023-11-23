@extends('admin.layouts.master')

@section('content')
	<div class="row">
		<div class="col-12">
			<form action="{{ route('admin.blogs.settings.store') }}" method="post" enctype="multipart/form-data">
				@csrf

				<div class="row">
					<div class="col-md-8">
						<div class="card mb-3">
							<div class="card-body">
								<h5 class="card-title">@lang('admin/global.words.basic_information')</h5>

								<div class="mb-3">
									<label for="title" class="form-label">@lang('admin/page.fields.title')</label>
									<input type="text" class="form-control" id="title" name="title" placeholder="@lang('admin/page.placeholders.title')" value="{{ old('title', $page?->title ?? '') }}" data-seo-title data-seo-link/>
								</div>

								<div class="mb-3">
									<label for="description" class="form-label">@lang('admin/page.fields.description')</label>
									<textarea class="form-control" id="description" name="description" rows="4" placeholder="@lang('admin/page.placeholders.description')">{{ old('description', $page?->description ?? '') }}</textarea>
								</div>

								<div class="mb-3">
									<label for="full_description" class="form-label">@lang('admin/page.fields.full_description')</label>
									<textarea class="form-control" id="full_description" name="full_description" data-toggle="ck-editor" placeholder="@lang('admin/page.placeholders.full_description')">{{ old('full_description', $page?->full_description ?? '') }}</textarea>
								</div>

								<button type="submit" class="btn btn-primary mt-3 w-25">
									<span class="tf-icon bx bx-save"></span>
									@lang('admin/global.actions.save')
								</button>
							</div>
						</div>
					</div>

					<!--Sidebar tools-->
					<div class="col-md-4">
						<div class="card mb-3">
							<div class="card-body">
								<div class="mb-3">
									<label for="items_per_page" class="form-label">@lang('admin/page.fields.items_per_page')</label>
									<input type="number" class="form-control" id="items_per_page" name="metas[items_per_page]" min="{{ config('global.input.items_per_page.min') }}" max="{{ config('global.input.items_per_page.max') }}" value="{{ old('metas.items_per_page', $page?->getMetaValue('items_per_page') ?? config('global.input.items_per_page.min')) }}"/>
								</div>

								<div class="mb-3">
									@php
										$topItems = \App\Helpers\General::fromJson(old('metas.top_items', $page?->getMetaValue('top_items', true) ?? '[]'), true);
									@endphp
									<label for="top_items" class="form-label">@lang('admin/blog.words.top')</label>
									<select class="form-control" id="top_items" multiple data-placeholder="@lang('admin/global.sentences.type_on_or_more')">
										@if(!empty($topItems))
											@foreach($topItems as $topItem)
												<option value="{{ $topItem['id'] }}" selected>{{ $topItem['title'] }}</option>
											@endforeach
										@endif
									</select>

									<input type="hidden" id="top_items_input" name="metas[top_items]" value="{{ old('metas.top_items', $page?->getMetaValue('top_items', true)) }}">
								</div>
							</div>
						</div>

						<!--Seo-->
						<div class="card mb-3">
							<div class="card-body">
								<h5 class="card-title">@lang('admin/seo.words.information')</h5>

								@include('admin.templates.seo-inputs', ['seo' => $page?->seo])
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection

@push('scripts')
	<script type="text/javascript" src="{{ asset('assets/admin/js/ck-editor/index.js') }}?ver={{ $resourceVersion }}"></script>
	<script type="text/javascript" src="{{ asset('assets/admin/js/pages/blog/settings.js') }}?ver={{ $resourceVersion }}"></script>
@endpush
