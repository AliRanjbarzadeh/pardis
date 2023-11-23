<div class="mb-3">
	<label for="seo-title" class="form-label">@lang('admin/seo.fields.title')</label>
	<input type="text" class="form-control" id="seo-title" name="seo[title]" placeholder="@lang('admin/seo.placeholders.title')" value="{{ old('seo.title',  isset($seo) ? $seo?->title ?? '' : '') }}"/>
</div>

<div class="mb-3">
	<label for="seo-link" class="form-label">@lang('admin/seo.fields.link')</label>
	<input type="text" class="form-control" id="seo-link" name="seo[link]" placeholder="@lang('admin/seo.placeholders.link')" value="{{ old('seo.link', isset($seo) ? $seo?->link ?? '' : '') }}"/>
</div>

<div class="mb-3">
	<label for="seo-description" class="form-label">@lang('admin/seo.fields.description')</label>
	<textarea class="form-control" id="seo-description" name="seo[description]" placeholder="@lang('admin/service.placeholders.description')" rows="4">{{ old('seo.description', isset($seo) ? $seo?->description ?? '' : '') }}</textarea>
</div>

<div>
	<label for="seo-keywords" class="form-label">@lang('admin/seo.fields.keywords')</label>
	<select name="seo[keywords][]" id="seo-keywords" class="w-100" multiple data-toggle="select2" data-tags="true">
		@foreach(old('seo.keywords', isset($seo) ? $seo?->keywords_array ?? [] : []) as $keyword)
			<option value="{{ $keyword }}" selected>{{ $keyword }}</option>
		@endforeach
	</select>
</div>

@push('scripts')
	<script type="text/javascript" src="{{ asset('assets/admin/js/seo/index.js') }}?ver={{ $resourceVersion }}"></script>
@endpush