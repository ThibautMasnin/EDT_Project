<?php
class Utility
{
	public static function removeFields(&$array, $unwanted_key)
	{
		// $unwated_key is always 1-dimention array
		if (!empty($array)) {

			foreach ($unwanted_key as $v) {
				foreach ($array as $key => &$value) {
					if ($key == $v) {
						unset($array[$v]);
					}
					if (is_array($value)) {
						self::removeFields($value, $unwanted_key);
					}
				}
			}
		}
	}
}
