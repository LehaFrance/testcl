<?php

namespace Leha\HistoriqueBundle\Form\Handler;

class RequeteHandler extends FormHandler
{
    private $user;

    public function __construct($manager, $security)
    {
        $this->user = $security->getToken()->getUser();
        $this->manager = $manager;
    }

    protected function onSuccess($requete)
    {
        $requete->setUtilisateur($this->user);

        return $this->manager->save($requete);
    }
}