<?php

class Email
{
	private $adress;
	private $body;
	private $altbody;
	private $subject;
	private $phpmailer;
	
	public function __construct()
    {
		$this->phpmailer=new PHPMailer();
		$this->phpmailer->IsSMTP(); 
		$this->phpmailer->Host="mail.grupopabe.com";
		$this->phpmailer->SMTPDebug  = 2;  
		$this->phpmailer->SMTPAuth   = true;
                $this->phpmailer->CharSet   = 'UTF-8';
		$this->phpmailer->Port       = 49; 
		$this->phpmailer->Username   = "denysurquilla@grupopabe.com";
		$this->phpmailer->Password   = "123456789"; 
		$this->phpmailer->SetFrom('denysurquilla@grupopabe.com', 'SIAI-POLITECNICA');
	}
	
	public function setAdress($adress)
	{
		$this->adress=$adress;
	}
	public function setSubject($subject)
	{
		$this->subject=$subject;
	}
	public function setBody($body, $altbody)
	{
		$this->body=$body;
		$this->altbody=$altbody;
	}

	public function send()
	{
		$this->phpmailer->Subject    = $this->subject;
		$this->phpmailer->AltBody    = $this->altbody; // optional, comment out and test
		$this->phpmailer->MsgHTML($this->body);
		$this->phpmailer->AddAddress($this->adress, $this->adress);
		if(!$this->phpmailer->Send()) {
			return false;
		} else {
		  	return true;
		}
	}

}