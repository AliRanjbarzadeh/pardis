<?php

namespace App\Enums;

enum StatusEnum: string
{
	case Pending = 'pending';
	case Approved = 'approved';
	case Rejected = 'rejected';
	case Answered = 'answered';
}
