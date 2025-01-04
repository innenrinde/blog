<?php

/**
 * SMTP authentication
 */
define('SMTP_HOST', 'mail.agrofinanciar.ro');
define('SMTP_PORT', '26');
define('SMTP_USERNAME', 'contact@agrofinanciar.ro');
define('SMTP_PASSWORD', 'V7qwr[p38hIL');
define('SMTP_FROM', 'contact@agrofinanciar.ro');
define('SMTP_FROM_NAME', 'Admin Agrofinanciar');
define('SMTP_REPLY', 'office@agrofinanciar.ro');
define('SMTP_REPLY_NAME', 'Office Agrofinanciar');


class Email {
	
	protected $address_to;
	protected $name_to;
	protected $message_title;
	protected $message_content;
	
	function __construct($address_to, $name_to, $message_title, $message_content) {
		$this->address_to = $address_to;
		$this->name_to = $name_to;
		$this->message_title = $message_title;
		$this->message_content = $message_content;
	}
	
	function send() {
		
		require_once("PHPMailer.php");
		require_once("SMTP.php");
		
		$mail = new PHPMailer;
		//Tell PHPMailer to use SMTP
		$mail->isSMTP();
		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = 0;
		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';
		//Set the hostname of the mail server
		$mail->Host = SMTP_HOST;
		//Set the SMTP port number - likely to be 25, 465 or 587
		$mail->Port = SMTP_PORT;
		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;
		//Username to use for SMTP authentication
		$mail->Username = SMTP_USERNAME;
		//Password to use for SMTP authentication
		$mail->Password = SMTP_PASSWORD;
		//Set who the message is to be sent from
		$mail->setFrom(SMTP_FROM, SMTP_FROM_NAME);
		//Set an alternative reply-to address
		$mail->addReplyTo(SMTP_REPLY, SMTP_REPLY_NAME);
		//Set who the message is to be sent to
		if(is_array($this->address_to)) {
			foreach($this->address_to as $i => $v) {
				$name_to = is_array($this->name_to) && isset($this->name_to[$i]) ? $this->name_to[$i] : $this->name_to;
				$mail->addAddress($v, $this->name_to);
			}
		}
		else {
			$mail->addAddress($this->address_to, $this->name_to);
		}
		//Set the subject line
		$mail->Subject = $this->message_title;
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		$mail->msgHTML($this->message_content);
		//Replace the plain text body with one created manually
		//$mail->AltBody = 'This is a plain-text message body';
		//Attach an image file
		//$mail->addAttachment('images/phpmailer_mini.png');
		
		//send the message, check for errors
		if (!$mail->send()) {
			// echo "Mailer Error: " . $mail->ErrorInfo;
			print_r($mail->ErrorInfo);
			return $mail->ErrorInfo;
			exit;
			//return false;
		} else {
			return "ok";
		}
	}
	
}