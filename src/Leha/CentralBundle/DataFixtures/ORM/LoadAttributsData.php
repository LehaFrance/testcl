<?php

namespace Leha\CentralBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Leha\CentralBundle\Entity\Attribut;
use Leha\CentralBundle\Entity\AttributString;
use Leha\CentralBundle\Entity\AttributChoice;

class LoadAttributsData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $attribut = new AttributChoice();
        $attribut->setLibelle('Etat réception');
        $attribut->setDescription('Etat réception');
        $attribut->setName('etatReception');
        $attribut->setOptions(array(
            'En attente' => 'En attente'
        ))
        $attribut->setScope(Attribut::SCOPE_ECHANTILLON);
        $attribut->setReferenceSolution('EtatReception');

        $manager->persist($attribut);
        $manager->flush();
    }
}