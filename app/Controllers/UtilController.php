<?php namespace App\Controllers;


class UtilController extends BaseController
{
	public static function isnullOrEmpty($strVal)
	{
		if(is_null($strVal) || empty($strVal))
		{
			return true;
		}

		return false;
	}

	public static function isEmailValid($strVal)
	{
		if(is_null($strVal) || empty($strVal))
		{
			return false;
		}
		return filter_var($strVal,FILTER_VALIDATE_EMAIL);
	}
}