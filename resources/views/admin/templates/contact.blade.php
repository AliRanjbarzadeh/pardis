<div class="d-flex align-items-center {{ $className ?? '' }}">
	<h5 class="m-0 flex-grow-1">@lang('admin/contact.plural')</h5>
	<button type="button" class="btn btn-icon btn-primary rounded-pill" data-action="add-contact">
		<span class="tf-icons bx bx-plus"></span>
	</button>
</div>
<div class="accordion mt-3" id="contacts">
	@php
		$contacts = old('contact', $contacts ?? []);
	@endphp
	@if(!empty($contacts))
		@foreach($contacts['title'] as $key => $title)
			<div class="card accordion-item @if($loop->last) active @endif" data-contact="{{ $loop->iteration }}">
				<div class="accordion-header d-flex align-items-center" id="contact-head-{{ $loop->iteration }}">
					<button type="button" class="btn btn-icon btn-outline-danger btn-sm rounded-pill ms-3" onclick="deleteContact(this)">
						<span class="tf-icons bx bx-x"></span>
					</button>
					<button type="button" class="accordion-button @if(!$loop->last) collapsed @endif" data-bs-toggle="collapse" data-bs-target="#contact-body-{{ $loop->iteration }}" aria-expanded="{{ $loop->last ? 'true' : 'false' }}" aria-controls="contact-body-{{ $loop->iteration }}">
						@lang('admin/contact.words.contact', ['num' => $loop->iteration])
					</button>
				</div>
				<div id="contact-body-{{ $loop->iteration }}" class="accordion-collapse collapse @if($loop->last) show @endif">
					<div class="accordion-body">
						<div class="mb-3">
							<label for="title-{{ $loop->iteration }}" class="form-label">@lang('admin/contact.fields.title')</label>
							<input type="text" class="form-control" id="title-{{ $loop->iteration }}" name="contact[title][]" placeholder="@lang('admin/contact.placeholders.title')" value="{{ $title }}"/>
						</div>

						<div>
							<label for="value-{{ $loop->iteration }}" class="form-label">@lang('admin/contact.fields.value')</label>
							<input type="text" class="form-control" id="value-{{ $loop->iteration }}" name="contact[value][]" placeholder="@lang('admin/contact.placeholders.value')" value="{{ $contacts['value'][$key] }}"/>
						</div>
					</div>
				</div>
				<input type="hidden" name="contact[id][]" value="{{ $contacts['id'][$key] }}">
			</div>
		@endforeach
	@else
		<div class="card accordion-item active" data-contact="1">
			<div class="accordion-header d-flex align-items-center" id="contact-head-1">
				<button type="button" class="btn btn-icon btn-outline-danger btn-sm rounded-pill ms-3" onclick="deleteContact(this)">
					<span class="tf-icons bx bx-x"></span>
				</button>
				<button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#contact-body-1" aria-expanded="true" aria-controls="contact-body-1">
					@lang('admin/contact.words.contact', ['num' => 1])
				</button>
			</div>
			<div id="contact-body-1" class="accordion-collapse collapse show">
				<div class="accordion-body">
					<div class="mb-3">
						<label for="title-1" class="form-label">@lang('admin/contact.fields.title')</label>
						<input type="text" class="form-control" id="title-1" name="contact[title][]" placeholder="@lang('admin/contact.placeholders.title')"/>
					</div>

					<div>
						<label for="value-1" class="form-label">@lang('admin/contact.fields.value')</label>
						<input type="text" class="form-control" id="value-1" name="contact[value][]" placeholder="@lang('admin/contact.placeholders.value')"/>
					</div>
				</div>
			</div>
			<input type="hidden" name="contact[id][]" value="id-0">
		</div>
	@endif
</div>

@push('scripts')
	<script src="{{ asset("assets/admin/js/contact/index.js") }}?ver={{ $resourceVersion }}"></script>
@endpush