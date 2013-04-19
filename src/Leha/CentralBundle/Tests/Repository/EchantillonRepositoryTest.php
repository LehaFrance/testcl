<?php
namespace Leha\CentralBundle\Tests\Repository;

use Leha\CentralBundle\Tests\WebTestCase;

/**
 * Test le repository Echantillon
 *
 * @package Leha\CentralBundle\Tests\Repository
 */
class EchantillonRepositoryTest extends WebTestCase
{
    /**
     * Teste la fonction de recherche des échantillons dans l'historique
     */
    public function testSearch()
    {
        self::generateSchema();

        $em = static::$kernel->getContainer()->get('doctrine.orm.entity_manager');
        $this->loadFixtures($em, 'echantillons.yml');

        $requete = $em->getRepository('LehaCentralBundle:Requete')->find(1);

        $repoAttributRequete = $em->getRepository('LehaCentralBundle:AttributRequete');
        $formAttributesRequete = $repoAttributRequete->getFormAttributes($requete);

        $repoEchantillon = $em->getRepository('LehaCentralBundle:Echantillon');

        $data = array(
            'itm8' => '1234'
        );

        $this->assertCount(1, $repoEchantillon->search($data, $formAttributesRequete));

        $data = array(
            'etatReception' => 'En attente'
        );

        $this->assertCount(4, $repoEchantillon->search($data, $formAttributesRequete));

        $data = array(
            'itm8' => '5678',
            'etatReception' => 'En attente'
        );

        $this->assertCount(1, $repoEchantillon->search($data, $formAttributesRequete));
    }
}