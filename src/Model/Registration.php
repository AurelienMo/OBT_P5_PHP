<?php
namespace App\Model;

use DateTime;

class Registration extends AbstractModel
{

    /**
     * @var
     */
    protected $id;

    /**
     * @Var string
     */
    protected $username;

    /**
     * @Var string
     */
    protected $mail;


    /**
     * @Var string
     */
    protected $password;

    /**
     * @Var \DateTime
     */
    protected $registrationDate;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function __construct(array $datas = [])
    {
        $this->registrationDate = new DateTime();
        parent::__construct($datas);
    }

    /**
     * @param int $id
     * @return Registration
     */
    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     * @return Registration
     */
    public function setUsername($username):Registration
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMail(): string
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     * @return Registration
     */
    public function setMail($mail): Registration
    {
        $this->mail = $mail;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword(): string
    {
        $password= password_hash($this->password, PASSWORD_BCRYPT);
        return $password;
    }

    /**
     * @param mixed $password
     * @return Registration
     */
    public function setPassword($password): Registration
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRegistrationDate():DateTime
    {
        return $this->registrationDate;
    }

    /**
     * @param mixed $registrationDate
     * @return Registration
     */
    public function setRegistrationDate(DateTime $registrationDate):Registration
    {
        $this->registrationDate = $registrationDate;
        return $this;
    }

}