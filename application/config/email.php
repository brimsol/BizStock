<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*********************************************************************
	ACTIVATE ANY ONE EMAIL CONFIG AND UNCOMMENT THE OTHERS
**********************************************************************/

/*
 * Uncomment the following for activating
 * Default email configuration
 */
$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['mailtype'] = 'html';
$config['charset']  = 'iso-8859-1';
$config['wordwrap'] = TRUE;

/*
 * Uncomment the following for activating
 * Gmail SMTP configuration
 */
// $config['protocol']  = 'smtp';
// $config['smtp_host'] = 'ssl://smtp.googlemail.com';
// $config['smtp_port'] = 465;
// $config['smtp_user'] = 'arun.sekhar@01sys.com';
// $config['smtp_pass'] = 'noreply123';
// $config['mailtype']  = 'html';
// $config['wordwrap']  = FALSE;

