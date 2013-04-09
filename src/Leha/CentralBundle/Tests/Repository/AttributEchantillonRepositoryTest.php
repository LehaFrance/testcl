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
    public function testGetsEntitesByNameAndEchantillonId()
    {
        $client = self::createClient();
        $repository = static::$kernel->getContainer()->get('doctrine.orm.entity_manager')
            ->getRepository('LehaEchantillonBundle:AttributEchantillon');

        $object = $repository->findByNameAndEchantillonId('toto', 1);

        $this->assertTrue($object);
    }
}