<div class="d-flex align-items-center">
	<h5 class="m-0 flex-grow-1">@lang('admin/faq.plural')</h5>
	<button type="button" class="btn btn-icon btn-primary rounded-pill" data-action="add-faq">
		<span class="tf-icons bx bx-plus"></span>
	</button>
</div>
<div class="accordion mt-3" id="faqs">
	@php
		$faqs = old('faqs', $faqs ?? []);
	@endphp
	@if(!empty($faqs))
		@foreach($faqs['question'] as $key => $question)
			<div class="card accordion-item @if($loop->last) active @endif" data-faq="{{ $loop->iteration }}">
				<div class="accordion-header d-flex align-items-center" id="faq-head-{{ $loop->iteration }}">
					<button type="button" class="btn btn-icon btn-outline-danger btn-sm rounded-pill ms-3" onclick="deleteFaq(this)">
						<span class="tf-icons bx bx-x"></span>
					</button>
					<button type="button" class="accordion-button @if(!$loop->last) collapsed @endif" data-bs-toggle="collapse" data-bs-target="#faq-body-{{ $loop->iteration }}" aria-expanded="{{ $loop->last ? 'true' : 'false' }}" aria-controls="faq-body-{{ $loop->iteration }}">
						@lang('admin/faq.words.question', ['num' => $loop->iteration])
					</button>
				</div>
				<div id="faq-body-{{ $loop->iteration }}" class="accordion-collapse collapse @if($loop->last) show @endif">
					<div class="accordion-body">
						<div class="mb-3">
							<label for="question-{{ $loop->iteration }}" class="form-label">@lang('admin/faq.fields.question')</label>
							<input type="text" class="form-control" id="question-{{ $loop->iteration }}" name="faqs[question][]" placeholder="@lang('admin/faq.placeholders.question')" value="{{ $question }}"/>
						</div>

						<div>
							<label for="answer-{{ $loop->iteration }}" class="form-label">@lang('admin/faq.fields.answer')</label>
							<textarea class="form-control" id="answer-{{ $loop->iteration }}" name="faqs[answer][]" placeholder="@lang('admin/faq.placeholders.answer')" rows="4">{{ $faqs['answer'][$key] }}</textarea>
						</div>
					</div>
				</div>
				<input type="hidden" name="faqs[id][]" value="{{ $faqs['id'][$key] }}">
			</div>
		@endforeach
	@else
		<div class="card accordion-item active" data-faq="1">
			<div class="accordion-header d-flex align-items-center" id="faq-head-1">
				<button type="button" class="btn btn-icon btn-outline-danger btn-sm rounded-pill ms-3" onclick="deleteFaq(this)">
					<span class="tf-icons bx bx-x"></span>
				</button>
				<button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#faq-body-1" aria-expanded="true" aria-controls="faq-body-1">
					@lang('admin/faq.words.question', ['num' => 1])
				</button>
			</div>
			<div id="faq-body-1" class="accordion-collapse collapse show">
				<div class="accordion-body">
					<div class="mb-3">
						<label for="question-1" class="form-label">@lang('admin/faq.fields.question')</label>
						<input type="text" class="form-control" id="question-1" name="faqs[question][]" placeholder="@lang('admin/faq.placeholders.question')"/>
					</div>

					<div>
						<label for="answer-1" class="form-label">@lang('admin/faq.fields.answer')</label>
						<textarea class="form-control" id="answer-1" name="faqs[answer][]" placeholder="@lang('admin/faq.placeholders.answer')" rows="4"></textarea>
					</div>
				</div>
			</div>
			<input type="hidden" name="faqs[id][]" value="id-0">
		</div>
	@endif
</div>

@push('scripts')
	<script src="{{ asset("assets/admin/js/faq/index.js") }}?ver={{ $resourceVersion }}"></script>
@endpush