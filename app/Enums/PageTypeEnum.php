<?php

namespace App\Enums;

enum PageTypeEnum: string
{
	case Generals = "generals";
	case Home = "home";
	case Blogs = "blogs";
	case Clinics = "clinics";
	case Doctors = "doctors";
	case Services = "services";
	case About = "about";
	case Contact = "contact";
}
