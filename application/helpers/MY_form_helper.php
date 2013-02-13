<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Overwrite CI method. 
 * Has the same functionality with some added hacks to allow array indexes
 * e.g. set_value('someArray[color]') works as expected if you used name="someArray[color]"
 *
 * @param    string    the field name
 * @param    string
 * @return   void
 */
if ( ! function_exists('get_value'))
{
	function get_value($field = '', $default = '')
	{
		preg_match('~([^\[]+)(\[(.*)\])?~', $field, $matches);
		$varName = $matches[1];

		// check if we're provided with an array name
		if (!empty($matches[2])) {
			// rebuild the array name expected by CI
			$varName = $matches[1] . '[]';
			$arrKey = '';
			// check if we also have a specific array key
			if (!empty($matches[3])) {
				$arrKey = $matches[3];
			}
		}
		if (!isset($this->_field_data[$varName])) {
			return $default;
		}

		if (is_array($this->_field_data[$varName]['postdata'])) {

			if (!empty($arrKey)) {
				if (isset($this->_field_data[$varName]['postdata'][$arrKey])) {
					$result = $this->_field_data[$varName]['postdata'][$arrKey];
				} else {
					// $result = print_r($default, true);
					$result = $default;
				}
			} else {
				// allow standard CI behaviour
				$result = array_shift($this->_field_data[$field]['postdata']);
			}
			return $result;
		}

		return $this->_field_data[$field]['postdata'];
	} 
}
