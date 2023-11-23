<div class="{{ $className ?? '' }}">
	<label for="category" class="form-label">
		@if(($multiple ?? false))
			@lang('admin/category.plural')
		@else
			@lang('admin/category.singular')
		@endif
	</label>
	<select name="{{ ($multiple ?? false) ? 'categories[]': 'category_id' }}" id="category" class="w-100" @if(($multiple ?? false)) multiple @endif data-toggle="select2" data-placeholder="@lang('admin/global.words.choose')">
		@if(!($multiple ?? false))
			<option></option>
		@endif
		@foreach($categories as $category)
			<option value="{{ $category->id }}" @selected(($multiple ?? false) ? in_array($category->id, old('categories', ($selected ?? []))) : $category->id == old('category_id', $selected ?? 0))>{{ $category->name }}</option>
		@endforeach
	</select>
</div>