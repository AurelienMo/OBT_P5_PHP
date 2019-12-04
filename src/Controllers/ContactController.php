<?php


namespace App\Controllers;


use App\Model\Validator;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends AbstractController
{

    /**
     * @var
     */
    protected static $db;

    /**
     * @param $route
     * @return RedirectResponse|Response
     */
    public function contact($route)
    {
        $errors = [];
        $name = $_POST['name'] ?? null;
        $lastName = $_POST['lastName'] ?? null;
        $mail = $_POST['mail'] ?? null;

        if (!empty($_POST['name'] && $_POST['lastName'] && $_POST['messages'])) {
            $_POST['name'] = preg_quote ($_POST['name']);
            $_POST['lastName'] = preg_quote ($_POST['lastName']);
            $_POST['messages'] = preg_quote ($_POST['messages']);
        }

        $validator = new Validator($_POST);

        if ($route === 'contact') {

            $rules = array(
                'name' => array(
                    'lenghMin' => 4,
                    'lenghMax' => 30
                ),
                'lastName' => array(
                    'lenghMin' => 4,
                    'lenghMax' => 30
                ),
                'messages' => array(
                    'lenghMin' => 4,
                    'lenghMax' => 200,
                ),
                'mail' => array(
                    'validMail' => true
                )
            );

            $validator -> check ($rules);
            $errors = $validator -> getError ();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && count ($errors) === 0) {
            $sendMail = new SendMailController;
            $message = $sendMail -> message ();
            $mailer = $sendMail -> transport ();
            $mailer -> send ($message);
            return new RedirectResponse('/');
        }

        return $this -> renderResponse ('core/contact.html.twig', [
            'mail' => $mail,
            'name' => $name,
            'lastName' => $lastName,
            'errors' => $errors
        ]);
    }
}