<div class="d-flex align-items-center {{ $className ?? '' }}">
	<h5 class="m-0 flex-grow-1">@lang('admin/work_hour.plural')</h5>
	<button type="button" class="btn btn-icon btn-primary rounded-pill" data-action="add-work-hour">
		<span class="tf-icons bx bx-plus"></span>
	</button>
</div>
<div class="accordion mt-3" id="work-hours">
	@if(!empty(old('work_hours', $workHours ?? [])))
		@php
			$workHours = old('work_hours', $workHours ?? []);
		@endphp
		@foreach($workHours['title'] as $key => $title)
			<div class="card accordion-item @if($loop->last) active @endif" data-work-hour="{{ $loop->iteration }}">
				<div class="accordion-header d-flex align-items-center" id="work-hour-head-{{ $loop->iteration }}">
					<button type="button" class="btn btn-icon btn-outline-danger btn-sm rounded-pill ms-3" onclick="deleteWorkHour(this)">
						<span class="tf-icons bx bx-x"></span>
					</button>
					<button type="button" class="accordion-button @if(!$loop->last) collapsed @endif" data-bs-toggle="collapse" data-bs-target="#work-hour-body-{{ $loop->iteration }}" aria-expanded="{{ $loop->last ? 'true' : 'false' }}" aria-controls="work-hour-body-{{ $loop->iteration }}">
						@lang('admin/work_hour.words.title', ['num' => $loop->iteration])
					</button>
				</div>
				<div id="work-hour-body-{{ $loop->iteration }}" class="accordion-collapse collapse @if($loop->last) show @endif">
					<div class="accordion-body">
						<div class="mb-3">
							<label for="title-{{ $loop->iteration }}" class="form-label">@lang('admin/work_hour.fields.title')</label>
							<input type="text" class="form-control" id="title-{{ $loop->iteration }}" name="work_hours[title][]" placeholder="@lang('admin/work_hour.placeholders.title')" value="{{ $title }}"/>
						</div>

						<div>
							<label class="form-label">@lang('admin/work_hour.words.shift.first')</label>
							<div class="input-group">
								<input id="first-from-hour-{{ $loop->iteration }}" name="work_hours[first][from][]" class="form-control" placeholder="@lang('admin/global.placeholders.time')" data-jdp data-jdp-only-time readonly value="{{ $workHours['first']['from'][$key] }}">
								<span class="input-group-text">@lang('admin/global.words.until')</span>
								<input id="first-to-hour-{{ $loop->iteration }}" name="work_hours[first][to][]" class="form-control" placeholder="@lang('admin/global.placeholders.time')" data-jdp data-jdp-only-time readonly value="{{ $workHours['first']['to'][$key] }}">
							</div>
						</div>

						<div>
							<label class="form-label">@lang('admin/work_hour.words.shift.second')</label>
							<div class="input-group">
								<input id="second-from-hour-{{ $loop->iteration }}" name="work_hours[second][from][]" class="form-control" placeholder="@lang('admin/global.placeholders.time')" data-jdp data-jdp-only-time readonly value="{{ $workHours['second']['from'][$key] }}">
								<span class="input-group-text">@lang('admin/global.words.until')</span>
								<input id="second-to-hour-{{ $loop->iteration }}" name="work_hours[second][to][]" class="form-control" placeholder="@lang('admin/global.placeholders.time')" data-jdp data-jdp-only-time readonly value="{{ $workHours['second']['to'][$key] }}">
							</div>
						</div>
					</div>
				</div>
			</div>
		@endforeach
	@else
		<div class="card accordion-item active" data-work-hour="1">
			<div class="accordion-header d-flex align-items-center" id="work-hour-head-1">
				<button type="button" class="btn btn-icon btn-outline-danger btn-sm rounded-pill ms-3" onclick="deleteWorkHour(this)">
					<span class="tf-icons bx bx-x"></span>
				</button>
				<button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#work-hour-body-1" aria-expanded="true" aria-controls="work-hour-body-1">
					@lang('admin/work_hour.words.title', ['num' => 1])
				</button>
			</div>
			<div id="work-hour-body-1" class="accordion-collapse collapse show">
				<div class="accordion-body">
					<div class="mb-3">
						<label for="title-1" class="form-label">@lang('admin/work_hour.fields.title')</label>
						<input type="text" class="form-control" id="title-1" name="work_hours[title][]" placeholder="@lang('admin/work_hour.placeholders.title')"/>
					</div>

					<div>
						<label class="form-label">@lang('admin/work_hour.words.shift.first')</label>
						<div class="input-group">
							<input id="first-from-hour-1" name="work_hours[first][from][]" class="form-control" placeholder="@lang('admin/global.placeholders.time')" data-jdp data-jdp-only-time readonly>
							<span class="input-group-text">@lang('admin/global.words.until')</span>
							<input id="first-to-hour-1" name="work_hours[first][to][]" class="form-control" placeholder="@lang('admin/global.placeholders.time')" data-jdp data-jdp-only-time readonly>
						</div>
					</div>

					<div>
						<label class="form-label">@lang('admin/work_hour.words.shift.second')</label>
						<div class="input-group">
							<input id="second-from-hour-1" name="work_hours[second][from][]" class="form-control" placeholder="@lang('admin/global.placeholders.time')" data-jdp data-jdp-only-time readonly>
							<span class="input-group-text">@lang('admin/global.words.until')</span>
							<input id="second-to-hour-1" name="work_hours[second][to][]" class="form-control" placeholder="@lang('admin/global.placeholders.time')" data-jdp data-jdp-only-time readonly>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endif
</div>

@push('scripts')
	<script src="{{ asset("assets/admin/js/work-hour/index.js") }}?ver={{ $resourceVersion }}"></script>
@endpush