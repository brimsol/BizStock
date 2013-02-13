<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Starting point of website
 **/
class Welcome extends MY_Controller {

	/**
	 * The constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Login process
	 */
	public function login()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('hashed_password', 'Password', 'required');

		$jsond = array();
		if ($this->form_validation->run() == FALSE)
		{
			$jsond['type'] = 'error';
			$jsond['msg']  = 'Invalid login!';
		}
		else
		{
			$this->load->model('welcome_model');
			$query = $this->welcome_model->login(
				set_value('username'),
				set_value('hashed_password')
			);
			
			if($query == FALSE)
			{
				$jsond['type'] = 'error';
				$jsond['msg']  = 'Invalid username or password!';
			}
			 else
			{
				$query['logedin'] = TRUE;
				$this->session->set_userdata($query);
				$this->welcome_model->update_login(
					$query['idx'],
					date('Y-m-d H:i:s', time()),
					$this->input->ip_address()
				);

				$jsond['type'] = 'success';
				$jsond['msg']  = 'Logedin.';
				$jsond['uri']  = '/board';
			}
			
			$query['logedin'] = TRUE;
			$this->session->set_userdata($query);
		}

		echo json_encode($jsond);
	}
	
	/**
	 * Logout process
	 */
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url(), 'refresh');
	}

	/**
	 * Board page
	 */
	public function board()
	{
		$this->add('app_css', 'pages/board_page');
		$this->set('page', 'pages/dashboard_page');
		$this->render();
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
