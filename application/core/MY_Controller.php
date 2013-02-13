<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * File: MY_Controller.php
 * Scope: Core Controller Class
 *
 * Basic utilities methods inside
 * 1. $this->template = "main_template";
 * 2. $this->set('key', 'value');
 * 3. $this->add('key', 'value');
 * 4. $this->render();
 * 5. $this->loguser(); // Log file: log/access.txt
 */
class MY_Controller extends CI_Controller {

	/**
	 * Template view
	 * @var string
	 */
	protected $template = "main_template";

	/**
	 * User logedin TRUE|FALSE
	 * @var boolean
	 */
	protected $logedin = FALSE;

	/**
	 * Data array for the views
	 * @var array
	 */
	protected $data = array(
		'title' => '::01Sys-BISTOCK::'
	);

	/**
	 * Base Constructor of the project
	 */
	public function __construct()
	{
		parent::__construct();

		$this->data['session'] = $this->session->all_userdata();
		// -- Login check --
		$this->data['logedin'] = $this->logedin = $this->session->userdata('logedin');
		if($this->logedin == FALSE && strlen(uri_string()) > 0 && !preg_match("/(welcome)|(user_controller)/i", uri_string()))
		{
			redirect(base_url(), 'refresh');
		} // -- End: Login check --

		//$this->output->enable_profiler(TRUE);
	}

	/**
	 * Defaut index function
	 */
	public function index()
	{
		$this->set('page', 'pages/welcome_page');
		$this->set('main_navbar', '');
		$this->add('app_js', 'pages/welcome_page');

		$this->render();
		//$this->_loguser();
	}

	/**
	 * Main template rendering
	 */
	protected function render()
	{
		$this->load->view($this->template, $this->data);
	}

	/**
	 * Sets the key value pair inside $data variable
	 *
	 * @param string $key Key to set
	 * @param mixed $val Value to set
	 */
	protected function set($key, $val)
	{
		$this->data[$key] = $val;
	}

	/**
	 * Adds the key value pair inside $data variable
	 *
	 * @param string $key Key to set
	 * @param mixed $val Value to be added
	 */
	protected function add($key, $val)
	{
		if(isset($this->data[$key]))
		{
			if(is_array($this->data[$key]))
			{
				array_push($this->data[$key], $val);					
			}
			else
			{
				$this->set($key, array($this->data[$key]));
				array_push($this->data[$key], $val);
			}
		}
		else
		{
			$this->set($key, array($val));
		}
	}
	
	/**
	 * Private user access logger
	 * Log file at application/logs/access.txt
	 */
	/*
	protected function _loguser()
		{
			$ip = $this->input->ip_address();
			$dt = standard_date('DATE_W3C', time());
	
			$agent = 'Unidentified User Agent';
			if ($this->agent->is_browser())
			{
				$agent = $this->agent->browser().' '.$this->agent->version();
			}
			elseif ($this->agent->is_robot())
			{
				$agent = $this->agent->robot();
			}
			elseif ($this->agent->is_mobile())
			{
				$agent = $this->agent->mobile();
			}
	
			$platform = $this->agent->platform();
			$referrer = $this->agent->referrer();
	
			$data = "$ip	$dt\n$platform		$agent\n		$referrer\n\n";
			if ( ! write_file('./application/logs/access.txt', $data, 'a'))
			{
				echo 'Unable to write the file';
			}
		}*/
	

}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
