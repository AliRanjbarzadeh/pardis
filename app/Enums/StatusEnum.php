<?php

namespace App\Enums;

enum StatusEnum: string
{
	case Pending = 'pending';
	case Approved = 'approved';
	case Rejected = 'rejected';
	case Answered = 'answered';
	case Active = 'active';
	case Disable = 'disable';
}
