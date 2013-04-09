<?php

namespace Leha\CentralBundle\Repository;

use Leha\CentralBundle\Tests\WebTestCase;
use Leha\CentralBundle\Repository\EchantillonAttributeRepository;

/**
 * La classe pour accèder à la couche model de EchantillonAttribute
 *
 * @package Leha\CentralBundle\Repository
 */
class AttributEchantillonRepositoryTest extends WebTestCase
{
    public function testGetsEntitesByNameAndEchantillon()
    {
        self::generateSchema();

        $em = static::$kernel->getContainer()->get('doctrine.orm.entity_manager');
        $this->loadFixtures($em, 'attributs.yml');
        $this->loadFixtures($em, 'attributEchantillons.yml');

        /** @var $repository AttributEchantillonRepository */
        $repository = $em->getRepository('LehaCentralBundle:AttributEchantillon');

        $echantillon = $em->getRepository('LehaCentralBundle:Echantillon')->findOneByEchantNumero(35);

        $attributEchantillon = $repository->findByNameAndEchantillon('itm8', $echantillon);

        $this->assertEquals('par 4', $attributEchantillon->getValue());
    }
}