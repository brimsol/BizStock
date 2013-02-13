<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Utility helpers
 *
 * To match with uri_string
 * 
 * @var pattern The pattern to be matched
 * @var justclass If TRUE returns only the class name else with class attribute
 * @var default Returns the default value assigned if no match
 * @return class="active" | "active" depending on justclass
 */
if ( ! function_exists('_matches'))
{
	function _matches($pattern, $justclass = FALSE, $default = '')
	{
		if(strlen(uri_string()) <= 0 && strcmp($pattern, "home") == 0){
			if($justclass) return "active"; 
			else return 'class="active"';
		}
		else
		{
			if(preg_match("/{$pattern}/i", uri_string()))
			{
				if($justclass) return "active";
				else return 'class="active"';
			}
			else
			{
				return $default;
			}
		}
	}
}

/**
 * Utility helpers
 *
 * To match with uri_string
 * 
 * @var pattern The pattern to be matched
 * @return TRUE if matches, FALSE otherwise
 */
if ( ! function_exists('_matcheswith'))
{
	function _matcheswith($pattern)
	{
		if(preg_match("/{$pattern}/i", uri_string()))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}