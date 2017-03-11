<?php

    /*
    * EXO 1 :
    * soit le tableau $p
    * Alimentez $p de telle sorte qu'ils contiennent en français, les mois d'une année.
    */

$p = array();



    /**
    * EXO 2 :
    * Création d'un système de pagination et d'affichage de résultats à partir de 2 tableaux fusionnés.
    * 
    * Préambule :
    * 
    * Les résultats à afficher seront issues des valeurs alternées de 2 tableaux existants :
    * -Tableau avec 500 valeurs impaires (t_impair) allant de 1 à 999
    * -Tableau avec 200 valeurs paires (t_pair) allant de 2 à 400
    * -Suite des 700 valeurs à afficher sans pagination : 1,2,3,4,5,6,7,8,9,....,991,993,995,997,999
    * 
    * 
    * But créer les méthodes/fonctions permettant de :
    * 
    * -Calculer le nombre de page totale de pagination suivant le nombre de résultats à afficher par page :
    * lastPage($resultsToShowPerPage)
    * 
    * 
    * -Afficher les résultats selon une plage donnée :
    * showResult($pageNumber, $resultsToShowPerPage)
    * 
    * Voilà ce que devront afficher les couples de valeurs suivantes :
    * showResult($pageNumber=3, $resultsToShowPerPage=8) => 17,18,19,20,21,22,23,24
    * showResult($pageNumber=3, $resultsToShowPerPage=1) => 3
    * showResult($pageNumber=lastPage(4), $resultsToShowPerPage=4) => 993,995,997,999
    * showResult($pageNumber=lastPage(1), $resultsToShowPerPage=1) => 999
    * 
    * 
    * Le but de l'exercice est de trouver une solution élégante et optimisée pour exécuter cette pagination.
    * 
    * On remarquera que le tableau t_pair est plus petit que t_impair.
    * 
    * Pour faciliter la compréhension de l'exercice il faut imaginer t_pair et t_impair comme 2 RecordSet d'une base de données, auxquels on accède avec des LIMIT (sur MySql).
    * 
    * Contraintes :
    * 
    * -La suite des valeurs alternées (1,2,3,....997,999) ne pourra pas être conservée en mémoire. Les plages de valeurs à afficher devront être recalculées à chaque navigation de page en page.
    * -Eviter de regénérer la suite complète de valeurs alternées (1,2,3,....997,999) à chaque pagination, mais plutôt récupérer uniquement le nombre exact de valeurs nécessaires dans t_pair et t_impair.
    */



    /**
     * EXO 3: 
     * 
     * Dans le contexte d'un site de rencontre les utilisateurs peuvent Blacklister un autre membre
     * On souhaite que les personnes blacklistées ne puissent pas se voir entre elles: dans les 2 sens
     * 
     * 1/ ============================================================
     * Vous devez coder la classe Blacklist qui doit pouvoir : 
     * - ajouter une personne à la blackliste de l'utilisateur courant
     * - retirer une personne à la blackliste de l'utilisateur courant
     * - vérifier si l'utilisateur courant peut voir une personne
     * 
     * Pour cet exercice vous disposez des 2 classes finies suivantes et des variables:
     * (User) $me, (user) $target
     * 
     * Les champs de la table "edge" sont
     * - int fromUser_ID
     * - int toUser_ID
     * - timestamp timestamp
     * - enum(blacklist, favoris, poke, visite) type
     * 
     * 
     * Vous serez évalués sur la clareté du code, sa modularité et sa performance
     * 
     * 2/ ============================================================
     * Faites de même pour Favoritelist, Pokelist et Viewlist
     * 
     * 3/ ============================================================
     * Pourquoi vous devriez avoir une erreur intermittente? 
     * 
     */


abstract class AbstractEdge
{

    protected $_id;


    abstract public function add(User $user);

    abstract public function remove(User $user);

    abstract public function isAllowed(User $user);


    /**
     * constructeur
     */
    public function __construct(User $user)
    {
        // DONE
    }


    /**
     * insère le résultat dans un cache de type Memcache et met à jour l'attribut _id de l'objet en cas d'insertion
     */
    protected function storeIn($object)
    {
        // DONE
    }

    /**
     * pour se connecter et exécuter une requête SQL, peut lancer les exception de type ConnectStoreException MaintenanceStoreException
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
        return self::__CLASS__.PATH_SEPARATOR.$this->_id;
    }


    /**
     * cette méthode est appelée par cacheIn() pour générer la clef du cache
     */
    private static function makeKey($id)
    {
        return self::__CLASS__.PATH_SEPARATOR.$id;
    }

}


class User
{
    public function getId()
    {
        // DONE
    }
}


   /**
     * EXO 4: 
     * 
     * Afin d'éviter le bombardement de messages en interne, proposez une classe
     * qui détecte les messages similaires
     * Le but est de reconnaître un SPAM
     * - envoi de plusieurs messages similaires
     * - envoi d'un nombre FLOOD_MAXCOUNT de messages en une tranche de temps FLOOD_TIMESECONDS
     * 
     * Exemple, si un utilisateur envoie plus de 50 messages en 5 minutes c'est un Spammeur
     * 
     * A chaque envoie de message on appelle la méthode $antiSpam->notify(theMessage)
     * qui doit retourner la date à partir de laquelle le spamming a commencée.
     * 
     * 
     * Le site est hébergé sur N serveurs, un visiteur peut passer de manière
     * transparent de l'un à l'autre
     * Le cache et la base de donnée permettent l'unicité des données entre
     * Vous pouvez apporter votre propre solution
     * 
     * 1/ ============================================================
     * Codez la classe, en vous aidant si besoin des fonctions similaires à
     * l'exercice précédent: storeIn, storeQuery, storeNext, cacheIn, cacheOut
     * ajouter 
     * 
     * 
     * Vous serez évalués sur la clareté du code, sa modularité et sa performance
     * 
     * 2/ ============================================================
     * Expliquez vos choix: simplification, imprécision, compromis performance, etc.
     * 
     */

class Message
{
    public $fromUserId;
    public $toUserId;
    public $description;
    public $date;
}

class AntiSpam
{
    public function notify(Message aMessage)
    {
        // TODO
        return $firstDate;
    }

    // TODO
}


for($m = 1;$m <= 12; $m++){ 
    $month =  date("F", mktime(0, 0, 0, $m, 1)); 
    echo "<option value='$m'>$month</option>"; 
} 