<?php

class Exo3BlackList extends AbstractEdge
{
    const CEST_MOI = 'CEST_MOI_MEME';

    /**
     * Exo3BlackList constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
    }


    /**
     * Ajouter une personne à la blackliste de l'utilisateur courant
     * @param User $user
     * @return int
     */
    public function add(User $user)
    {
        $user_blacklist = $user->read($user->getId());
        var_dump($user_blacklist->getId());
        var_dump($this->_id->getId());

        if ($user_blacklist->getId() == $this->_id->getId())
        {
            return self::CEST_MOI;
        }

       $user_blacklist->UpdateUserToBlackList($user_blacklist->getEmail());

       $user_blacklist->AddUserToBlackList($this->_id->getId(),$user_blacklist->getId());
    }

    /**
     * Retirer une personne à la blackliste de l'utilisateur courant
     * @param User $user
     * @return string
     */
    public function remove(User $user)
    {
        $user_blacklist = $user->read($user->getId());
        var_dump($user_blacklist->getId());
        var_dump($this->_id->getId());

        if ($user_blacklist->getId() == $this->_id->getId())
        {
            return self::CEST_MOI;
        }

        $user_blacklist->UpdateUsersTable($user_blacklist->getEmail());

        $user_blacklist->removeUserToBlackList($user_blacklist->getId());
    }

    /**
     * Vérifier si l'utilisateur courant peut voir une personne
     * @param User $user
     */
    public function isAllowed(User $user)
    {
        // TODO: Implement isAllowed() method.
    }
}