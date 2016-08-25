<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends Lang {

	/*
    |--------------------------------------------------------------------------
    | Member Controller
    |--------------------------------------------------------------------------
    |
    | This controller is about members system for the application and
    | redirecting them to their home screen, creating them their account. 
    | The controller uses Lang class to translate the informations for them  
    |
    */

    /**
     * The attribute that should be take to get countries
     *
     * @var string
     */
	private $countries;
	/**
     * The attribute that should be take to get formulary
     *
     * @var string
     */
	private $formulary;

	 /**
	 *
     * Constructor
     */
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('url', 'language', 'form'));
		$this->load->library(array('form_validation', 'session', 'form', 'email'));
		$this->load->database();

		// TODO Check current page to switch language
		if($this->router->fetch_method()=='add') {
			$this->session->set_userdata('site_current_page', $this->router->fetch_class().'/'.$this->router->fetch_method().'/'.$this->uri->segment(3));
		} else {
			$this->session->set_userdata('site_current_page', $this->router->fetch_class().'/'.$this->router->fetch_method());
		}
		
		// TODO Load website lang (current language)
		$this->load_lang();
		$this->site_lang = $this->current_lang();

		
		$this->formulary = new Form();

		// TODO Init email class
		$this->email = new Email();
	}

	public function index() {
		$data = array();
		$this->load->model('MemberModel');

		$data['current_lang'] = $this->current_lang();
		$data['formules'] = $this->MemberModel->getFormules($this->site_lang);

		$this->load->view('member_choice', $data);
	}

	/**
     * Load the add page view according to type of member
     *
     * @param string $type the type of member (normal or vip)
     *
     */
	public function add($type=false) {

		// TODO Check valid type of members
		$types_valide = array('normal', 'vip');

		if(in_array($type, $types_valide)) {
			$data = array();
			$this->load->model('MemberModel');

			$this->countries = $this->MemberModel->getCountries();

			$countries = array();

			foreach($this->countries as $country) {
				$countries[] = $country->country;
			}

			$data['member_formule_text'] = $this->MemberModel->getTextByType($this->site_lang, $type);
			$data['countries'] = $countries;
			$data['current_lang'] = $this->current_lang();
			$data['member_type'] = $type;

			$this->load->view('member', $data);
		} else {
			redirect('member/');
		}
	}

	/**
     * Create new member
     *
     * @param string $type the type of member (normal or vip)
     *
     */
	public function create($type=false) 
	{
		$this->load->model('MemberModel');

		// TODO Upload photos method call
		$photos = $this->upload_photos();

		if(!$photos) {
			$this->session->set_flashdata('error_upload', 1);
			redirect('member/add/'.$type);
		} else {
			$datas = array();

			$imageData = $this->upload->data();

			$datas['photo'] = $photos[0];
			$datas['photo2'] = $photos[1];

			foreach($_SESSION as $k => $v) {
				if(!preg_match('/session_/', $k)) continue;
				$name = str_replace('session_', '', $k);
				$datas[$name] = $v;
			}

			$datas['lang'] = $this->site_lang;

			$this->MemberModel->insert($datas);

			$contentEmail = $this->email->get('demand', 'fr');
			$this->email->send($this->session->userdata('session_email'), $contentEmail->title, $contentEmail->text);
		}
	}

	/**
     * Infinite upload photos to become a member
     *
     * @return array
     */
	private function upload_photos() {
		$this->load->library('upload', $this->set_upload_options());
		$array = [];
		foreach($_FILES as $k => $v) {
			if(!$this->upload->do_upload($k)) {
				return false;
			}
			$imageData = $this->upload->data();
			$array[] = $imageData['file_name'];
		}
		return $array;
	}

	/**
     * Infinite upload photos to become a member
     *
     * @return array
     */
	private function set_upload_options()
	{   
    	$config = array();
    	$config['upload_path'] = './public/photos_people/';
    	$config['allowed_types'] = 'gif|jpg|png|jpeg';
    	$config['encrypt_name'] = true;

    	return $config;
	}
	

	/**
     * Check if email exist
     *
     * @param string $email the email input of member
     *
     * @return object
     */
	private function emailExist($email) {

		// TODO Load model
		$this->load->model('MemberModel');

		$res = $this->MemberModel->emailExist($email);

		return $res;
	}

	/**
     * Check if username exist
     *
     * @param string $username the username input of member
     *
     * @return object
     */
	private function pseudoExist($username) {

		// TODO Load model
		$this->load->model('MemberModel');

		$res = $this->MemberModel->pseudoExist($username);

		return $res;
	}

	/**
     * Check all submit form with valid informations and save in session
     *
     * @param string $type the type of member (normal or vip)
     *
     * @return object
     */
	public function save($type=false) {
		$this->load->model('MemberModel');

		$this->countries = $this->MemberModel->getCountries();

		$countries = array();

		foreach($this->countries as $country) {
			$countries[] = $country->country;
		}

		// TODO check required fields

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->input->post('type_car')=='car') {
			$this->form_validation->set_rules('brand_car', 'Brand car', 'required');
			$this->form_validation->set_rules('model_car', 'Model car', 'required');
			$this->form_validation->set_rules('numberplate_car', 'Numberplate car', 'required');
		}

		// Todo informations about the men 
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('firstname', 'Firstname', 'required');
		$this->form_validation->set_rules('country', 'Country', 'required');
		$this->form_validation->set_rules('nationality', 'Nationality', 'required');
		$this->form_validation->set_rules('birthday', 'Birthday', 'required');

		
		// Todo informations about the women 
		$this->form_validation->set_rules('name_women', 'Name Women', 'required');
		$this->form_validation->set_rules('firstname_women', 'Firstname Women', 'required');
		$this->form_validation->set_rules('country_women', 'Country Women', 'required');
		$this->form_validation->set_rules('nationality_women', 'Nationality Women', 'required');
		$this->form_validation->set_rules('birthday_women', 'Birthday Women', 'required');

		if($this->form_validation->run()) 
		{
			if(filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) 
			{	
				// TODO Check if e-mail exist
				$emailExist = $this->emailExist($this->input->post('email'));

				if($emailExist)
				{
					$this->formulary->fillFields(array('send_member'));

					$this->session->set_flashdata('errors_email_exist', 1);
					redirect('member/add/'.$type);
				} 
				else 
				{
					// TODO Check if pseudo exist
					$pseudoExist = $this->pseudoExist($this->input->post('username'));

					if($pseudoExist) 
					{
						$this->formulary->fillFields(array('send_member'));

						$this->session->set_flashdata('errors_pseudo_exist', 1);
						redirect('member/add/'.$type);
					} else {
						if(in_array($this->input->post('country'), $countries) && 
						   in_array($this->input->post('country_women'), $countries) && 
						   in_array($this->input->post('nationality'), $countries) && 
						   in_array($this->input->post('nationality_women'), $countries)) 
						{
							/* Check member type */
							if($type=='vip') {
								$this->session->set_userdata('session_type', $type);
							} else {
								$this->session->set_userdata('session_type', 'normal');
							}
							// Check type of member car
							if($this->input->post('type_car')=='car') 
							{
								$arrayCar = array(
									'type' => 'car',
									'brand_car' => $this->input->post('brand_car'),
									'model_car' => $this->input->post('model_car'),
									'numberplate_car' => $this->input->post('numberplate_car'),
								);
							} else {
								$arrayCar = array(
									'type' => 'camping_car',
								);
							}
							// Check datas value and save in session
							$this->session->set_userdata('session_car', json_encode($arrayCar));

							foreach($_POST as $k => $v) {
								if($k=='send_member') continue;
								if($k=='type_car') continue;
								if($k=='brand_car') continue;
								if($k=='model_car') continue;
								if($k=='numberplate_car') continue;

								if($k=='password') $v = sha1($v);

								$this->session->set_userdata('session_'.$k, $v);
							}
							$this->session->set_flashdata('success_general', 1);
							redirect('member/add/'.$type);
						}
					}
				}
			} else {
				$this->formulary->fillFields(array('send_member'));

				$this->session->set_flashdata('errors_email', 1);
				redirect('member/add/'.$type);
			}
		} else {
			$this->formulary->fillFields(array('send_member'));

			$this->session->set_flashdata('errors_general', 1);
			redirect('member/add/'.$type);
		}
	}

	/**
	 *
     * Cancel member demand
     */
	public function cancel() 
	{
		session_destroy();
		redirect('main/');
	}	

	/**
	 *
     * Member logout
     */
	public function logout() {
		foreach($_SESSION as $k => $v) {
			if(preg_match('/_member/', $k)) {
				unset($_SESSION[$k]);
			}
		}
		redirect('main/');
	}
}
