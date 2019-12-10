<?php
namespace App\Helpers\FormMapper\FormObjectRepreentation;

/**
 * class ContactFormRepresentation
 */

final class ContactFormRepresentation implements FormObjectRepresentationInterface
{
    const RULE_TO_VALIDATE = array(
        'name' => array(
            'lenghMin' => 4,
            'lenghMax' => 30
        ),
        'lastName' => array(
            'lenghMin' => 4,
            'lenghMax' => 30
        ),
        'message' => array(
            'lenghMin' => 4,
            'lenghMax' => 200,
        ),
        'mail' => array(
            'validMail' => true
        )
    );
    protected $name;
    protected $lastName;
    protected $mail;
    protected $messages;
    /**
     * ContactFormRepresentation constructor.
     *
     * @param array $postSubmitted
     */
    public function __construct(
        array $postSubmitted
    ) {
        $this->initFields($postSubmitted);
    }
    private function initFields(array $postSubmitted)
    {
        foreach ($postSubmitted as $property => $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
    }
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }
    public function getMail()
    {
        return $this->mail;
    }
    /**
     * @return mixed
     */
    public function getMessages()
    {
        return $this->messages;
    }
    public function getErrors(): array
    {
        return Validator::validateObject($this, self::RULE_TO_VALIDATE);
    }
    public function isValid()
    {
        return count($this->getErrors()) === 0;
    }
}