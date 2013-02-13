<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Week_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this -> load -> database();
	}

	function getCurrentWeekNumber() {
		$this -> db -> order_by('week_num', 'desc');
		return $this -> db -> get('week_range');
	}

	function insert_week_num($new_week_num, $new_start_date, $new_end_date) {
		$data = array('week_num' => $new_week_num, 'start_ts' => $new_start_date, 'end_ts' => $new_end_date, );
		$this -> db -> insert('week_range', $data);
	}
}
