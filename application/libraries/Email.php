<?php

require_once APPPATH.'../vendor/autoload.php';

class Email {

	/**
 	* Email library class using SwiftMailer
 	*
 	*/

 	/**
     * Username of the SMTP Server
     *
     * @var string
     */
	private $username;
	/**
     * Password of the SMTP Server
     *
     * @var string
     */
	private $password;
	/**
     * Sending server url
     *
     * @var string
     */
	private $server;
	/**
     * Port of the SMTP server 
     *
     * @var int
     */
	private $port;
	/**
     * protocol 
     *
     * @var string
     */
	private $protocol;
	/**
     * CI Instance
     *
     * @var object
     */
	private $CI;
	/**
     * MySQL table of emails 
     *
     * @var string
     */
	private $table;

	/**
	 *
     * Constructor
     */
	public function __construct() {
		$CI =& get_instance();

		$this->CI = $CI;

		$this->username = '************';
		$this->password = '************';
		$this->server = 'send.one.com';
		$this->port = 465;
		$this->protocol = 'ssl';
		$this->table = 'emails';

	}

	/**
     * Send email
     *
     * @param $email email form input
     * @param $subject subject form input
     * @param $content message form input
     *
     */
	public function send($email, $subject, $content) {

		$transport = Swift_SmtpTransport::newInstance($this->server, $this->port, $this->protocol)
		      ->setUsername($this->username)
		      ->setPassword($this->password);

		/* Instance Email */

		$message = Swift_Message::newInstance();

		$message->setSubject($subject)
		  ->setFrom(array('send@clubenfin.be' => 'ClubEnfin Team'))
		  ->setTo(array($email))
		  ->setBody($content, 'text/html');
		

		//Create the Mailer using your created Transport
		$mailer = Swift_Mailer::newInstance($transport);
		
		//Send the message
		$result = $mailer->send($message);
	}

	/**
     * Get email text according language of user
     *
     * @param $type The type of email
     * @param $lang The language of email
     *
     * @return object
     */
	public function get($type, $lang) {
		$title = 'title_'.$lang;
		$text = 'text_'.$lang;

		$res = $this->CI->db->select("$title AS title, $text AS text")
							->where('type', $type)
							->get($this->table);
		return $res->row();
	}
}