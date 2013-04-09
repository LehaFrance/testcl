<?php

namespace Leha\CentralBundle\Tests\Controller;

use Leha\CentralBundle\Tests\WebTestCase;

/**
 * Test le controlleur. Pour l'instant juste pour charger les fixtures
 *
 * @package Leha\CentralBundle\Tests\Controller
 */
class DefaultControllerTest extends WebTestCase
{
    /**
     * Test le bon chargement de fixtures
     */
    public function testFixture()
    {
        self::generateSchema();

        $em = static::$kernel->getContainer()->get('doctrine.orm.entity_manager');

        $this->loadFixtures($em, 'attributs.yml');

        $this->assertCount(3, $em->getRepository('LehaCentralBundle:Attribut')->findAll());
    }
}
