<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    public string $receiver;
    public string $sender;
    public string $subject;
    public string $message;
    public string $nameSender;

    public function __construct(string $receiver, string $sender, string $subject, string $message, string $nameSender)
    {
        $this->receiver = $receiver;
        $this->sender = $sender;
        $this->subject = $subject;
        $this->message = $message;
        $this->nameSender = $nameSender;
    }
    public function send()
    {
        try {
            require_once ('../../vendor/phpmailer/phpmailer/src/PHPMailer.php');
            require_once ('../../vendor/phpmailer/phpmailer/src/SMTP.php');
            require_once ('../../vendor/phpmailer/phpmailer/src/Exception.php');

            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'alfatecnicasrl.mailer@gmail.com';
            $mail->Password = 'udmfxeagmfccdfuh';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom($this->sender, $this -> nameSender);
            $mail->addAddress($this->receiver);

            $mail->isHTML(true);
            $mail->Subject = $this->subject;
            $mail->Body = $this->message;

            if ($mail->send()) {
                echo 'Message has been sent';
            } else {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

}
