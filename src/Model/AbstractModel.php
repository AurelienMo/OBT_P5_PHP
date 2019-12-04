<?php
namespace App\Model;

use Serializable;

abstract class AbstractModel
{

    protected $id;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return AbstractModel
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function __construct(
        array $data = []
    )
    {
        if (!empty($data)){
            $this->hydrate($data);
        }
    }

    protected function hydrate(array $data)
    {
        foreach ($data as $property => $value){
            $methode = 'set'.ucfirst($property);
            if (is_callable([$this, $methode])){
                $this->$methode($value);
            }
        }
    }


}