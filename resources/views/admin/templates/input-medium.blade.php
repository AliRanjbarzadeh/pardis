<div class="card mb-3">
	<div class="card-body">
		<div class="input-group">
			<button class="btn btn-outline-primary" type="button" id="btnSelectMedium">
				<span class="tf-icon bx bx-image-alt"></span>
				{{ $name ?? __('admin/global.fields.medium.input') }}
			</button>
			<span id="mediumName" class="form-control d-block overflow-hidden text-nowrap">{{ isset($medium) && !is_null($medium) ? $medium->real_name : __('admin/global.fields.select.medium') }}</span>
			<input type="file" id="medium" class="d-none" name="medium" aria-hidden="true" accept="video/*,image/*">
		</div>
	</div>
</div>

@push('scripts')
	<script type="text/javascript">
		window.addEventListener('DOMContentLoaded', function () {
			let btnSelectMedium = document.getElementById('btnSelectMedium');
			let txtMediumName = document.getElementById('mediumName');
			let inputMedium = document.getElementById('medium');

			inputMedium.addEventListener('change', function () {
				if (inputMedium.files.length > 0) {
					let selectedFile = inputMedium.files[0];
					txtMediumName.innerText = selectedFile.name;
				}
			});

			btnSelectMedium.addEventListener('click', function () {
				inputMedium.click();
			});
		});
	</script>
@endpush