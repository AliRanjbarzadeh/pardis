@extends('front.layouts.master')

@section('content')
	<main>
		<div class="flex justify-center flex-col items-center w-full mb-12">
			<img class="h-auto md:h-[400px] block mb-4 object-contain" src="{{ asset('assets/front/images/error-404.png') }}" alt="">
			<p class="mb-5 text-lg font-bold">
				صفحه‌ای که دنبال آن بودید پیدا نشد!
			</p>
			<a href="{{ route('index') }}" class="btn btn-primary px-3 py-2">
				بازگشت به خانه
			</a>
		</div>
	</main>
@endsection