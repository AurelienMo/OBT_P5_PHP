<?php


namespace App\Application;
use PDO;

/**
 * Class Database
 */
class Database extends PDO
{
    const TYPE_FIELD = [
        'integer' => parent::PARAM_INT,
        'boolean' => parent::PARAM_BOOL
    ];

    /**
     * Connection constructor.
     * @param string $dsn
     * @param string $username
     * @param string $password
     * @param array $options
     */
    public function __construct($dsn, $username = '', $password = '', $options = [])
    {
        parent::__construct($dsn, $username, $password, $options);
        parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        parent::setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        parent::setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
    /**
     * Amélioration de la fonction query de PDO
     *
     * @param string|PDOStatement $statement
     * @param array $params
     * @return PDOStatement|string
     */
    public function request($statement, array $params = [])
    {
        if (is_string($statement)) {
            $statement = $this->prepare($statement);
        }
        foreach ($params as $param => $value) {
            $paramType = gettype($value);
            $bindType = parent::PARAM_STR;
            if ($param instanceof DateTime) {
                $value = $param->format('Y-m-d H:i:s');
            } elseif (array_key_exists($paramType, self::TYPE_FIELD)) {
                $bindType = self::TYPE_FIELD[$paramType];
            } elseif ($param === null) {
                $bindType = parent::PARAM_NULL;
            }
            $statement->bindValue($param, $value, $bindType);
        }
        $statement->execute();
        return $statement;
    }
}