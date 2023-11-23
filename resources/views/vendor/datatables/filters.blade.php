<div class="row g-3 align-items-center mb-3">
	@foreach($inputs as $input)
		<div class="col-auto">
			<label for="filterInput{{ ucfirst($input['data']) }}" class="col-form-label">{{ $input['title'] }}</label>
			@switch($input['type'])
				@case('text')
					<input type="{{ $input['type'] }}" id="filterInput{{ ucfirst($input['data']) }}" data-type="{{ $input['type'] }}" data-field="{{ $input['name'] }}" class="form-control" placeholder="{{ $input['title'] }}">
					@break

				@case('date')
					<div class="input-group">
						<input id="filterInputFrom{{ ucfirst($input['name']) }}" data-field="from_{{ $input['name'] }}" data-type="{{ $input['type'] }}" class="form-control" placeholder="@lang('admin/global.placeholders.date')" data-jdp data-jdp-only-date readonly>
						<span class="input-group-text">@lang('admin/global.words.until')</span>
						<input id="filterInputTo{{ ucfirst($input['name']) }}" data-field="to_{{ $input['name'] }}" data-type="{{ $input['type'] }}" class="form-control" placeholder="@lang('admin/global.placeholders.date')" data-jdp data-jdp-only-date readonly>
					</div>
					@break

				@case('status')
					<select id="filterInput{{ ucfirst($input['data']) }}" data-type="{{ $input['type'] }}" data-field="{{ $input['name'] }}" class="select2 w-px-200" data-toggle="select2" data-allow-clear="true" data-minimum-results-for-search="-1" data-placeholder="{{ $input['title'] }}">
						<option value=""></option>
						@foreach($input['list'] as $key => $name)
							<option value="{{ $key }}">{{ $name }}</option>
						@endforeach
					</select>
					@break

				@case('category')
					<select id="filterInput{{ ucfirst($input['data']) }}" data-type="{{ $input['type'] }}" data-field="{{ $input['name'] }}" class="select2 w-px-200" data-toggle="select2" data-allow-clear="true" data-minimum-results-for-search="-1" data-placeholder="{{ $input['title'] }}">
						<option value=""></option>
						@foreach($input['list'] as $key => $name)
							<option value="{{ $key }}">{{ $name }}</option>
						@endforeach
					</select>
					@break
			@endswitch
		</div>
	@endforeach
</div>

<div class="row mb-3">
	@foreach($buttons as $button)
		<div class="col-auto mb-2 mb-lg-0">
			<button type="button" id="filterButton{{ $loop->iteration }}" class="btn {{ $button['class'] }}" data-action="{{ $button['action'] }}" data-url="{{ $button['url'] ?? '' }}" data-model="{{ $button['model'] ?? '' }}">
				<i class="bx bx-{{ $button['icon'] }} me-1"></i>{{ $button['title'] }}
			</button>
		</div>
	@endforeach
</div>

<div class="row mb-3">
	@foreach($actionLinks as $actionLink)
		<div class="col-auto mt-2 mb-lg-0">
			<a href="{{ $actionLink['href'] }}" class="btn {{ $actionLink['class'] }}">
				<i class="bx bx-{{ $actionLink['icon'] }} me-1"></i>{{ $actionLink['title'] }}
			</a>
		</div>
	@endforeach
</div>
