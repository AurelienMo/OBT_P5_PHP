<?php /** @noinspection PhpInconsistentReturnPointsInspection */
namespace App\Controllers\Traits;


use App\Controllers\AbstractController;
use App\Model\Registration;


class ExistDB extends AbstractController

{
    protected $error = 5;
    protected static $db;

    public function checkUser(): ?string
    {

        $registration = new Registration();

        $db = self::getdb();
        $statement = 'Select COUNT(*) from member where username=:username';
        $request = $db->prepare($statement);
        $request->execute(array(
            ':username' => $registration->getusername()
        ));
        $data = $request->fetch();
        if (($data['COUNT(*)']) > '0') {
            $name = $registration->getusername();
            if (strlen($name) > 3) {
                if (strlen($name) > 30) {
                    return 'Le <strong>USERNAME</strong> doit contenir moins de 30 caractères mais plus que 3. ';
                }
            } else {
                $error = 'Le <strong>USERNAME</strong> \'' . $name . '\' est déjà utilisé ';
                dump($error);
                return $error;
            }
        }
    }
}