<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Lang extends CI_Controller {
	
	/*
    |--------------------------------------------------------------------------
    | Lang Controller
    |--------------------------------------------------------------------------
    |
    | This controller is about translation of the application 
    |
    */

    /**
     * The attribute is the language that user use on the application
     *
     * @var string
     */
	protected $site_lang;

	/**
	 *
     * Constructor
     */
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
	}

	/**
     * Get current lang of the app
     *
     * @return array
     */
	public function current_lang()  
	{
		if( !$this->session->userdata('site_lang') ) 
		{
			$this->session->set_userdata('site_lang', 'fr');
		}
		return $this->session->userdata('site_lang');
	}

	/**
     * Switch language on the app
     *
     * @param string $param (lang) like "FR"/"NL" of the app
     *
     */
	public function switchLanguage($param=false) {
		$languages = array('fr', 'nl');
		if($param) {
			if(in_array($param, $languages)) {
				$this->session->set_userdata('site_lang', $param);
			} else {
				$this->session->set_userdata('site_lang', 'fr');
			}
		} else {
			$this->session->set_userdata('site_lang', 'fr');
		}

		if($this->session->userdata('site_current_page')) {
			if(preg_match('/home/', $this->session->userdata('site_current_page'))) {
				redirect(base_url().'main');
			} else {
				redirect(base_url().$this->session->userdata('site_current_page'));
			}
		} else {
			redirect(base_url().'main');
		}
	}

	/**
     * 
     * Load current lang of user
     */
	public function load_lang() {
		if($this->session->userdata('site_lang')=='fr') {
			$this->load->language('fr', 'french'); 
		} elseif($this->session->userdata('site_lang')=='nl') {
			$this->load->language('nl', 'dutch'); 
		} else {
			$this->load->language('fr', 'french'); 
		}
	}
}
