<div class="{{ $className ?? '' }}">
	<label for="insurances" class="form-label">@lang('admin/insurance.plural')</label>
	<select name="insurances[]" id="insurances" class="w-100" multiple data-toggle="select2" data-placeholder="@lang('admin/global.words.choose')" data-close-on-select="false">
		@foreach($insurances as $insurance)
			<option value="{{ $insurance->id }}" @selected(in_array($insurance->id, old('insurances', ($selected ?? []))))>{{ $insurance->name }}</option>
		@endforeach
	</select>
</div>