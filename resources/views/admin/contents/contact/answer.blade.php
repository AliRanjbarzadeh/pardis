@extends('admin.layouts.master')

@section('content')
	<div class="row">
		<div class="col-12">
			<form action="{{ route('admin.contacts.update', $contact) }}" method="post" enctype="multipart/form-data">
				@csrf
				@method('PATCH')

				<div class="row">
					<div class="col-md-12">
						<div class="card mb-3">
							<div class="card-body">
								<h5 class="card-title">@lang('admin/contact.fields.content')</h5>
								<p>{{ $contact->content }}</p>

								@if(is_null($contact->answer))
									<div class="mb-3">
										<label for="answer" class="form-label">@lang('admin/contact.fields.answer')</label>
										<textarea class="form-control" id="answer" name="answer" rows="10" placeholder="@lang('admin/contact.placeholders.answer')">{{ old('answer') }}</textarea>
									</div>

									<button type="submit" class="btn btn-primary mt-3 w-25">
										<span class="tf-icon bx bx-save"></span>
										@lang('admin/global.actions.save')
									</button>
								@else
									<h5 class="card-title">@lang('admin/contact.fields.answer')</h5>
									<p>{{ $contact->answer }}</p>
								@endif
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection