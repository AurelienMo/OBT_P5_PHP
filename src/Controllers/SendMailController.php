<?php

namespace App\Controllers;

use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class SendMailController extends AbstractController

{
    public function transport(): Swift_Mailer
    {
        $data = require '../config/app/mailer.php';
        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
            -> setAuthMode ('login')
            -> setUsername ($data['mail'])
            -> setPassword ($data['password']);
        return new Swift_Mailer($transport);
    }

    public function message(): Swift_Message
    {
        $page = $_SERVER['PATH_INFO'];
            if ($page ==='/registration'){

            $username = $_POST['username'];
            $mail = $_POST['mail'];

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
        $name = ucwords($_POST['name']);
        $lastName = strtoupper($_POST['lastName']);
        $mail = $_POST['mail'];
        $messages = $_POST['messages'];

        $message = (new Swift_Message())
            -> setSubject ('Contact Message')
            -> setFrom ('boutet.13010@gmail.com')
            -> setTo ('boutet.13010@gmail.com')
            -> setBody (
                $this -> getTwig()->render(
                    'mailer/message.html.twig',
                    [
                        'name' => $name,
                        'lastName' => $lastName,
                        'mail' => $mail,
                        'messages' => $messages
                    ]),
                'text/html');
        return $message;


    }


}