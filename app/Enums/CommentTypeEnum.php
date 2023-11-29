<?php

namespace App\Enums;

enum CommentTypeEnum:string
{
	case Service = "services";
	case Blog = "blogs";
	case Doctor = "doctors";
}
