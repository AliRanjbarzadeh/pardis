<?php

namespace App\Traits;

use App\DataTransferObjects\CommentDto;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;

trait HasComment
{
	/**
	 * @return MorphMany
	 */
	public function comments(): MorphMany
	{
		return $this->morphMany(Comment::class, 'model');
	}

	/**
	 * @return Collection
	 */
	public function pendingComments(): Collection
	{
		return $this->comments()->where('status', '=', 'pending')->get();
	}

	/**
	 * @return Collection
	 */
	public function approvedComments(): Collection
	{
		return $this->comments()->where('status', '=', 'approved')->get();
	}

	/**
	 * @return Collection
	 */
	public function rejectedComments(): Collection
	{
		return $this->comments()->where('status', '=', 'rejected')->get();
	}

	/**
	 * @param CommentDto $dto
	 *
	 * @return Comment|null
	 */
	public function addComment(CommentDto $dto): ?Comment
	{
		return $this->comments()->create($dto->toArray());
	}

	/**
	 * @param int|array $ids
	 *
	 * @return void
	 */
	public function approveComment(int|array $ids): void
	{
		if (!is_array($ids)) {
			$ids = [$ids];
		}
		$this->comments()
			->whereIn('id', $ids)
			->update([
				'status' => 'approved',
			]);
	}

	/**
	 * @param int|array $ids
	 *
	 * @return void
	 */
	public function rejectComment(int|array $ids): void
	{
		if (!is_array($ids)) {
			$ids = [$ids];
		}
		$this->comments()
			->whereIn('id', $ids)
			->update([
				'status' => 'rejected',
			]);
	}

	/**
	 * @param int|array $ids
	 *
	 * @return int
	 */
	public function deleteComment(int|array $ids): void
	{
		if (!is_array($ids)) {
			$ids = [$ids];
		}
		$this->comments()
			->whereIn('id', $ids)
			->delete();
	}
}