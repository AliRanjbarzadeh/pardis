<div class="d-flex align-items-center {{ $className ?? '' }}">
	<h5 class="m-0 flex-grow-1">@lang('admin/link.plural')</h5>
	<button type="button" class="btn btn-icon btn-primary rounded-pill" data-action="add-link">
		<span class="tf-icons bx bx-plus"></span>
	</button>
</div>
<div class="accordion mt-3" id="links">
	@php
		$links = old('links', $links ?? []);
	@endphp
	@if(!empty($links))
		@foreach($links['title'] as $key => $title)
			<div class="card accordion-item @if($loop->last) active @endif" data-link="{{ $loop->iteration }}">
				<div class="accordion-header d-flex align-items-center" id="link-head-{{ $loop->iteration }}">
					<button type="button" class="btn btn-icon btn-outline-danger btn-sm rounded-pill ms-3" onclick="deleteLink(this)">
						<span class="tf-icons bx bx-x"></span>
					</button>
					<button type="button" class="accordion-button @if(!$loop->last) collapsed @endif" data-bs-toggle="collapse" data-bs-target="#link-body-{{ $loop->iteration }}" aria-expanded="{{ $loop->last ? 'true' : 'false' }}" aria-controls="link-body-{{ $loop->iteration }}">
						@lang('admin/link.words.link', ['num' => $loop->iteration])
					</button>
				</div>
				<div id="link-body-{{ $loop->iteration }}" class="accordion-collapse collapse @if($loop->last) show @endif">
					<div class="accordion-body">
						<div class="mb-3">
							<label for="title-{{ $loop->iteration }}" class="form-label">@lang('admin/link.fields.title')</label>
							<input type="text" class="form-control" id="title-{{ $loop->iteration }}" name="links[title][]" placeholder="@lang('admin/link.placeholders.title')" value="{{ $title }}"/>
						</div>

						<div>
							<label for="link-{{ $loop->iteration }}" class="form-label">@lang('admin/link.fields.link')</label>
							<input type="text" class="form-control" id="link-{{ $loop->iteration }}" name="links[url][]" placeholder="@lang('admin/link.placeholders.link')" value="{{ $links['url'][$key] }}"/>
						</div>
					</div>
				</div>
			</div>
		@endforeach
	@else
		<div class="card accordion-item active" data-link="1">
			<div class="accordion-header d-flex align-items-center" id="link-head-1">
				<button type="button" class="btn btn-icon btn-outline-danger btn-sm rounded-pill ms-3" onclick="deleteLink(this)">
					<span class="tf-icons bx bx-x"></span>
				</button>
				<button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#link-body-1" aria-expanded="true" aria-controls="link-body-1">
					@lang('admin/link.words.link', ['num' => 1])
				</button>
			</div>
			<div id="link-body-1" class="accordion-collapse collapse show">
				<div class="accordion-body">
					<div class="mb-3">
						<label for="title-1" class="form-label">@lang('admin/link.fields.title')</label>
						<input type="text" class="form-control" id="title-1" name="links[title][]" placeholder="@lang('admin/link.placeholders.title')"/>
					</div>

					<div>
						<label for="link-1" class="form-label">@lang('admin/link.fields.link')</label>
						<input type="text" class="form-control" id="link-1" name="links[url][]" placeholder="@lang('admin/link.placeholders.link')"/>
					</div>
				</div>
			</div>
		</div>
	@endif
</div>

@push('scripts')
	<script src="{{ asset("assets/admin/js/link/index.js") }}?ver={{ $resourceVersion }}"></script>
@endpush