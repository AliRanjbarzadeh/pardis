<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\MediaException;
use App\Facades\Media;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MediaController extends Controller
{
	public function upload(Request $request)
	{

	}

	public function ckEditor(Request $request)
	{
		try {
			$medium = Media::upload($request->file('upload'));
			$sizes = array_merge($medium->sizes, ['default' => $medium->url]);
			return response()->json(['urls' => $sizes]);
		} catch (\Exception $e) {
			return response()->json(['error' => ['message' => __('admin/media.errors.upload')]]);
		}
	}

	public function dropzone(Request $request)
	{
		$request->validate([
			'file' => 'required|file',
		]);

		try {
			$medium = Media::upload($request->file('file'));
			return response()->json($medium);
		} catch (\Exception $e) {
			return response()->json(__('admin/media.errors.upload'), 400);
		}
	}

	public function destroy(Request $request, int $id)
	{
		try {
			Media::remove($id);
			return response()->json(__('admin/media.sentences.removed'));
		} catch (MediaException $e) {
			return response()->json($e->getMessage(), 400);
		}
	}
}
