<?php


namespace App\Controllers;

use App\Model\Validator;

class RegistController extends AbstractController

{

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


    public function registAction($route, $sendMailController)
    {
//        $data = require "../config/app/mailer.php";
        if (!empty($_POST['username'])) {
            $_POST['username'] = preg_quote ($_POST['username']);

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

        $validator -> check ($rules);
        $errors = $validator -> getError ();
        $username = $_POST['username'] ?? null;
        $mail = $_POST['mail'] ?? null;
        $confmail = $_POST['conf_mail'] ?? null;

        /**************************/
        $username = 'olivier';
        $mail = 'boutet.13010@gmail.com';
        /**********************/


//        $options['ssl']['verify_peer'] = FALSE;
//        $options['ssl']['verify_peer_name'] = FALSE;


        /******************************/
//        dump ($data);
//        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
//            -> setAuthMode ('login')
//            -> setUsername ($data['mail'])
//            -> setPassword ($data['password']);

//        $mailer = new Swift_Mailer($transport);

//        $message = (new Swift_Message())
//            -> setSubject ('Registration account')
//            -> setFrom ('boutet.13010@gmail.com')
//            -> setTo ($mail)
//            -> setBody (
//                $this -> getTwig()->render (
//                    'mailer/confirmation.html.twig',
//                    ['username' => $username]),
//                'text/html');
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

            $sendMail = new SendMailController;
            $message = $sendMail->message();
            $mailer = $sendMail->transport();
            $mailer->send($message);
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