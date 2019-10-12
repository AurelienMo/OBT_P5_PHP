<?php
//
//namespace App\App;
//
//
//use Swift_Message;
//use Swift_SmtpTransport;
//
//
//class Mailer
//use App\Controllers\Traits\TwigTrait;
//{
//    /**
//     * @var array
//     */
//    protected $data;
//
//    private function getData()
//    {
//        $data = require '../config/app/mailer.php';
//        return $data;
//
//    }
//
//    public function transport($data)
//    {
//        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
//            ->setAuthMode('login')
//            ->setUsername($data['mail'])
//            ->setPassword($data['password']);
//        return $transport;
//    }
//
//    public function message($data, $mail, $username)
//    {
//        $message = (new Swift_Message())
//            ->setSubject('Registration account')
//            ->setFrom($data['mail'])
//            ->setTo($mail)
//            ->setBody(
//                $this->getTwig()->render('mailer/confirmation.html.twig', ['username' => $username]),'text/html');
//
//    }
//
//
//
//}