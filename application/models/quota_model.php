<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Quota_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this -> load -> database();
	}

	function getProductQuota($id) {
		$this -> db -> limit(1);
		$query = $this -> db -> get('quota_mode');

		foreach ($query->result() as $row) {
			$mode = $row -> quota_mode;
		}
		if ($mode == 'normal') {
			$this -> db -> where('pdt_id', $id);
			return $this -> db -> get('normal_quota');
		} elseif ($mode == 'festival') {
			$this -> db -> where('pdt_id', $id);
			return $this -> db -> get('festival_quota');
		}
	}

}
