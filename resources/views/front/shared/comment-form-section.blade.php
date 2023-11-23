<strong class="text-gray-350 text-xl mb-5 block mt-7">ثبت دیدگاه</strong>
<div class="rounded-lg shadow-md bg-white p-5 mb-4 md:mb-0">
	<form action="{{ $action }}" method="post">
		@csrf

		<div class="form-item mb-5">
			<label for="comment" class="block mb-3">
				نظر شما
			</label>
			<textarea class="placeholder:text-gray-300 w-full rounded-lg border border-[#CECECE] p-3" placeholder="حداقل 10 کارکتر باید تایپ کنید ..." name="comment" id="comment" rows="7"></textarea>
		</div>
		<div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
			<div class="form-item">
				<label for="name" class="block mb-3">
					نام و نام خانوادگی
				</label>
				<input name="name" id="name" class="placeholder:text-gray-300 w-full rounded-lg border border-[#CECECE] px-3 py-2" type="text" placeholder="مثلا رضا کمالزاده">
			</div>
			<div class="form-item">
				<label for="email" class="block mb-3">
					پست الکترونیک
				</label>
				<input name="email" id="email" class="placeholder:text-gray-300 w-full rounded-lg border border-[#CECECE] px-3 py-2" type="text" placeholder="EXAMPLE@DOMAIN.COM">
			</div>
		</div>
		<div class="flex justify-between mt-8 mb-1 items-center">
			<button type="submit" class="btn btn-primary px-9 py-2">
				ثبت نظر
			</button>
			<span class="opacity-60">نشانی ایمیل شما منتشر نخواهد شد.</span>
		</div>

		<input type="hidden" name="model_type" value="{{ $modelType }}">
	</form>
</div>
