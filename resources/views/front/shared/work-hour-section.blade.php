<div class="shadow-md bg-white rounded-md">
	<ul>
		@foreach($workHours as $workHour)
			<li class="last:border-b-0 border-b border-gray-50">
				<div class="py-3 px-4 flex items-stretch justify-between text-gray-400">
					<strong>{{ $workHour['title'] }}</strong>
					<div class="text-primary-950 flex items-center text-xs">
						@if(isset($workHour['first']))
							<div>@lang('front/work_hour.sentences.shift', ['from' => $workHour['first']['from'], 'to' => $workHour['first']['to']])</div>
						@endif

						@if(isset($workHour['second']))
							<div class="w-[2px] bg-black bg-opacity-20 h-full block mx-2"></div>
							<div>@lang('front/work_hour.sentences.shift', ['from' => $workHour['second']['from'], 'to' => $workHour['second']['to']])</div>
						@endif
					</div>
				</div>
			</li>
		@endforeach
	</ul>
</div>