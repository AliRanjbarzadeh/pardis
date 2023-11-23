<!-- Delete modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="bx bx-trash text-danger me-2"></i> @lang('admin/global.sentences.delete.default.title')</h5>
				<button type="button" class="btn-close new-style10" data-bs-dismiss="modal" aria-label="@lang('admin/global.actions.close')"></button>
			</div>
			<div class="modal-body">
				@lang('admin/global.sentences.delete.default.description')
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">@lang('admin/global.actions.close')</button>
				<button id="btnDeleteModal" type="button" class="btn btn-danger">
					<i class="bx bx-trash"></i>
					@lang('admin/global.words.delete.default')
				</button>
			</div>
		</div>
	</div>
</div>

<!-- Approve modal -->
<div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="bx bx-check text-success me-2"></i> @lang('admin/global.sentences.approve.default.title')</h5>
				<button type="button" class="btn-close new-style10" data-bs-dismiss="modal" aria-label="@lang('admin/global.actions.close')"></button>
			</div>
			<div class="modal-body">
				@lang('admin/global.sentences.approve.default.description')
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">@lang('admin/global.actions.close')</button>
				<button id="btnApproveModal" type="button" class="btn btn-success">
					<i class="bx bx-check"></i>
					@lang('admin/global.words.approve.default')
				</button>
			</div>
		</div>
	</div>
</div>

<!-- Reject modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="bx bx-x text-danger me-2"></i> @lang('admin/global.sentences.reject.default.title')</h5>
				<button type="button" class="btn-close new-style10" data-bs-dismiss="modal" aria-label="@lang('admin/global.actions.close')"></button>
			</div>
			<div class="modal-body">
				@lang('admin/global.sentences.reject.default.description')
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">@lang('admin/global.actions.close')</button>
				<button id="btnRejectModal" type="button" class="btn btn-danger">
					<i class="bx bx-x"></i>
					@lang('admin/global.words.reject.default')
				</button>
			</div>
		</div>
	</div>
</div>

<!-- Show modal -->
<div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="bx bxs-comment-error text-danger"></i> @lang('admin/global.words.reject.show')</h5>
				<button type="button" class="btn-close new-style10" data-bs-dismiss="modal" aria-label="@lang('admin/global.actions.close')"></button>
			</div>
			<div class="modal-body" id="showBody"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">@lang('admin/global.actions.close')</button>
			</div>
		</div>
	</div>
</div>