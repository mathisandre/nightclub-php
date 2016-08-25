<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MemberModel extends CI_Model {

	/**
 	* Member Model class
 	*
 	*/

	/**
     * Get countries list for members
     *
     * @return object
     *
     */
	public function getCountries() {
		$query = $this->db->select('country')
			   	 ->get('country');
		return $query->result();
	}

	/**
     * Create new member
     *
     * @param $datas datas of the new member
     *
     */
	public function insert($datas) {
		$this->db->insert('members', $datas);
	}

	/**
     * Check if member exist
     *
     * @return object
     *
     */
	public function memberExist($username, $pass) {
		$res = $this->db->select('*')
						->where('username', $username)
						->where('password', $pass)
						->where('payment', 1)
						->get('members');
		return $res->row();
	}

	/**
     * Find member by his id
     *
     * @return object
     *
     */
	public function findById($id) {
		$res = $this->db->select('*')
						->where('id', $id)
						->where('payment', 1)
						->get('members');
		return $res->row();
	}

	/**
     * Check if a member is present to the party
     *
     * @param $id id of the member
     *
     * @return int
     *
     */
	public function partyPresent($id) {
		$res = $this->db->select('*')
						->where('id_member', $id)
						->get('preopening');
		return $res->num_rows();
	}

	/**
     * Check if the member token exist
     *
     * @param $token token of the member
     *
     * @return object|bool
     *
     */
	public function tokenExist($token) {
		$lang = $this->site_lang;
		$name = 'name_'.$lang;

		// Todo make the request 

		$sql = "SELECT members.id, members.username, members.firstname, members.name, members.firstname_women, 
				members.name_women, members.email, members.type, request_party.payment,  request_party.token,
				request_party.id_party, party.$name AS name_evening, party.price, party.id as party_id FROM request_party
			    LEFT JOIN members ON members.id = request_party.id_member 
			    INNER JOIN party ON request_party.id_party = party.id
			    WHERE request_party.token = ?";

		$res = $this->db->query($sql, array($token));

		if($res->num_rows()==0) {
			return false;
		}
		return $res->row();
	}

	/**
     * Check if the member email exist
     *
     * @param $email email of the member
     *
     * @return bool
     *
     */
	public function emailExist($email) {
		$emailResponse = $this->db->select('*')
						->where('email', $email)
				 		->get('members');
		$email = $emailResponse->num_rows();

		if($email!=0) {
			return true;
		}
		return false;
	}

	/**
     * Check if the member username exist
     *
     * @param $username username of the member
     *
     * @return bool
     *
     */
	public function pseudoExist($username) {
		$usernameResponse = $this->db->select('*')
						->where('username', $username)
				 		->get('members');
		$username = $usernameResponse->num_rows();

		if($username!=0) {
			return true;
		}
		return false;
	}

	/**
     * Get members formules
     *
     * @param $lang current lang of the member
     *
     * @return object
     *
     */
	public function getFormules($lang) {
		$title = 'title_'.$lang;
		$text = 'text_'.$lang;

		$res = $this->db->select("$title AS title, $text AS text")
				 		->get('become_member');

		return $res->result();
	}

	/**
     * Get members formules (VIP)
     *
     * @param $lang current lang of the member
     *
     * @return object
     *
     */
	public function getVipFormules($lang) {
		$title = 'title_'.$lang;
		$text = 'text_'.$lang;

		$res = $this->db->select("$title AS title, $text AS text")
				 		->get('formules_vip');

		return $res->result();	
	}

	/**
     * Get members text of formules by type of member
     *
     * @param $lang current lang of the member
     * @param $type current type of the member
     *
     * @return object
     *
     */
	public function getTextByType($lang, $type) {
		$title = 'title_'.$lang;
		$text = 'text_'.$lang;

		$res = $this->db->select("$title AS title, $text AS text")
						->where('type', $type)
						->get('become_member');
		return $res->row();
	}
}