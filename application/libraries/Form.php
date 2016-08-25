<?php

class Form {

	/**
 	* Form library class
 	*
 	*/

	private $CI; 

	/**
	 *
     * Constructor
     */
	public function __construct() {
		$this->CI = &get_instance();
	}

	/**
	 *
     * @param $array valid fields
     */
	public function fillFields($array=array()) 
	{
		foreach($_POST as $k => $v) {
			if(in_array($k, $array)) continue;
			$this->CI->session->set_flashdata($k, $v);
		}
	}
}