<?php
namespace App\Model;

use App\Model\ProfileRequest;

class Article extends AbstractModel
{
    protected static $db;

    /** @var string */
    private $title;

    /**
     * @var string
     */
    private $article;
    /**
     * @date
     */
    private $date;
    /**
     * @return mixed
     */
    /***********************************************/
                    /*FUNCTION GETTER SETTER*/
    /***********************************************/
    public function getDate()
    {
        return $this->date;
    }
    /**
     * @param mixed $date
     * @return Article
     */
    public function setDate($date)
    {
        $this->date=$date;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @param mixed $article
     * @return Article
     */
    public function setArticle($article)
    {
        $this->article = $article;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return Article
     */
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**************************************/
                 /* METHOD */
    /**************************************/

    public function serialize()
    {
        return serialize(
            [
                $this->id,
                $this->title,
            ]
        );
    }


    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->title,
            $this->article,
            $this->date
            ) = unserialize($serialized);

        return $this;
    }

}