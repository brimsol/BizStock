<?php
$this->load->view('cuts/page_start');
$this->load->view('cuts/head');
$this -> load -> view('cuts/nav.php');
//$this -> load -> view('cuts/header.php');
$this->load->view('cuts/container_start');

$this->load->view($page);

$this->load->view('cuts/container_end');
$this->load->view('cuts/footer');
$this->load->view('cuts/page_end');
?>
