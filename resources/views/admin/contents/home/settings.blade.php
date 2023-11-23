@extends('admin.layouts.master')

@section('content')
	<div class="row">
		<div class="col-12">
			<form action="{{ route('admin.home.settings.store') }}" method="post" enctype="multipart/form-data">
				@csrf

				<div class="row">
					<div class="col-md-8">

						<!--Clinic-->
						<div class="card mb-3">
							<div class="card-body">
								<h5 class="card-title">@lang('admin/clinic.plural')</h5>

								<div class="row mb-3">
									<div class="col-md-4 mb-sm-3">
										<label for="clinic_title" class="form-label">@lang('admin/clinic.fields.home.title')</label>
										<input type="text" class="form-control" id="clinic_title" name="metas[clinic][title]" placeholder="@lang('admin/clinic.placeholders.home.title')" value="{{ old('metas.clinic.title', $page?->getMetaValue('clinic')['title'] ?? '') }}"/>
									</div>

									<div class="col-md-4 mb-sm-3">
										<label for="clinic_items_to_show_type" class="form-label">@lang('admin/global.words.items_to_show')</label>
										<select class="form-control" id="clinic_items_to_show_type" data-toggle="select2" data-type="clinic" data-show-type>
											<option value="all" @selected(old('metas.clinic.items_to_show', $page?->getMetaValue('clinic')['items_to_show'] ?? 0) == 0)>@lang('admin/global.words.all')</option>
											<option value="some" @selected(old('metas.clinic.items_to_show', $page?->getMetaValue('clinic')['items_to_show'] ?? 0) > 0)>@lang('admin/global.words.some')</option>
										</select>
									</div>

									<div class="col-md-4">
										<label for="clinic_items_to_show" class="form-label">@lang('admin/global.words.number')</label>
										<input type="number" class="form-control" id="clinic_items_to_show" name="metas[clinic][items_to_show]" min="{{ config('global.input.items_per_page.min') }}" max="{{ config('global.input.items_per_page.max') }}" value="{{ old('metas.clinic.items_to_show', $page?->getMetaValue('clinic')['items_to_show'] ?? 0) }}" @readonly(old('metas.clinic.items_to_show', $page?->getMetaValue('clinic')['items_to_show'] ?? 0) == 0)/>
									</div>
								</div>

								<div>
									<label for="clinic_description" class="form-label">@lang('admin/clinic.fields.home.description')</label>
									<textarea class="form-control" id="clinic_description" name="metas[clinic][description]" placeholder="@lang('admin/clinic.placeholders.home.description')" rows="4">{{ old('metas.clinic.description', $page?->getMetaValue('clinic')['description'] ?? '') }}</textarea>
								</div>
							</div>
						</div>

						<!--Doctor-->
						<div class="card mb-3">
							<div class="card-body">
								<h5 class="card-title">@lang('admin/doctor.plural')</h5>

								<div class="row">
									<div class="col-md-4 mb-sm-3">
										<label for="doctor_title" class="form-label">@lang('admin/doctor.fields.home.title')</label>
										<input type="text" class="form-control" id="doctor_title" name="metas[doctor][title]" placeholder="@lang('admin/doctor.placeholders.home.title')" value="{{ old('metas.doctor.title', $page?->getMetaValue('doctor')['title'] ?? '') }}"/>
									</div>

									<div class="col-md-4 mb-sm-3">
										<label for="doctor_items_to_show_type" class="form-label">@lang('admin/global.words.items_to_show')</label>
										<select class="form-control" id="doctor_items_to_show_type" data-toggle="select2" data-type="doctor" data-show-type>
											<option value="all" @selected(old('metas.doctor.items_to_show', $page?->getMetaValue('doctor')['items_to_show'] ?? 0) == 0)>@lang('admin/global.words.all')</option>
											<option value="some" @selected(old('metas.doctor.items_to_show', $page?->getMetaValue('doctor')['items_to_show'] ?? 0) > 0)>@lang('admin/global.words.some')</option>
										</select>
									</div>

									<div class="col-md-4">
										<label for="doctor_items_to_show" class="form-label">@lang('admin/global.words.number')</label>
										<input type="number" class="form-control" id="doctor_items_to_show" name="metas[doctor][items_to_show]" min="{{ config('global.input.items_per_page.min') }}" max="{{ config('global.input.items_per_page.max') }}" value="{{ old('metas.doctor.items_to_show', $page?->getMetaValue('doctor')['items_to_show'] ?? 0) }}" @readonly(old('metas.doctor.items_to_show', $page?->getMetaValue('doctor')['items_to_show'] ?? 0) == 0)/>
									</div>
								</div>
							</div>
						</div>

						<!--Service-->
						<div class="card mb-3">
							<div class="card-body">
								<h5 class="card-title">@lang('admin/service.plural')</h5>

								<div class="row mb-3">
									<div class="col-md-4 mb-sm-3">
										<label for="service_title" class="form-label">@lang('admin/service.fields.home.title')</label>
										<input type="text" class="form-control" id="service_title" name="metas[service][title]" placeholder="@lang('admin/service.placeholders.home.title')" value="{{ old('metas.service.title', $page?->getMetaValue('service')['title'] ?? '') }}"/>
									</div>

									<div class="col-md-4 mb-sm-3">
										<label for="service_items_to_show_type" class="form-label">@lang('admin/global.words.items_to_show')</label>
										<select class="form-control" id="service_items_to_show_type" data-toggle="select2" data-type="service" data-show-type>
											<option value="all" @selected(old('metas.service.items_to_show', $page?->getMetaValue('service')['items_to_show'] ?? 0) == 0)>@lang('admin/global.words.all')</option>
											<option value="some" @selected(old('metas.service.items_to_show', $page?->getMetaValue('service')['items_to_show'] ?? 0) > 0)>@lang('admin/global.words.some')</option>
										</select>
									</div>

									<div class="col-md-4">
										<label for="service_items_to_show" class="form-label">@lang('admin/global.words.number')</label>
										<input type="number" class="form-control" id="service_items_to_show" name="metas[service][items_to_show]" min="{{ config('global.input.items_per_page.min') }}" max="{{ config('global.input.items_per_page.max') }}" value="{{ old('metas.service.items_to_show', $page?->getMetaValue('service')['items_to_show'] ?? 0) }}" @readonly(old('metas.service.items_to_show', $page?->getMetaValue('service')['items_to_show'] ?? 0) == 0)/>
									</div>
								</div>

								<div>
									<label for="service_description" class="form-label">@lang('admin/service.fields.home.description')</label>
									<textarea class="form-control" id="service_description" name="metas[service][description]" placeholder="@lang('admin/service.placeholders.home.description')" rows="4">{{ old('metas.service.description', $page?->getMetaValue('service')['description'] ?? '') }}</textarea>
								</div>
							</div>
						</div>

						<!--Testimonial-->
						<div class="card mb-3">
							<div class="card-body">
								<h5 class="card-title">@lang('admin/testimonial.plural')</h5>

								<div class="row">
									<div class="col-md-4 mb-sm-3">
										<label for="testimonial_title" class="form-label">@lang('admin/testimonial.fields.home.title')</label>
										<input type="text" class="form-control" id="testimonial_title" name="metas[testimonial][title]" placeholder="@lang('admin/testimonial.placeholders.home.title')" value="{{ old('metas.testimonial.title', $page?->getMetaValue('testimonial')['title'] ?? '') }}"/>
									</div>

									<div class="col-md-4 mb-sm-3">
										<label for="testimonial_items_to_show_type" class="form-label">@lang('admin/global.words.items_to_show')</label>
										<select class="form-control" id="testimonial_items_to_show_type" data-toggle="select2" data-type="testimonial" data-show-type>
											<option value="all" @selected(old('metas.testimonial.items_to_show', $page?->getMetaValue('testimonial')['items_to_show'] ?? 0) == 0)>@lang('admin/global.words.all')</option>
											<option value="some" @selected(old('metas.testimonial.items_to_show', $page?->getMetaValue('testimonial')['items_to_show'] ?? 0) > 0)>@lang('admin/global.words.some')</option>
										</select>
									</div>

									<div class="col-md-4">
										<label for="testimonial_items_to_show" class="form-label">@lang('admin/global.words.number')</label>
										<input type="number" class="form-control" id="testimonial_items_to_show" name="metas[testimonial][items_to_show]" min="{{ config('global.input.items_per_page.min') }}" max="{{ config('global.input.items_per_page.max') }}" value="{{ old('metas.testimonial.items_to_show', $page?->getMetaValue('testimonial')['items_to_show'] ?? 0) }}" @readonly(old('metas.testimonial.items_to_show', $page?->getMetaValue('testimonial')['items_to_show'] ?? 0) == 0)/>
									</div>
								</div>
							</div>
						</div>

						<!--Insurance-->
						<div class="card mb-3">
							<div class="card-body">
								<h5 class="card-title">@lang('admin/insurance.plural')</h5>

								<div class="row">
									<div class="col-md-4 mb-sm-3">
										<label for="insurance_title" class="form-label">@lang('admin/insurance.fields.home.title')</label>
										<input type="text" class="form-control" id="insurance_title" name="metas[insurance][title]" placeholder="@lang('admin/insurance.placeholders.home.title')" value="{{ old('metas.insurance.title', $page?->getMetaValue('insurance')['title'] ?? '') }}"/>
									</div>

									<div class="col-md-4 mb-sm-3">
										<label for="insurance_items_to_show_type" class="form-label">@lang('admin/global.words.items_to_show')</label>
										<select class="form-control" id="insurance_items_to_show_type" data-toggle="select2" data-type="insurance" data-show-type>
											<option value="all" @selected(old('metas.insurance.items_to_show', $page?->getMetaValue('insurance')['items_to_show'] ?? 0) == 0)>@lang('admin/global.words.all')</option>
											<option value="some" @selected(old('metas.insurance.items_to_show', $page?->getMetaValue('insurance')['items_to_show'] ?? 0) > 0)>@lang('admin/global.words.some')</option>
										</select>
									</div>

									<div class="col-md-4">
										<label for="insurance_items_to_show" class="form-label">@lang('admin/global.words.number')</label>
										<input type="number" class="form-control" id="insurance_items_to_show" name="metas[insurance][items_to_show]" min="{{ config('global.input.items_per_page.min') }}" max="{{ config('global.input.items_per_page.max') }}" value="{{ old('metas.insurance.items_to_show', $page?->getMetaValue('insurance')['items_to_show'] ?? 0) }}" @readonly(old('metas.insurance.items_to_show', $page?->getMetaValue('insurance')['items_to_show'] ?? 0) == 0)/>
									</div>
								</div>
							</div>
						</div>

						<!--Blog-->
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">@lang('admin/blog.plural')</h5>

								<div class="row">
									<div class="col-md-4 mb-sm-3">
										<label for="blog_title" class="form-label">@lang('admin/blog.fields.home.title')</label>
										<input type="text" class="form-control" id="blog_title" name="metas[blog][title]" placeholder="@lang('admin/blog.placeholders.home.title')" value="{{ old('metas.blog.title', $page?->getMetaValue('blog')['title'] ?? '') }}"/>
									</div>

									<div class="col-md-4 mb-sm-3">
										<label for="blog_items_to_show_type" class="form-label">@lang('admin/global.words.items_to_show')</label>
										<select class="form-control" id="blog_items_to_show_type" data-toggle="select2" data-type="blog" data-show-type>
											<option value="all" @selected(old('metas.blog.items_to_show', $page?->getMetaValue('blog')['items_to_show'] ?? 0) == 0)>@lang('admin/global.words.all')</option>
											<option value="some" @selected(old('metas.blog.items_to_show', $page?->getMetaValue('blog')['items_to_show'] ?? 0) > 0)>@lang('admin/global.words.some')</option>
										</select>
									</div>

									<div class="col-md-4">
										<label for="blog_items_to_show" class="form-label">@lang('admin/global.words.number')</label>
										<input type="number" class="form-control" id="blog_items_to_show" name="metas[blog][items_to_show]" min="{{ config('global.input.items_per_page.min') }}" max="{{ config('global.input.items_per_page.max') }}" value="{{ old('metas.blog.items_to_show', $page?->getMetaValue('blog')['items_to_show'] ?? 0) }}" @readonly(old('metas.blog.items_to_show', $page?->getMetaValue('blog')['items_to_show'] ?? 0) == 0)/>
									</div>
								</div>

								<input type="hidden" name="title" value="@lang('admin/page.words.home')">
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

						<!--Faq-->
						<div>
							@include('admin.templates.faq-inputs', ['faqs' => $page?->faqs_for_input])
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection

@push('scripts')
	<script type="text/javascript" src="{{ asset('assets/admin/js/ck-editor/index.js') }}?ver={{ $resourceVersion }}"></script>
	<script type="text/javascript" src="{{ asset('assets/admin/js/pages/home/settings.js') }}?ver={{ $resourceVersion }}"></script>
@endpush
