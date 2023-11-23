<div class="d-flex align-items-center {{ $className ?? '' }}">
	<h5 class="m-0 flex-grow-1">@lang('admin/social_network.plural')</h5>
	<button type="button" class="btn btn-icon btn-primary rounded-pill" data-action="add-socialNetwork">
		<span class="tf-icons bx bx-plus"></span>
	</button>
</div>
<div class="accordion mt-3" id="socialNetworks">
	@php
		$socialNetworks = old('social_networks', $socialNetworks ?? []);
	@endphp
	@if(!empty($socialNetworks))
		@foreach($socialNetworks['title'] as $key => $title)
			<div class="card accordion-item @if($loop->last) active @endif" data-socialNetwork="{{ $loop->iteration }}">
				<div class="accordion-header d-flex align-items-center" id="socialNetwork-head-{{ $loop->iteration }}">
					<button type="button" class="btn btn-icon btn-outline-danger btn-sm rounded-pill ms-3" onclick="deleteSocialNetwork(this)">
						<span class="tf-icons bx bx-x"></span>
					</button>
					<button type="button" class="accordion-button @if(!$loop->last) collapsed @endif" data-bs-toggle="collapse" data-bs-target="#socialNetwork-body-{{ $loop->iteration }}" aria-expanded="{{ $loop->last ? 'true' : 'false' }}" aria-controls="socialNetwork-body-{{ $loop->iteration }}">
						@lang('admin/social_network.words.social_network', ['num' => $loop->iteration])
					</button>
				</div>
				<div id="socialNetwork-body-{{ $loop->iteration }}" class="accordion-collapse collapse @if($loop->last) show @endif">
					<div class="accordion-body">
						<div class="mb-3">
							<label for="typeId-{{ $loop->iteration }}" class="form-label">@lang('admin/social_network.fields.type')</label>
							<select class="form-control" id="typeId-{{ $loop->iteration }}" name="social_networks[type_id][]" data-toggle="select2" data-placeholder="@lang('admin/global.words.choose')">
								<option></option>
								@foreach($socialNetworkTypes as $socialNetworkType)
									<option value="{{ $socialNetworkType->id }}" @selected($socialNetworkType->id == $socialNetworks['type_id'][$key])>{{ $socialNetworkType->name }}</option>
								@endforeach
							</select>
						</div>

						<div class="mb-3">
							<label for="title-{{ $loop->iteration }}" class="form-label">@lang('admin/social_network.fields.title')</label>
							<input type="text" class="form-control" id="title-{{ $loop->iteration }}" name="social_networks[title][]" placeholder="@lang('admin/social_network.placeholders.title')" value="{{ $title }}"/>
						</div>

						<div>
							<label for="address-{{ $loop->iteration }}" class="form-label">@lang('admin/social_network.fields.address')</label>
							<input type="text" class="form-control" id="address-{{ $loop->iteration }}" name="social_networks[address][]" placeholder="@lang('admin/social_network.placeholders.address')" value="{{ $socialNetworks['address'][$key] }}"/>
						</div>
					</div>
				</div>
				<input type="hidden" name="social_networks[id][]" value="{{ $socialNetworks['id'][$key] }}">
			</div>
		@endforeach
	@else
		<div class="card accordion-item active" data-socialNetwork="1">
			<div class="accordion-header d-flex align-items-center" id="socialNetwork-head-1">
				<button type="button" class="btn btn-icon btn-outline-danger btn-sm rounded-pill ms-3" onclick="deleteSocialNetwork(this)">
					<span class="tf-icons bx bx-x"></span>
				</button>
				<button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#socialNetwork-body-1" aria-expanded="true" aria-controls="socialNetwork-body-1">
					@lang('admin/social_network.words.social_network', ['num' => 1])
				</button>
			</div>
			<div id="socialNetwork-body-1" class="accordion-collapse collapse show">
				<div class="accordion-body">
					<div class="mb-3">
						<label for="typeId-1" class="form-label">@lang('admin/social_network.fields.type')</label>
						<select class="form-control" id="typeId-1" name="social_networks[type_id][]" data-toggle="select2" data-placeholder="@lang('admin/global.words.choose')">
							<option></option>
							@foreach($socialNetworkTypes as $socialNetworkType)
								<option value="{{ $socialNetworkType->id }}">{{ $socialNetworkType->name }}</option>
							@endforeach
						</select>
					</div>

					<div class="mb-3">
						<label for="title-1" class="form-label">@lang('admin/social_network.fields.title')</label>
						<input type="text" class="form-control" id="title-1" name="social_networks[title][]" placeholder="@lang('admin/social_network.placeholders.title')"/>
					</div>

					<div>
						<label for="address-1" class="form-label">@lang('admin/social_network.fields.address')</label>
						<input type="text" class="form-control" id="address-1" name="social_networks[address][]" placeholder="@lang('admin/social_network.placeholders.address')"/>
					</div>
				</div>
			</div>
			<input type="hidden" name="social_networks[id][]" value="id-0">
		</div>
	@endif
</div>

@push('scripts')
	<script type="text/javascript">
		const socialNetworkTypes = @json($socialNetworkTypes);
	</script>
	<script src="{{ asset("assets/admin/js/social-networks/index.js") }}?ver={{ $resourceVersion }}"></script>
@endpush