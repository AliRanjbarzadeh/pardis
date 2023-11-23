<div class="card mb-3">
	<div class="card-body">
		<div class="input-group">
			<button class="btn btn-outline-primary" type="button" id="btnSelectIconImage">
				<span class="tf-icon bx bx-image-alt"></span>
				{{ $name ?? __('admin/global.words.image.icon') }}
			</button>
			<span id="iconImageName" class="form-control d-block overflow-hidden text-nowrap">{{ isset($iconImage) ? $iconImage->real_name : __('admin/global.fields.select.image') }}</span>
			<input type="file" id="iconImage" class="d-none" name="iconImage" aria-hidden="true" accept="image/*">
		</div>
	</div>
	<img id="imgIconImage" class="img-thumbnail mb-3 @if(!isset($iconImage)) d-none @endif m-auto px-4" alt="" src="{{ isset($iconImage) ? $iconImage->url : '' }}">
</div>

@push('scripts')
	<script type="text/javascript">
		window.addEventListener('DOMContentLoaded', function () {
			let btnIconImage = document.getElementById('btnSelectIconImage');
			let txtIconImage = document.getElementById('iconImageName');
			let inputIconImage = document.getElementById('iconImage');
			let imgIconImage = document.getElementById('imgIconImage');

			inputIconImage.addEventListener('change', function () {
				if (inputIconImage.files.length > 0) {
					let selectedFile = inputIconImage.files[0];
					txtIconImage.innerText = selectedFile.name;

					let fileReader = new FileReader();
					fileReader.onload = function () {
						imgIconImage.src = fileReader.result;
						imgIconImage.classList.remove('d-none');
					}
					fileReader.readAsDataURL(selectedFile);
				}
			});

			btnIconImage.addEventListener('click', function () {
				inputIconImage.click();
			});
		});
	</script>
@endpush