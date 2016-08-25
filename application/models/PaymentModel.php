<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class PaymentModel extends CI_Model { 
	/**
 	* Payment Model class
 	*
 	*/

	/**
     * Check if the payment token exist
     *
     * @param $token token of the payment
     *
     * @return object
     *
     */
	public function exist($token) 
	{
		$res = $this->db->select('*')
			   	 	->where('token', $token)
			   	 	->get('members');
		return $res->row();
	}
}