<div class="{{ $className ?? '' }}">
	<label for="clinic" class="form-label">
		@if(($multiple ?? false))
			@lang('admin/clinic.plural')
		@else
			@lang('admin/clinic.singular')
		@endif
	</label>
	<select name="{{ ($multiple ?? false) ? 'clinics[]': 'clinic_id' }}" id="clinic" class="w-100" @if(($multiple ?? false)) multiple @endif data-toggle="select2" data-placeholder="@lang('admin/global.words.choose')">
		@if(!($multiple ?? false))
			<option></option>
		@endif
		@foreach($clinics as $clinic)
			<option value="{{ $clinic->id }}" @selected(($multiple ?? false) ? in_array($clinic->id, old('clinics', ($selected ?? []))) : $clinic->id == old('clinic_id', $selected ?? 0))>{{ $clinic->title }}</option>
		@endforeach
	</select>
</div>