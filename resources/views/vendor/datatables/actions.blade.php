<div class="btn-group">
	@foreach($actions as $action)
		<a href="{{ $action['isButton'] ? 'javascript:void(0)' : $action['url'] }}" class="btn btn-light" data-url="{{ $action['url'] }}" @if(isset($action['onclick'])) onclick="{{ $action['onclick'] }}" @endif @if(isset($action['extraData'])) {{ $action['extraData'] }} @endif data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $action['title'] }}">
			<i class="{{ $action['icon'] }}"></i>
		</a>
	@endforeach
</div>