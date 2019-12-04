<?php
namespace App\Model;

use App\Controllers\AbstractController;

class Validator extends AbstractController
{
    /**
     * @var
     */
    protected static $db;
     /**
     * @var string[]
     */
    public $error=[];
    /**
     * @var
     */
    public $params;
    /**
     * @var array
     */
    public $generalRules=[
        'lenghMin',
        'lenghMax',
        'validMail',
        'sameMail',
        'password',
        'name',
        'mail',
        'lastName',
        'usernameExist',];
    /**
     * @var array
     *
     */
    public $messages=[
        'lenghMin'=>'Le champ %s requière %d caractères minimum.',
        'lenghMax'=>'Le champ %s requière %d caractères maximum.',
        'mail'=>'Le champ %s doit être une adresse email valide.',
        'sameMail'=>'Les deux champ %s doivent correspondre.',
        'password'=>'Les deux password ne correspondent pas.',
        'usernameExist'=>'Ce pseudo "%s" est déjà utilisé.',
        'mailExist'=>'Cet email "%s" est déjà utilisé.',
        'complex'=>'Le mot de passe doit contenir au moins: 1 minuscule + 1 majuscule + 1 chiffre + un caractère speciaux ($ @ % * + - _ !)'
    ];

    /** Private methods  */
    /**
     * @param $field
     * @return bool
     */
    public function has($field)
    {
        return array_key_exists($field,$this->params);
    }
    public function addError($rule,$field,$option=null)
    {
        $this->error[$field]['']=sprintf($this->messages[$rule],$field,$option);
    }
    /**
     * Validator constructor.
     * @param $params
     */
    public function __construct($params)
    {
        $this->params=($params);
    }
    /**
     * @param string $field
     * @param int $min
     * @return void
     */
    public function lenghMin(string $field,int $min=6)
    {
        if($this->has($field)&&mb_strlen($this->params[$field])<$min){
            $this->addError('lenghMin',$field,$min);
        }
    }
    /**
     * @param string $field
     * @param int $max
     * @return void
     */
    public function lenghMax(string $field,int $max=20)
    {
        if($this->has($field)&&mb_strlen($this->params[$field])>$max){
            $this->addError('lenghMax',$field,$max);
        }
    }

    /**
     * valid the correspondence between the emails
     * @param $field
     * @return bool|string
     */
    public function validMail($field)
    {
        $db=self::getdb();
        if($this->has($field)){
            if(!filter_var($this->params[$field],FILTER_VALIDATE_EMAIL)){
                $this->addError('mail','E-'.$field);
            }
            if($_SERVER['PATH_INFO']!=='/contact'){
                if($this->params[$field]!==$this->params['conf_mail']){
                    $this->addError('sameMail','E-'.$field.'s');
                }
            }
        }
    }
    /**
     * @param $field
     * @param $complex
     * @return void
     */
    public function password($field,$complex)
    {
        if($this->has($field)){
            if($this->params[$field]!==$this->params['conf_mdp']){
                $this->addError('password',$field);
            }
            if(preg_match_all('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,15})$/',$_POST['password'])===0){
                $this->addError('complex',$field);
            }
        }
    }
    /**
     * @param $generalRules
     */
    public function check($generalRules)
    {
        foreach($generalRules as $fields=>$rules){
            if($this->has($fields)){
                $this->valid(['fields'=>$fields,'rules'=>$rules,'value'=>$this->params[$fields]]);
            }
        }
    }
    /**
     * @param $items
     */
    public function valid($items)
    {
        foreach($items ['rules'] as $rules=>$parameters){
            if(in_array($rules,$this->generalRules,true)){
                $this->$rules($items['fields'],$parameters);
            }
        }
    }
    public function getError()
    {
        return $this->error;
    }
}
