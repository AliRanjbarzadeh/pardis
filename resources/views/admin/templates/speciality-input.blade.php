<div class="{{ $className ?? '' }}">
	<label for="speciality" class="form-label">
		@if(($multiple ?? false))
			@lang('admin/speciality.plural')
		@else
			@lang('admin/speciality.singular')
		@endif
	</label>
	<select name="{{ ($multiple ?? false) ? 'specialities[]': 'speciality_id' }}" id="speciality" class="w-100" @if(($multiple ?? false)) multiple @endif data-toggle="select2" data-placeholder="@lang('admin/global.words.choose')">
		@if(!($multiple ?? false))
			<option></option>
		@endif
		@foreach($specialities as $speciality)
			<option value="{{ $speciality->id }}" @selected(($multiple ?? false) ? in_array($speciality->id, old('categories', ($selected ?? []))) : $speciality->id == old('speciality_id', $selected ?? 0))>{{ $speciality->name }}</option>
		@endforeach
	</select>
</div>