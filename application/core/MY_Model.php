<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * File: MY_Model.php
 * Scope: Core Model Class
 */
class MY_Model extends CI_Model
{

	/**
	 * Constructor of this model
	 *
	 * @param string $database The database to be connected. By default connects to 'default' database
	 */
	function __construct($database = 'default')
	{
		parent::__construct();
		$this->load->database($database);
		$this->DB = $this->db;
	}

}

/* End of file MY_Model.php */
/* Location: ./application/core/MY_Model.php */
