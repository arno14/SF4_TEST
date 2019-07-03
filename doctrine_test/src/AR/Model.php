<?php

namespace AR;

use PDO;
use Exception;

/**
 * A basic Active Record Class
 *
 * @author arnaud
 */
abstract class Model
{
    private static $connectionSettings = [
        'dsn' => null,
        'username' => null,
        'password' => null,
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_TIMEOUT => 2
        ]
    ];
    private static $connectionInstance;
    private static $loadedModels = [];

    public static function registerConnection(array $settings)
    {
        self::$connectionSettings = $settings + self::$connectionSettings;
    }

    public static function getPDO(): PDO
    {
        if (null === self::$connectionInstance) {
            self::$connectionInstance = new PDO(self::$connectionSettings['dsn'], self::$connectionSettings['username'], self::$connectionSettings['password'], self::$connectionSettings['options']);
        }

        return self::$connectionInstance;
    }

    /**
     * @return array, example:
     * [
     *  'table_name'=>'my_table',
     *  'columns'=>[
     *      'id'=>'integer',
     *      'name'=>'string',
     *      'fk_id'=>'integer'
     *   ],
     * 'has_one'=>[
     *      'assoc'=>[
     *          'class_name'=>'SomeClass',
     *          'local_key'=>'fk_id'
     *      ]
     *   ]
     * ]
     */
    abstract static function getMapping(): array;

    /**
     * 
     * @return static[]
     */
    public static function findBy(array $filters = [], int $limit = 100)
    {
        $mapping = static::getMapping();

        $criterias = '';
        foreach ($filters as $columnName => $searchedValue) {
            $parameters[":$columnName"] = $searchedValue;
            $criterias .= ($criterias) ? ' AND ' : ' WHERE ';
            $criterias .= " $columnName = :$columnName";
        }

        $sql = "SELECT * FROM {$mapping['table_name']} $criterias LIMIT $limit OFFSET 0";

        $stmt = self::getPDO()->prepare($sql);

        $stmt->execute($parameters);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $results = [];
        foreach ($stmt as $row) {
            $results[] = new static($row);
        }

        return $results;
    }

    /**
     * 
     * @return static
     */
    public static function findById($id)
    {
        if (isset(self::$loadedModels[static::class][$id])) {
            return self::$loadedModels[static::class][$id];
        }

        foreach (self::findBy(['id' => $id]) as $row) {
            return $row;
        }

        throw new \InvalidArgumentException("No row found for id '$id'");
    }

    private $data;

    public function __construct(array $values = [])
    {
        foreach ($values as $key => $value) {
            $this->set($key, $value);
        }
        if (isset($this->data['id'])) {
            self::$loadedModels[static::class][$this->get('id')] = $this;
        }
    }

    public function get(string $name)
    {
        $mapping = static::getMapping();

        if (isset($mapping['columns'][$name])) {
            return $this->data[$name];
        }

        if (isset($mapping['has_one'][$name])) {  
            $className = $mapping['has_one'][$name]['class_name'];
            $foreignKey = $this->get($mapping['has_one'][$name]['local_key']);
            return $className::findById($foreignKey);
        }

        throw new \InvalidArgumentException("No mapping found for column '$name'");
    }

    /**
     * @return static
     */
    public function set(string $name, $value)
    {
        $mapping = static::getMapping();
        if (!isset($mapping['columns'][$name])) {
            throw new \InvalidArgumentException("No mapping found for column '$name'");
        }
        $this->data[$name] = $value;

        return $this;
    }

    /**
     * @return static
     */
    public function save()
    {
        $mapping = static::getMapping();
        $parameters = [];
        $sqlParts = [];

        foreach ($this->data as $key => $value) {
            $sqlParts[] = "$key = :$key";
            $parameters[":$key"] = $value;
        }

        if (isset($this->data['id'])) {
            $sql = "UPDATE {$mapping['table_name']} SET " . implode(',', $sqlParts) . " WHERE id = :id";
            $stmt = self::getPDO()->prepare($sql);
            $stmt->execute($parameters);
            
        } else {
            $sql = "INSERT INTO {$mapping['table_name']} SET " . implode(',', $sqlParts);
            $stmt = self::getPDO()->prepare($sql);
            $stmt->execute($parameters);

            $this->data['id'] = self::getPDO()->lastInsertId();
            self::$loadedModels[static::class][$this->get('id')] = $this;
        }

        return $this;
    }

}