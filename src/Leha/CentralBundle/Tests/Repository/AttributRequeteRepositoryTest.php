<?php
namespace Leha\CentralBundle\Tests\Repository;

use Leha\CentralBundle\Tests\WebTestCase;
use Leha\CentralBundle\Entity\AttributRequete;

/**
 * Test le repository AttributRequete
 *
 * @package Leha\CentralBundle\Tests\Repository
 */
class AttributRequeteRepositoryTest extends WebTestCase
{
    /**
     * Test la méthode getCriteresDisponibles qui doit récupérer la liste des critères disponibles pour une requête donnée
     */
    public function testGetCriteresDisponibles()
    {
        self::generateSchema();

        $em = static::$kernel->getContainer()->get('doctrine.orm.entity_manager');
        $this->loadFixtures($em, 'attributsRequetes.yml');

        $requete = $em->getRepository('LehaCentralBundle:Requete')->find(1);

        $repoAttributRequete = $em->getRepository('LehaCentralBundle:AttributRequete');

        $this->assertCount(1, $repoAttributRequete->getCriteresDisponibles($requete));
    }

    /**
     * Test la méthode getCriteresDisponibles qui doit récupérer la liste des critères disponibles pour une requête donnée
     */
    public function testGetColonnesDisponibles()
    {
        self::generateSchema();

        $em = static::$kernel->getContainer()->get('doctrine.orm.entity_manager');
        $this->loadFixtures($em, 'attributsRequetes.yml');

        $requete = $em->getRepository('LehaCentralBundle:Requete')->find(1);

        $repoAttributRequete = $em->getRepository('LehaCentralBundle:AttributRequete');

        $this->assertCount(2, $repoAttributRequete->getColonnesDisponibles($requete));
    }
}