<?php

namespace Leha\CentralBundle\Tests;

use Doctrine\DBAL\Schema\SchemaException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use Nelmio\Alice\Loader\Yaml;
use Nelmio\Alice\ORM\Doctrine;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as BaseWebTestCase;

/**
 * Classe de base pour tout les tests pour contenir les méthodes reutilisées
 *
 * @package Leha\CentralBundle\Tests
 */
class WebTestCase extends BaseWebTestCase
{
    protected $client;

    public function setUp()
    {
        $this->client = self::createClient();
    }

    /**
     * Drop la base et la recréer
     *
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    protected static function generateSchema()
    {
        if (null === static::$kernel) {
            static::$kernel = static::createKernel();
        }

        $em = static::$kernel->getContainer()->get('doctrine.orm.entity_manager');

        $metadata = $em->getMetadataFactory()->getAllMetadata();

        if (!empty($metadata)) {
            $tool = new SchemaTool($em);
            $tool->dropDatabase();
            $tool->createSchema($metadata);
        } else {
            throw new SchemaException('First Test For Attributs');
        }
    }

    /**
     * Charger les fixtures de CentralBundle selon le parametre.
     *
     * @param EntityManager $em
     * @param string $fixtureFile
     */
    protected function loadFixtures(EntityManager $em, $fixtureFile)
    {
        $loader = new Yaml();
        $bundles = static::$kernel->getBundles();

        $objects = $loader->load($bundles['LehaCentralBundle']->getPath() . '/Resources/fixtures/' . $fixtureFile);

        $toPersist = array();
        foreach ($objects as $object) {
            $toPersist[get_class($object)][] = $object;
        }

        foreach ($toPersist as $objects) {
            $persister = new Doctrine($em);
            $persister->persist($objects);
        }
    }
}