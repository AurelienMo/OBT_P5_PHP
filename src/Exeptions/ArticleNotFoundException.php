<?php


namespace App\Exeptions;

use Exception;
use Throwable;
class ArticleNotFoundException extends Exception
{
    /**
     * @var int
     */
    protected $id;
    public function __construct(int $id)
    {
        $this->id = $id;
        parent::__construct();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
