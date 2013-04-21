<?php

namespace Leha\CommonBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAware;
use Doctrine\ORM\EntityManager;
use Nelmio\Alice\Loader\Yaml;
use Nelmio\Alice\ORM\Doctrine;
use Leha\UserBundle\Entity\User;

/**
 * Charge des fixtures de base pour utiliser l'application
 *
 * @package Leha\CommonBundle\DataFixtures\ORM
 */
class LoadAttributsData extends ContainerAware implements FixtureInterface
{
    /**
     * Charge une liste de données
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $this->loadFixtures($manager, 'data.yml');

        $user = new User();
        $user->setFirstName('Dupond');
        $user->setLastName('Charlie');
        $user->setPlainPassword('admin');
        $user->setEnabled(true);

        $user->setUsername('admin');
        $user->setEmail('smaignan.web@gmail.com');
        $user->setCountry('France'); // TODO : Relation avec entité Civilité
        $user->setCivility('Civilite'); //TODO : Relation avec entité Civilité

        $manager->persist($user);

        $manager->flush();

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
        $bundles = $this->container->get('kernel')->getBundles();

        $objects = $loader->load($bundles['LehaCommonBundle']->getPath() . '/Resources/fixtures/' . $fixtureFile);

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