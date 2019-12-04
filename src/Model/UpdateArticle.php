<?php
namespace App\Model;

class UpdateArticle extends \App\Model\AbstractModel

{
    protected static $db;

    protected $id;
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @param mixed $id
     * @return UpdateArticle
     */
    public function setId($id)
    {
        $this->id=$id;
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
     * @return UpdateArticle
     */
    public function setArticle($article)
    {
        $this->article=$article;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }
    /**
     * @param mixed $title
     * @return UpdateArticle
     */
    public function setTitle($title)
    {
        $this->title=$title;
        return $this;
    }
    protected $article;
    protected $title;


    public function __construct(array $data=[])
    {
        parent::__construct($data);
    }

    public function updateArticle($article)
    {
        return $updateArticle = $article;
    }

    private function updateBase()
    {

    }
}