<div class="{{ $className ?? '' }}">
	<label for="doctor" class="form-label">
		@if(($multiple ?? false))
			@lang('admin/doctor.plural')
		@else
			@lang('admin/doctor.singular')
		@endif
	</label>
	<select name="{{ ($multiple ?? false) ? 'doctors[]': 'doctor_id' }}" id="doctor" class="w-100" @if(($multiple ?? false)) multiple @endif data-toggle="select2" data-placeholder="@lang('admin/global.words.choose')">
		@if(!($multiple ?? false))
			<option></option>
		@endif
		@foreach($doctors as $doctor)
			<option value="{{ $doctor->id }}" @selected(($multiple ?? false) ? in_array($doctor->id, old('doctors', ($selected ?? []))) : $doctor->id == old('doctor_id', $selected ?? 0))>{{ $doctor->full_name }}</option>
		@endforeach
	</select>
</div>