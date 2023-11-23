<div class="d-flex align-items-center {{ $className ?? '' }}">
	<h5 class="m-0 flex-grow-1">@lang('admin/resume.singular')</h5>
	<button type="button" class="btn btn-icon btn-primary rounded-pill" data-action="add-resume">
		<span class="tf-icons bx bx-plus"></span>
	</button>
</div>
<div class="accordion mt-3" id="resumes">
	@php
		$resumes = old('resumes', $resumes ?? []);
	@endphp
	@if(!empty($resumes))
		@foreach($resumes['title'] as $key => $title)
			<div class="card accordion-item @if($loop->last) active @endif" data-resume="{{ $loop->iteration }}">
				<div class="accordion-header d-flex align-items-center" id="resume-head-{{ $loop->iteration }}">
					<button type="button" class="btn btn-icon btn-outline-danger btn-sm rounded-pill ms-3" onclick="deleteResume(this)">
						<span class="tf-icons bx bx-x"></span>
					</button>
					<button type="button" class="accordion-button @if(!$loop->last) collapsed @endif" data-bs-toggle="collapse" data-bs-target="#resume-body-{{ $loop->iteration }}" aria-expanded="{{ $loop->last ? 'true' : 'false' }}" aria-controls="resume-body-{{ $loop->iteration }}">
						@lang('admin/resume.words.resume', ['num' => $loop->iteration])
					</button>
				</div>
				<div id="resume-body-{{ $loop->iteration }}" class="accordion-collapse collapse @if($loop->last) show @endif">
					<div class="accordion-body">
						<div class="mb-3">
							<label for="title-{{ $loop->iteration }}" class="form-label">@lang('admin/resume.fields.title')</label>
							<input type="text" class="form-control" id="title-{{ $loop->iteration }}" name="resumes[title][]" placeholder="@lang('admin/resume.placeholders.title')" value="{{ $title }}"/>
						</div>
					</div>
				</div>
			</div>
		@endforeach
	@else
		<div class="card accordion-item active" data-resume="1">
			<div class="accordion-header d-flex align-items-center" id="resume-head-1">
				<button type="button" class="btn btn-icon btn-outline-danger btn-sm rounded-pill ms-3" onclick="deleteResume(this)">
					<span class="tf-icons bx bx-x"></span>
				</button>
				<button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#resume-body-1" aria-expanded="true" aria-controls="resume-body-1">
					@lang('admin/resume.words.resume', ['num' => 1])
				</button>
			</div>
			<div id="resume-body-1" class="accordion-collapse collapse show">
				<div class="accordion-body">
					<div class="mb-3">
						<label for="title-1" class="form-label">@lang('admin/resume.fields.title')</label>
						<input type="text" class="form-control" id="title-1" name="resumes[title][]" placeholder="@lang('admin/resume.placeholders.title')"/>
					</div>
				</div>
			</div>
		</div>
	@endif
</div>

@push('scripts')
	<script src="{{ asset("assets/admin/js/resume/index.js") }}?ver={{ $resourceVersion }}"></script>
@endpush