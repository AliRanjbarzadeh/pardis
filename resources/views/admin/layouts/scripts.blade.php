<!-- Jquery -->
<script src="{{ asset("assets/admin/vendor/libs/jquery/jquery.js") }}"></script>

<!-- Setup CSRF Token for ajax -->
<script>
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	function csrfToken() {
		return "{{ csrf_token() }}";
	}
</script>

<!-- Core JS -->
<script type="text/javascript" src="{{ asset("assets/admin/vendor/libs/popper/popper.js") }}"></script>
<script type="text/javascript" src="{{ asset("assets/admin/vendor/js/bootstrap.js") }}"></script>
<script type="text/javascript" src="{{ asset("assets/admin/vendor/libs/perfect-scrollbar/perfect-scrollbar.js") }}"></script>
<script type="text/javascript" src="{{ asset("assets/admin/vendor/js/menu.js") }}"></script>

<!-- Dynamic resources -->
<script type="text/javascript" src="{{ asset("assets/shared/js/translations-" . config('app.locale') . ".js") }}?ver={{ $resourceVersion }}"></script>
<script type="text/javascript" src="{{ asset("assets/shared/js/router-" . config('app.locale') . ".js") }}?ver={{ $resourceVersion }}"></script>

<!-- Vendors JS -->
<script type="text/javascript" src="{{ asset("assets/admin/vendor/libs/apex-charts/apexcharts.js") }}"></script>
<script type="text/javascript" src="{{ asset("assets/admin/vendor/libs/jalali-datepicker/jalalidatepicker.min.js") }}"></script>

<!-- Datatables -->
<script type="text/javascript" src="{{ asset("assets/admin/vendor/libs/datatables/datatables.min.js") }}"></script>
<script type="text/javascript" src="{{ asset("assets/admin/vendor/libs/datatables/datatables/js/dataTables.bootstrap5.min.js") }}"></script>
@include('datatables::extra-scripts')

<!-- Select2 -->
<script type="text/javascript" src="{{ asset("assets/admin/vendor/libs/select2/js/select2.min.js") }}"></script>
<script type="text/javascript" src="{{ asset("assets/admin/vendor/libs/select2/js/i18n/fa.js") }}"></script>

<!-- Toastr -->
<script type="text/javascript" src="{{ asset("assets/admin/vendor/libs/toastr/toastr.min.js") }}"></script>
<script type="text/javascript" src="{{ asset("assets/admin/vendor/libs/toastr/toastr-options.js") }}?ver={{ $resourceVersion }}"></script>

<!-- Axios -->
<script type="text/javascript" src="{{ asset("assets/admin/vendor/libs/axios/axios.min.js") }}"></script>
<script type="text/javascript" src="{{ asset("assets/admin/vendor/libs/axios/axios-defaults.js") }}?ver={{ $resourceVersion }}"></script>

<!-- CKEditor -->
<script type="text/javascript" src="{{ asset("assets/admin/vendor/libs/ck-editor/ckeditor.js") }}"></script>

<!-- Dropzone -->
<script type="text/javascript" src="{{ asset('assets/admin/vendor/libs/dropzone/dropzone.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/admin/vendor/libs/dropzone/options.js') }}"></script>

<!-- Neshan -->
<script type="text/javascript" src="https://static.neshan.org/sdk/leaflet/v1.9.4/neshan-sdk/v1.0.8/index.js"></script>

<!-- Main JS -->
<script type="text/javascript" src="{{ asset("assets/admin/js/main.js") }}?ver={{ $resourceVersion }}"></script>
<script type="text/javascript" src="{{ asset("assets/admin/js/default-actions.js") }}?ver={{ $resourceVersion }}"></script>
<script type="text/javascript" src="{{ asset("assets/admin/js/vendors-defaults.js") }}?ver={{ $resourceVersion }}"></script>