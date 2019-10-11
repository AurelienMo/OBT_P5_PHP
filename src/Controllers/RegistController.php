<?php


namespace App\Controllers;

use App\Model\Validator;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class RegistController extends AbstractController
{
//$data = require "../../config/app/mailer.php";
    /**
     * @var
     */
    protected static $db;

    /**
     * @var
     */
    protected $errors;

////    /**
//////     * @var
//////     */
//////    protected $value;
////
////    /**
////     * @var string
////     */
////    protected $name;


    public function registAction($params)
    {

        if (!empty($_POST['username'])) {
            $_POST['username'] = preg_quote($_POST['username']);

        }

        $validator = new Validator($_POST);
//        dump($validator);


        $rules = array(
            'username' => array(
                'lenghMin' => 4,
                'lenghMax' => 30
            ),
            'password' => array(
                'lenghMin' => 4,
                'lenghMax' => 20,
                'password' => true,
                'complex' => true
            ),
            'mail' => array(
                'validMail' => true
            ),
            'sameMail' => array(
                'confMail' => true
            )
        );

        $validator->check($rules);
        $errors = $validator->getError();
        $username = $_POST['username'] ?? null;
        $mail = $_POST['mail'] ?? null;
        $confmail = $_POST['conf_mail'] ?? null;


        $data = require '../config/app/mailer.php';



        if ($_SERVER['REQUEST_METHOD'] === 'POST' && count($errors) === 0) {
            echo 'ecriture en base';
//        $registData = $this->getGlobalPHP('POST');
//        $registration = new Registration($registData);
//        $db = self ::getdb ();
//        $statement = 'INSERT INTO member(username, mail, password, registrationDate)VALUES(:username, :mail, :password, NOW())';
//        $reqdb = $db -> prepare ($statement);
//        $reqdb -> execute (array(
//            'username' => $registration->getusername(),
//            'mail' => $registration->getmail(),
//            'password' => $registration->getpassword()
////            'registrationdate' => $registration->getregistrationDate()
//        ));
//        $results = $reqdb -> fetchAll ();
            $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
                ->setAuthMode('login')
                ->setUsername($data['mail'])
                ->setPassword($data['password']);
            dump ($data['mail'],' ** ', $data['password']);
            $mailer = new Swift_Mailer($transport);
            $message = (new Swift_Message())
                ->setSubject('Registration account')
                ->setFrom($data['mail'])
                ->setTo($mail)
                ->setBody(
                    $this->getTwig()->render('mailer/confirmation.html.twig', ['username' => $username]),'text/html');

            $result = $mailer->send($message);
            dump($result);


            return $this->renderResponse('registration/registration.html.twig');//("core/blog.html.twig");
        }
        echo 'du con';

        return $this->renderResponse('registration/registration.html.twig', [
            'errors' => $errors,
            'confmail' => $confmail,
            'username' => $username,
            'mail' => $mail
        ]);

    }


}