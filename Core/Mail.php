<?php

namespace Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail
{
    public $mailer;

    public function __construct($config, ?PHPMailer $mailer = null)
    {
        $this->mailer = $mailer ?: new PHPMailer();

        $this->mailer->isSMTP();
        $this->mailer->Host = $config['host'];
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = $config['username'];
        $this->mailer->Password = $config['password'];
        $this->mailer->SMTPSecure = $config['encryption'];
        $this->mailer->Port = $config['port'];
        $this->mailer->Timeout = 10;
        $this->mailer->setFrom($config['from_address'], $config['from_name']);
    }

    public function send($to, $subject, $body)
    {
        $this->mailer->addAddress($to);
        $this->mailer->isHTML(true);
        $this->mailer->Subject = $subject;
        $this->mailer->Body = $body;

        try {
            return $this->mailer->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mailer->ErrorInfo}";
        }
    }
}
