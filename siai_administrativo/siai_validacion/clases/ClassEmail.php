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
//		$this->phpmailer=new PHPMailer();
//		$this->phpmailer->IsSMTP(); 
//                $this->phpmailer->CharSet = 'UTF-8';
//		$this->phpmailer->Host="mail.politecnica.edu.sv";
//		$this->phpmailer->SMTPDebug  = false;  
//		$this->phpmailer->SMTPAuth   = true;
//		$this->phpmailer->Host="mail.politecnica.edu.sv";
//		$this->phpmailer->Port       = 49; 
//		$this->phpmailer->Username   = "siai@politecnica.edu.sv";
//		$this->phpmailer->Password   = "Clave2013"; 
//		$this->phpmailer->SetFrom('siai@politecnica.edu.sv', 'SIAI-POLITECNICA');
            
                $this->phpmailer=new PHPMailer();
		$this->phpmailer->IsSMTP(); 
                $this->phpmailer->CharSet = 'UTF-8';
		$this->phpmailer->Host="ssl://smtp.googlemail.com";
		$this->phpmailer->SMTPDebug  = false;  
		$this->phpmailer->SMTPAuth   = true;
		$this->phpmailer->Port       = 465; 
		$this->phpmailer->Username   = "siai@upes.edu.sv";
		$this->phpmailer->Password   = "Envi@2015"; 
		$this->phpmailer->SetFrom('siai@upes.edu.sv', 'SIAI-POLITECNICA');            
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