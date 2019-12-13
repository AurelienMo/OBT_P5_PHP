<?php
namespace App\Model;

use App\Model\ProfileRequest;

class Article extends AbstractModel
{
    /** @var string */
    private $titre;

    /**
     * @var string
     */
    private $article;

    /** @var \DateTime */
    private $created_date;

    /** @var string */
    private $slug;

    /** @var int */
    private $author;

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
    public function getTitre():string
    {
        return $this->titre;
    }

    /**
     * @param string $titre
     * @return Article
     */
    public function setTitre(string $titre):Article
    {
        $this->titre=$titre;
        return $this;
    }

    /**
     * @return string
     */
    public function getSlug():string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     * @return Article
     */
    public function setSlug(string $slug):Article
    {
        $this->slug=$slug;
        return $this;
    }

    /**
     * @return int
     */
    public function getAuthor():int
    {
        return $this->author;
    }

    /**
     * @param int $author
     * @return Article
     */
    public function setAuthor(int $author):Article
    {
        $this->author=$author;
        return $this;
    }
    /**
     * @return \DateTime
     */
    public function getCreatedDate():\DateTime
    {
        return \DateTime::createFromFormat('Y-m-d', $this->created_date);
    }

    /**
     * @param \DateTime $created_date
     * @return Article
     */
    public function setCreatedDate($created_date):Article
    {
        $this->created_date = \DateTime::createFromFormat('Y-m-d', $created_date);
        return $this;
    }
}