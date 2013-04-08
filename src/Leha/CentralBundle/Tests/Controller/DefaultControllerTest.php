<?php

namespace Leha\CentralBundle\Tests\Controller;

use Leha\CentralBundle\Tests\WebTestCase;
use Nelmio\Alice\Loader\Base;
use Nelmio\Alice\Loader\Yaml;
use Nelmio\Alice\ORM\Doctrine;

class DefaultControllerTest extends WebTestCase
{
    public function testFixture()
    {
        $client = self::createClient();
        self::generateSchema();

        $loader = new Yaml();
        $bundles = static::$kernel->getBundles();

        $objects = $loader->load($bundles['LehaCentralBundle']->getPath() . '/Resources/fixtures/attributs.yml');

        $em = static::$kernel->getContainer()->get('doctrine.orm.entity_manager');
        $persister = new Doctrine($em);
        $persister->persist($objects);

        $this->assertCount(3, $em->getRepository('LehaAttributBundle:Attribut')->findAll());
    }
}
