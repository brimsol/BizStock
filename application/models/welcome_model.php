<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Model File: welcome_model.php
 * Scope: Login processing
 */
class Welcome_model extends MY_Model
{

	/**
	 * Constructor of this model
	 */
	function __construct()
	{
		parent::__construct('default');
	}

	/**
	 * Login processing
	 *
	 * @param string $username
	 * @param string $hashed_password
	 * @return array|boolean Query data on success, FALSE otherwise
	 */
	function login($username, $hashed_password)
	{
		$query = $this->DB->get_where('users_new', array(
			'username' => $username,
			'hashed_password' => MD5($hashed_password)
		));
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * Update user login details with the given info
	 *
	 * @param int $idx Current user idx value
	 * @param string $current_time Current time
	 * @param string $ip_address User's current IP address
	 */
	function update_login($idx, $current_time, $ip_address)
	{
		$query = $this->DB->update('users_new', array(
			'last_loggedin' => $current_time,
			'last_login_ip' => $ip_address
		), "idx = {$idx}");
	}

}

/* End of file welcome_model.php */
/* Location: ./application/model/welcome_model.php */
