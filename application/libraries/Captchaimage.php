<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Captcha varification
 *
 *
 * @package libraries
 * @author Mahesh Kumar Nayak
 * @version 0.1
 */
class Captchaimage
{

	/**
	 * Constructor of Captchaimage library
	 */
	public function __construct()
	{
		require_once './application/libraries/securimage/securimage.php';
	}

	/**
	 * Renders the captcha image
	 */
	public function render_image()
	{
		$CI =& get_instance();
		$CI->output->set_header("Pragma: no-cache");
		$image = new Securimage();
		$image->show();
	}
	
	/**
	 * Returns the captcha code in session data
	 *
	 * @return Captcha code in session
	 */
	public function get_code()
	{
		$image = new Securimage();
		return $image->getCode();
	}

}
