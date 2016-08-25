<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends Lang {

	/*
    |--------------------------------------------------------------------------
    | Payment Controller
    |--------------------------------------------------------------------------
    |
    | This controller is about payment system of the application 
    |
    */

    /**
	 *
     * Constructor
     */
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('url', 'language', 'form'));
		$this->load->library(array('form_validation', 'session', 'email'));
		$this->load->database();
		
		// TODO Check current page to switch language
		if($this->router->fetch_method()=='process') {
			$this->session->set_userdata('site_current_page', $this->router->fetch_class().'/'.$this->router->fetch_method().'/'.$this->uri->segment(3));
		} else {
			$this->session->set_userdata('site_current_page', $this->router->fetch_class().'/'.$this->router->fetch_method());
		}

		// TODO Load website lang (current language)
		$this->load_lang();
		$this->site_lang = $this->current_lang();

		// TODO Init stripe (http://stripe.com)

		$this->stripe = array(
			"secret_key"      => API_STRIPE_KEY,
			"publishable_key" => API_STRIPE_KEY_PUBLISH
		);
		\Stripe\Stripe::setApiKey($this->stripe['secret_key']);	
	}

	/**
     * Check if the token exist in database and display view for that users can use the payment system
     *
     * @param string $token token of the url for the payment system
     *
     */
	public function process($token) {

		$this->load->model('PaymentModel');

		// Todo check if token exist
		$result = $this->PaymentModel->exist($token);

		if(!$result or empty($token)) {
			redirect('404');
		} else {
			$type_car = json_decode($result->car)->type;

			$this->session->set_userdata('id_user', $result->id);
			$this->session->set_userdata('type_user', $result->type);
			$this->session->set_userdata('type_car', $type_car);
			$this->session->set_userdata('email_stripe', $result->email);

			$data['stripe'] = $this->stripe;
			$data['current_lang'] = $this->site_lang;
			$data['user'] = $result;
			$data['amount_format'] = $this->getAmount(true);
			$data['amount'] = $this->getAmount();
			$data['member_card_type'] = ($this->session->userdata('type_user')=='vip') ? lang('member_card_label_vip') : lang('member_card_label');

			$this->load->view('payment', $data);
		}
	}

	/**
	 *
     * Check the match into back-end and front-end about payment informations and finish the payment system
     */
	public function do_payment() 
	{
		$type_car = $this->session->userdata('type_car');

		$token = $_POST['stripeToken'];
		
		$customer = \Stripe\Customer::create(array(
		    'email' => $this->session->userdata('email_stripe'),
		    'source'  => $token,
		));

		$charge = \Stripe\Charge::create(array(
		    'customer' => $customer->id,
		    'amount'   => $this->getAmount(true),
		    'currency' => 'eur',
		));

		$emailObject = new Email();
		$emailContent = $emailObject->get('payment_member_card', $this->site_lang);

		$emailObject->send($this->session->userdata('email_stripe'), $emailContent->title, $emailContent->text);

		// TODO Destroy Stripe session
		unset($_SESSION['email_stripe']);

		$data = array(
			'token' => '',
			'payment' => 1,
		);
		// Todo update database and write that user paid

		$this->db->where('id', $this->session->userdata('id_user'));
		$this->db->update('members', $data);

		$this->session->set_flashdata('now_member', 1);
		
		redirect('main/index');
	}

	/**
     * Get amount of member card type
     *
     * @param bool $format format of money view|system
     *
     * @return int
     */
	private function getAmount($format=false) {
		if($format) {
			$amount = ($this->session->userdata('type_user')=='vip') ? 10000 : 2000;
		} else {
			$amount = ($this->session->userdata('type_user')=='vip') ? 100 : 20;
		}

		return $amount;
	}
}
