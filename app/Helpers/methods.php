<?php

function getSetting(string $settingKey, mixed $defaultValue = null): mixed
{
	return config($settingKey, $defaultValue);
}