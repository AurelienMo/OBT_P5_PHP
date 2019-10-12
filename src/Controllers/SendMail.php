<?php


namespace App\Controllers;



use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class SendMail extends AbstractController

{
    public function transport()
    {
        $data = require "../config/app/mailer.php";
        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
            -> setAuthMode ('login')
            -> setUsername ($data['mail'])
            -> setPassword ($data['password']);
        $mailer = new Swift_Mailer($transport);
        return $mailer;
    }

    public function message()
    {
//        $username = $_POST['username'];
//        $mail = $_POST['mail'];
        $username = 'Olivier';
        $mail = 'boutet.13010@gmail.com';

        $message = (new Swift_Message())
            -> setSubject ('Registration account')
            -> setFrom ('boutet.13010@gmail.com')
            -> setTo ($mail)
            -> setBody (
                $this -> getTwig()->render(
                    'mailer/confirmation.html.twig',
                    ['username' => $username]),
                'text/html');

        return $message;
    }





}