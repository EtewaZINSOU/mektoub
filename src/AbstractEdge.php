<?php

abstract class AbstractEdge
{
    protected $_id;
    /** @var  \Db_connect\DBManager */
    protected $db;


    abstract public function add(User $user);

    abstract public function remove(User $user);

    abstract public function isAllowed(User $user);


    /**
     * constructeur
     * @param User $user
     */
    public function __construct(User $user)
    {
       return $this->_id = $user;
        // DONE
    }


    /**
     * insère le résultat dans un cache de type Memcache et met à jour l'attribut _id de l'objet en cas d'insertion
     * @param $object
     */
    protected function storeIn($object)
    {
        // DONE
    }

    /**
     * pour se connecter et exécuter une requête SQL, peut lancer les exception de type ConnectStoreException MaintenanceStoreException
     * @param $query
     */
    protected function storeQuery($query)
    {
        // DONE
    }

    /**
     * pour récupérer le résultat courant et se décaler sur le résultat suivant, renvoie la valeur NULL à la fin
     */
    protected function storeNext()
    {
        // DONE
    }

    /**
     * appelle la méthode toCache() de l'objet et insère le résultat dans un cache de type Memcache
     */
    protected function cacheIn($object)
    {
        $serializedObject = $this->toCache();
        $cacheKey = $this->key();
        // DONE
    }

    /**
     * récupère l'objet en cache avec l'id $id et, s'il existe appelle la méthode fromCache() de l'objet récupérer, sinon renvoie la valeur NULL
     */
    protected function cacheOut($id)
    {
        $cacheKey = self::makeKey($id);
        // DONE
        return $this->fromCache();
    }


    /**
     * cette méthode est appelée par cacheIn() pour générer la clef du cache
     */
    private function key()
    {
//        return self::__CLASS__ . PATH_SEPARATOR . $this->_id;
    }


    /**
     * cette méthode est appelée par cacheIn() pour générer la clef du cache
     */
    private static function makeKey($id)
    {
//        return self::__CLASS__ . PATH_SEPARATOR . $id;
    }

}