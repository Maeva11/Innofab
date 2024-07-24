<?php

class Mail
{
    private $subject;
    private $body;
    private $to;
    public function __construct(){
        $this->to = 'maeva@gtl-digital.fr'; //Tools::getValue("E-mail");
    }
    public function checkEmailFormat($email){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public function setSubject($string){ $this->subject = $string; }

    public function setTo($string){ $this->to = $string; }

    public function setBody($string){ $this->body = $string; }

    public function send(){
        require_once __DIR__.'/../vendor/phpmailer/src/Exception.php';
        require_once  __DIR__.'/../vendor/phpmailer/src/PHPMailer.php';
        require_once  __DIR__.'/../vendor/phpmailer/src/SMTP.php';
        $mail = new PHPMailer\PHPMailer\PHPMailer("true");
        try {

            $mail->isSMTP();
            $mail->Host =  SMTP_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_USER;
            $mail->Password = SMTP_PASSWORD;
            $mail->SMTPSecure = SMTP_SECURE;
            $mail->Port = SMTP_PORT;
            $mail->CharSet = 'UTF-8';
            $mail->setFrom(SMTP_USER, SMTP_USER_LABEL);
            $mail->addAddress($this->to);
            $mail->addReplyTo('noreply.' . SMTP_USER, 'Ne pas répondre');
            $mail->isHTML(true);
            $mail->Subject = $this->subject;
            $mail->Body = $this->body;
            $mail->AltBody = $this->subject;

            $mail->send();
            return ['success' => 1, 'message' => Tools::trad('Votre demande a bien été envoyée')];
        } catch (Exception $e) {
            return ['success' => 0, 'message' => Tools::trad('Votre demande n\'a pas été envoyée')];
        }
    }
}
