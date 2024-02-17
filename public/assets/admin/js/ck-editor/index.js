"use strict";
window.addEventListener('DOMContentLoaded', function () {
	const watchdog = new CKSource.EditorWatchdog();
	window.watchdog = watchdog;
	watchdog.setCreator((element, config) => {
		return CKSource.Editor
			.create(element, config)
			.then(editor => {
				return editor;
			});
	});

	watchdog.setDestructor(editor => {
		return editor.destroy();
	});

	watchdog.on('error', handleSampleError);


	const editors = document.querySelectorAll('[data-toggle="ck-editor"]');
	for (const editor of editors) {
		watchdog.create(editor, {
			// Editor configuration.
			toolbar: {
				shouldNotGroupWhenFull: true
			},
			simpleUpload: {
				uploadUrl: route('admin.media.ckeditor'),
				withCredentials: true,
				headers: {
					'X-CSRF-TOKEN': csrfToken(),
				}
			},
			htmlSupport: {
				allow: [
					{
						name: /.*/,
						attributes: true,
						classes: true,
						styles: true
					}
				]
			}
		}).catch(handleSampleError);
	}
});

function handleSampleError(error) {
	const issueUrl = 'https://github.com/ckeditor/ckeditor5/issues';

	const message = [
		'Oops, something went wrong!',
		`Please, report the following error on ${issueUrl} with the build id "8ku0fmrv93i-t5yhonyf69zy" and the error stack trace:`
	].join('\n');

	console.error(message);
	console.error(error);
}