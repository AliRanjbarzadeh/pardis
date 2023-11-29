<strong class="text-gray-350 text-xl mb-5 block mt-7">ثبت دیدگاه</strong>
<div class="rounded-lg shadow-md bg-white p-5 mb-4 md:mb-0">
	<form action="{{ $action }}" method="post">
		@csrf

		<div class="form-item mb-5">
			<label for="body" class="block mb-3">@lang('front/comment.fields.body')</label>
			<textarea class="placeholder:text-gray-300 w-full rounded-lg border border-[#CECECE] p-3" placeholder="@lang('front/comment.placeholders.body')" name="body" id="body" rows="7"></textarea>
		</div>
		<div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
			<div class="form-item">
				<label for="full_name" class="block mb-3">@lang('front/comment.fields.full_name')</label>
				<input name="full_name" id="full_name" class="placeholder:text-gray-300 w-full rounded-lg border border-[#CECECE] px-3 py-2" type="text" placeholder="@lang('front/comment.placeholders.full_name')">
			</div>
			<div class="form-item">
				<label for="email" class="block mb-3">@lang('front/comment.fields.email')</label>
				<input name="email" id="email" class="placeholder:text-gray-300 w-full rounded-lg border border-[#CECECE] px-3 py-2" type="text" placeholder="@lang('front/comment.placeholders.email')">
			</div>
		</div>
		<div class="flex justify-between mt-8 mb-1 items-center">
			<button type="submit" class="btn btn-primary px-9 py-2">@lang('front/comment.words.save')</button>
			<span class="opacity-60">@lang('front/comment.sentences.privacy')</span>
		</div>

		<input type="hidden" name="model_type" value="{{ $modelType }}">
	</form>
</div>
