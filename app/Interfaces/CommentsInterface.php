<?php

namespace App\Interfaces;

use App\DataTransferObjects\CommentDto;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;

interface CommentsInterface
{
	public function comments(): MorphMany;

	public function pendingComments(): Collection;

	public function approvedComments(): Collection;

	public function rejectedComments(): Collection;

	public function addComment(CommentDto $dto): ?Comment;

	public function approveComment(int|array $ids): void;

	public function rejectComment(int|array $ids): void;

	public function deleteComment(int|array $ids): void;
}