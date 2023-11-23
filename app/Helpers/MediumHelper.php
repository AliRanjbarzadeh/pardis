<?php

namespace App\Helpers;

use App\Exceptions\MediaException;
use App\Models\Medium;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class MediumHelper
{
	protected Collection $fileTypes;
	protected array $subSizes;

	public function __construct()
	{
		$this->fileTypes = collect(['image', 'video', 'audio']);
		$this->subSizes = config('media.sub_sizes');
	}

	public function setSizes(array $sizes): void
	{
		$this->subSizes = $sizes;
	}

	/**
	 * @param UploadedFile $file
	 * @param string $path
	 *
	 * @return Medium|null
	 */
	public function upload(UploadedFile $file, string $path = ''): ?Medium
	{
		try {
			$path = $this->getPath($path);
			$fileName = $this->generateFileName($file);

			//save file in path
			$file->storeAs($path, $fileName[1], ['disk' => $this->getMediaDisk()]);

			$medium = new Medium([
				'real_name' => $file->getClientOriginalName(),
				'name' => $fileName[0],
				'file_name' => $fileName[1],
				'path' => $path . $fileName[1],
				'mime_type' => $file->getMimeType(),
				'size' => $file->getSize(),
				'disk' => $this->getMediaDisk(),
				'sizes' => null,
			]);

			//save sub sizes if image
			if ($this->isResizableImage($file)) {
				$mediumSizes = collect();
				foreach ($this->subSizes as $key => $subSize) {
					$newPath = Storage::disk($this->getMediaDisk())->path($path);
					$image = Image::make($newPath . $fileName[1])->orientate();
					$width = $image->getWidth();
					$height = $image->getHeight();

					$newWidth = $subSize['width'];
					$newHeight = $subSize['height'];

					if (!$subSize['crop']) {
						if ($width >= $height) {
							if ($subSize['width'] >= $subSize['height']) {
								$newHeight = round(($height / $width) * $subSize['width']);
							} else {
								$newWidth = round(($width / $height) * $subSize['height']);
							}
						} else {
							if ($subSize['height'] >= $subSize['width']) {
								$newWidth = round(($width / $height) * $subSize['height']);
							} else {
								$newHeight = round(($height / $width) * $subSize['width']);
							}
						}
					}

					$subSizePath = $this->getSubSizePath($newPath, $newWidth, $newHeight, $fileName[0], $file->extension());
					if ($subSize['crop']) {
						$image->fit($subSize['width'], $subSize['height'])->save($subSizePath);
					} else {
						$image->resize($newWidth, $newHeight)->save($subSizePath);
					}
					$dbSubSizePath = $this->getSubSizePath($path, $newWidth, $newHeight, $fileName[0], $file->extension());
					$mediumSizes->put($key, $dbSubSizePath);
				}

				//set sub sizes
				$medium->sizes = $mediumSizes->toArray();
			}

			//save medium in database
			$medium->save();

			return $medium;
		} catch (\Exception $e) {
			Log::error($e->getMessage(), $e->getTrace());
			return null;
		}
	}

	/**
	 * @param array|int $ids
	 *
	 * @return void
	 * @throws MediaException
	 */
	public function remove(array|int $ids): void
	{
		if (empty($ids)) {
			throw new MediaException("No id provided to remove");
		}

		if (!is_array($ids)) {
			$ids = [$ids];
		}

		try {
			Medium::whereIn('id', $ids)
				->get()
				->map(function (Medium $medium) {
					Storage::disk($this->getMediaDisk())->delete($medium->path);
					if (!empty($medium->sizes_paths)) {
						foreach ($medium->sizes_paths as $path) {
							Storage::disk($this->getMediaDisk())->delete($path);
						}
					}

					$medium->delete();
				});
		} catch (\Exception $e) {
			throw new MediaException($e->getMessage());
		}
	}

	public function url(string $path): string
	{
		return url(Storage::disk($this->getMediaDisk())->url($path));
	}

	protected function getPath(string $path = ''): string
	{
		return $this->prepareUploadPath($path) . '/';
	}

	/**
	 * @param UploadedFile $file
	 *
	 * @return array[0 => fileNameWithoutExt, 1 => fileWithExt]
	 */
	protected function generateFileName(UploadedFile $file): array
	{
		$mimeType = $file->getMimeType();
		$fileType = Str::before($mimeType, '/');

		if (!$this->fileTypes->contains($fileType)) {
			$fileType = 'file';
		}

		$newFileName = uniqid("{$fileType}_");

		return [
			$newFileName,
			"$newFileName.{$file->extension()}",
		];
	}

	protected function prepareUploadPath(string $path = ''): string
	{
		$today = now();
		if (!Storage::disk($this->getMediaDisk())->exists($this->getUploadPath())) {
			Storage::disk($this->getMediaDisk())->makeDirectory($this->getUploadPath());
		}

		if (!Storage::disk($this->getMediaDisk())->exists($this->getUploadPath($path))) {
			Storage::disk($this->getMediaDisk())->makeDirectory($this->getUploadPath($path));
		}

		$path .= "/{$today->format('Ymd')}";
		if (!Storage::disk($this->getMediaDisk())->exists($this->getUploadPath($path))) {
			Storage::disk($this->getMediaDisk())->makeDirectory($this->getUploadPath($path));
		}

		return $this->getUploadPath($path);
	}

	protected function getUploadPath(string $path = ''): string
	{
		$path = trim($path, '/');
		if (!empty($path)) {
			return trim(config('media.upload_folder'), '/') . "/$path";
		}
		return trim(config('media.upload_folder'), '/');
	}

	protected function getMediaDisk(): string
	{
		return config('media.disk');
	}

	protected function isResizableImage(UploadedFile $file): bool
	{
		if (Str::startsWith($file->getMimeType(), 'image') && !in_array($file->extension(), ['svg', 'gif'])) {
			return true;
		}
		return false;
	}

	protected function getSubSizePath(string $path, int $width, int $height, string $fileName, string $fileExtension): string
	{
		return "{$path}{$fileName}-{$width}x{$height}.{$fileExtension}";
	}
}