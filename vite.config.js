import {resolve} from 'path';
import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import {createRequire} from 'node:module';
const require = createRequire( import.meta.url );
import ckeditor5 from '@ckeditor/vite-plugin-ckeditor5';

export default defineConfig({
	plugins: [
		laravel({
			input: [
				//Main
				'resources/css/app.scss',
				'resources/js/app.js',

				//Pages js
				'resources/js/pages/home/home.js',
				'resources/js/pages/clinics/detail.js',
				'resources/js/pages/doctors/index.js',
				'resources/js/pages/doctors/detail.js',
				'resources/js/pages/insurances/index.js',
				'resources/js/pages/about/index.js',
				'resources/js/pages/contact/index.js',

				//Pages css
				'resources/css/pages/blog/blog-details.scss',
				'resources/css/pages/doctor/doctor-details.scss',

				//Shared
				'resources/js/shared/limited-paragraph.js',
				'resources/js/shared/photo-gallery.js',

				//Admin
				'public/assets/admin/js/ck-editor/index-vite.js',
			],
			refresh: true,
		}),
		ckeditor5( { theme: require.resolve( '@ckeditor/ckeditor5-theme-lark' ) } )
	],
	resolve: {
		alias: {
			'@theme': resolve(__dirname, './resources/theme'),
			'@assets': resolve(__dirname, './public/assets/front'),
			'@sharedJs': resolve(__dirname, './resources/js/shared'),
		}
	},
});
