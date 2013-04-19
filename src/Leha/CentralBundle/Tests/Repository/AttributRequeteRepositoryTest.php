<?php
namespace Leha\CentralBundle\Repository;

class AttributRequeteRepositoryTest
{
    public function testGetCriteresDisponibles(Requete $requete)
    {

        return $this->getAttributsDisponibles($requete, AttributRequete::ATTRIBUT_REQUETE_FORM);
    }
}