<?php
namespace App\Controllers;

use App\Model\CheckForm;
use App\Model\Registration;
use App\Model\Validator;
use Symfony\Component\HttpFoundation\RedirectResponse;
class RegistController extends AbstractController
{
    /**
     * @var
     */
    protected static $db;
    /**
     * @var array
     */
    protected $errors=[];
    protected $errorUserName=[];
    protected $errorMail=[];
    /**
     * @var array
     */
    protected $rules=[];
    public function registAction()
    {
        $validator=new Validator($_POST);
        $rules=array(
            'username'
            =>array(
                'lenghMin'=>4,
                'lenghMax'=>30
            ),
            'password'
            =>array(
                'lenghMin'=>4,
                'lenghMax'=>20,
                'password'=>true,
                'complex'=>true
            ),
            'name'
            =>array(
                'name'=>null
            ),'lastName'
            =>array(
                'lastName'=>null
                ),'mail'
            =>array(
                'validMail'=>null,
                ),
            'messages'
            =>array(
                'messages'=>null),
            'sameMail'
            =>array(
                'confMail'=>true
            ));
        $username=$_POST['username']??null;
        $mail=$_POST['mail']??null;
        $confmail=$_POST['conf_mail']??null;
        $validator->check($rules);
        $errors=$validator->getError();
        $_POST['username']= preg_replace("[^a-zA-Z]","",($_POST['username']));
        $check=new CheckForm();
        $errorUserName=$check->checkUserName();
        $errorMail=$check->checkMail();
        dump($_SERVER['REQUEST_METHOD']==='POST');
        if($errorUserName!==null||$errorMail!==null){
            $errors[] = ($errorUserName);
            $errors[] = ($errorMail);
        }

        dump($_POST['password']);

        $db = self ::getdb ();
        if($_SERVER['REQUEST_METHOD']==='POST'&&count($errors)===0){
            dump($errors);
            $registData=$this->getGlobalPHP('POST');
            $registration=new Registration($registData);
            $db=self::getdb();
            $statement='INSERT INTO member(username, mail, password, registrationDate)VALUES(:username, :mail, :password, NOW())';
            $reqdb=$db->prepare($statement);
            $reqdb->execute(array('username'=>$registration->getusername(),'mail'=>$registration->getmail(),'password'=>$registration->getpassword(),));
            $results=$reqdb->fetchAll();
            $sendMail=new SendMailController;
            $message=$sendMail->message();
            $mailer=$sendMail->transport();
            $mailer->send($message);
            return new RedirectResponse('/');
        }
        echo 'du con';
        return $this->renderResponse('registration/registration.html.twig',['errors'=>$errors,'confmail'=>$confmail,'username'=>$username,'mail'=>$mail]);
    }
}
