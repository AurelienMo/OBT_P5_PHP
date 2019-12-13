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
}