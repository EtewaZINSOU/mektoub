<?php

namespace Db_connect;

use PDO;
use PDOException;

class DBManager
{
    /*** mysql hostname ***/
    private $hostname;

    /*** mysql username ***/
    private $username;

    /*** mysql password ***/
    private $password;

    /*** mysql password ***/
    private $dbName;


    /*** database resource ***/
    public $dbh = NULL;

    /** @var  $port  */
    private $port; // Database handler

    public function __construct() // Default Constructor
    {
        try
        {
            $this->connectToDatabase();
        }
        catch(PDOException $e)
        {
            echo __LINE__.$e->getMessage();
        }
    }

    public function getConfig()
    {
        return json_decode(file_get_contents(__DIR__ . '/config/config.json'));
    }

    /**
     * @return PDO
     */
    public function connectToDatabase()
    {
        $this->dbName = $this->getConfig()->database->name;
        $this->hostname = $this->getConfig()->database->host ;
        $this->port = $this->getConfig()->database->port ;
        $this->username = $this->getConfig()->database->user;
        $this->password = $this->getConfig()->database->password;

        $dsn = 'mysql:dbname=' . $this->dbName . ';host=' . $this->hostname . ';port=' . $this->port;

        if($this->dbh == null){
            $pdo = new PDO($dsn, $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->dbh = $pdo;
        }

       return $this->dbh;
    }



    public function __destruct()
    {
        $this->dbh = NULL; // Setting the handler to NULL closes the connection propperly
    }

    public function addNewUser($username, $email)
    {
        $q = $this->connectToDatabase()->prepare('INSERT INTO users(username, email) VALUES(:username, :email)');

        $q->bindValue(':username', $username);
        $q->bindValue(':email', $email);

        $q->execute();
    }
}