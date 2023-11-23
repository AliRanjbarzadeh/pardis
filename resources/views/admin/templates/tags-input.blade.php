@php
	$selectedTags = [];
	$olds = [];
	if (isset($selected)) {
		$selectedTags = $selected;
	}

	if (!empty(old('tags', []))) {
		foreach (old('tags') as $tag) {
			if (is_numeric($tag)) {
				$selectedTags[] = $tag;
			} else {
				$olds[] = $tag;
			}
		}
	}

@endphp
<div class="{{ $className ?? '' }}">
	<label for="tags" class="form-label">@lang('admin/tag.plural')</label>
	<select name="tags[]" id="tags" class="w-100" multiple data-toggle="select2" data-placeholder="@lang('admin/global.words.choose_or_create')" data-tags="true">
		@foreach($tags as $tag)
			<option value="{{ $tag->id }}" @selected(in_array($tag->id, $selectedTags))>{{ $tag->name }}</option>
		@endforeach

		@foreach($olds as $tag)
			<option value="{{ $tag }}" selected>{{ $tag }}</option>
		@endforeach
	</select>
</div>

@push('scripts')
	<script type="text/javascript" src="{{ asset('assets/admin/js/tag/index.js') }}?ver={{ $resourceVersion }}"></script>
@endpush