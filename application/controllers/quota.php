<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Quota extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this -> load -> model('product_model');
		$this -> load -> model('quota_model');
		session_start();
		parent::__construct();
		if (!isset($_SESSION['username'])) {
			redirect('admin');
		}
	}

	function getProductQuota() {
		$keyword = $this -> input -> post('term');
		$rc_type = $this -> input -> post('rc_type');
		if ($rc_type == 'APL') {
			$query = $this -> quota_model -> getProductQuota($keyword);
			$data['response'] = 'true';
			if ($query -> num_rows() > 0) {
				$row = $query -> row();
				$data = array('pdt_quota' => $row -> apl_quota);
				echo json_encode($data);
			} else {
				$data = array('pdt_quota' => 'Unlimited');
				echo json_encode($data);
			}
		} else {
			$query = $this -> quota_model -> getProductQuota($keyword);
			$data['response'] = 'true';
			if ($query -> num_rows() > 0) {
				$row = $query -> row();
				$data = array('pdt_quota' => $row -> bpl_quota);
				echo json_encode($data);
			} else {
				$data = array('pdt_quota' => 'Unlimited');
				echo json_encode($data);
			}
		}
	}

}
