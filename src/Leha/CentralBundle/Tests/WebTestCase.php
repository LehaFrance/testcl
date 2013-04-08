<?php

namespace Leha\CentralBundle\Tests;

use Doctrine\DBAL\Schema\SchemaException;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as BaseWebTestCase;

class WebTestCase extends BaseWebTestCase
{
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
}