<?php

declare(strict_types=1);

namespace App;

class Database
{
    private static \PDO $db;

    /**
     * make connection to configured database
     * and assigning PDO
     * @throws \PDOException
     */
    public function __construct()
    {
        // DB Conneciton string and configuration
        $dsn = "{$_ENV['driver']}:host={$_ENV['host']};dbname={$_ENV['dbname']};charset=utf8mb4";
        $connectionConfig = [
            \PDO::ATTR_DEFAULT_FETCH_MODE =>\PDO::FETCH_OBJ,
        ];
        try {
             // make connection to db
            static::$db = new \PDO($dsn, $_ENV['user'],$_ENV['password'], $connectionConfig);
        } catch (\Exception $e) {
            // Handle exceptions (connection errors)
            throw new \PDOException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Query the database.
     *
     * @param string $queryStatement
     * @param int    $fetchMode (optional)
     *
     * @return array
     */
    public function query(string $queryStatement, int $fetch_mode = \PDO::FETCH_OBJ) : array
    {
        // prepare query statement 
        $stmnt = static::$db->prepare($queryStatement);  
        $stmnt->execute();
        
        return $stmnt->fetchAll($fetch_mode);
    }

    /**
     * Fetch once for each statement
     * for SELECT Statement 
     * @param string $queryStatement
     * @param int $fetch_mode
     * @return mixed
     */
    public function queryOne(string $queryStatement, int $fetch_mode = \PDO::FETCH_OBJ)
    {
           // prepare query statement 
        $stmnt = static::$db->prepare($queryStatement);  
        $stmnt->execute();
        
        return $stmnt->fetch($fetch_mode);
    }

    /**
     * Execute a INSERT, UPDATE, DELETE query.
     * by letting user choose how to perform fetching operations. 
     * or just simply returning boolean values or the statement
     * so user can chaining it desired fetch.
     *    
     * @param string $queryStatement
     *
     */
    public function execute(string $queryStatement)
    {
        $stmnt = static::$db->prepare($queryStatement);
        $stmnt->execute();

        return $stmnt;
    }

    /**
     * get the PDO instance
     * @return \PDO
     */
    public function getDb(): \PDO
    {
        return static::$db;
    }
}
