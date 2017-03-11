<?php

use Db_connect\DBManager;

class User
{
    private $username;
    private $email;
    private $blacklist;
    private $id;
    /** @var  DBManager */
    protected $db;


    public function getId()
    {
        return $this->id;
        // DONE
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBlacklist()
    {
        return $this->blacklist;
    }

    /**
     * @param mixed $blacklist
     * @return User
     */
    public function setBlacklist($blacklist)
    {
        $this->blacklist = $blacklist;
        return $this;
    }


    public function read($id)
    {
        try {
            $sql = "SELECT * FROM users WHERE id=%s";

            $s = (new DBManager)->connectToDatabase()->query(sprintf($sql, (new DBManager)->connectToDatabase()->quote($id)));

            /** @var User $data */
            $data = $s->fetchObject(__CLASS__);

            return $data;

        } catch (PDOException $e) {
            return '';
        }
    }

    /**
     * @param $email
     * @param string $reason
     * @return bool
     */
    public function UpdateUserToBlackList($email, $reason = '')
    {
        $sql = "UPDATE users set blacklist = 1 where email = %s";

         return (new DBManager)->connectToDatabase()->query(
             sprintf($sql, (new DBManager)->connectToDatabase()->quote($email))
         )->execute();

    }


    public function AddUserToBlackList($from_id, $to_id)
    {
        $q = (new DBManager)->connectToDatabase()->prepare("INSERT INTO edge(fromUser_ID, toUser_ID,date_added,type) VALUES(:fromUser_ID, :toUser_ID,:date_added,:type)");

        $q->bindValue(':fromUser_ID', $from_id);
        $q->bindValue(':toUser_ID', $to_id);
        $q->bindValue(':date_added', date('Y-m-d G:i:s'));
        $q->bindValue(':type', 'blacklist');

        $q->execute();

    }

    public function UpdateUsersTable($email)
    {
        $sql = "UPDATE users set blacklist = 0 where email = %s";

        return (new DBManager)->connectToDatabase()->query(
            sprintf($sql, (new DBManager)->connectToDatabase()->quote($email))
        )->execute();
    }

    public function removeUserToBlackList($toUser_ID)
    {
        $q = (new DBManager)->connectToDatabase()->prepare("DELETE FROM edge WHERE toUser_ID = :toUser_ID");

        $q->bindValue(':toUser_ID', $toUser_ID);

        $q->execute();

    }

}