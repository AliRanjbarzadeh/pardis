@extends('admin.layouts.master')

@section('content')
	<div class="card">
		<div class="card-body">
			@datatablesFilters
			{{ $dataTable->table() }}
		</div>
	</div>
@endsection

@push('scripts')
	{{ $dataTable->scripts() }}
@endpush
