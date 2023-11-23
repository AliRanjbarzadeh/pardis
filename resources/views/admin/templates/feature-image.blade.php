<div class="card mb-3">
	<div class="card-body">
		<div class="input-group">
			<button class="btn btn-outline-primary" type="button" id="btnSelectFeatureImage">
				<span class="tf-icon bx bx-image-alt"></span>
				{{ $name ?? __('admin/global.words.image.feature') }}
			</button>
			<span id="featureImageName" class="form-control d-block overflow-hidden text-nowrap">{{ isset($featureImage) && !is_null($featureImage) ? $featureImage->real_name : __('admin/global.fields.select.image') }}</span>
			<input type="file" id="featureImage" class="d-none" name="featureImage" aria-hidden="true" accept="image/*">
		</div>
	</div>
	<img id="imgFeatureImage" class="img-thumbnail mb-3 @if(!isset($featureImage) || is_null($featureImage)) d-none @endif m-auto px-4" alt="" src="{{ isset($featureImage) && !is_null($featureImage) ? $featureImage->url : '' }}">
</div>

@push('scripts')
	<script type="text/javascript">
		window.addEventListener('DOMContentLoaded', function () {
			let btnFeatureImage = document.getElementById('btnSelectFeatureImage');
			let txtFeatureImage = document.getElementById('featureImageName');
			let inputFeatureImage = document.getElementById('featureImage');
			let imgFeatureImage = document.getElementById('imgFeatureImage');

			inputFeatureImage.addEventListener('change', function () {
				if (inputFeatureImage.files.length > 0) {
					let selectedFile = inputFeatureImage.files[0];
					txtFeatureImage.innerText = selectedFile.name;

					let fileReader = new FileReader();
					fileReader.onload = function () {
						imgFeatureImage.src = fileReader.result;
						imgFeatureImage.classList.remove('d-none');
					}
					fileReader.readAsDataURL(selectedFile);
				}
			});

			btnFeatureImage.addEventListener('click', function () {
				inputFeatureImage.click();
			});
		});
	</script>
@endpush