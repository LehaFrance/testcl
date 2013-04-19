<?php
namespace Leha\CentralBundle\Tests\Controller;

use Leha\CentralBundle\Tests\WebTestCase;

/**
 * Class de test du controller history
 *
 * @package Leha\CentralBundle\Tests\Controller
 */
class HistoryControllerTest extends WebTestCase
{
    private function createAuthorizedClient($container, $role)
    {
        $userProvider = $container->get('fos_user.user_provider.username');
        $user = $userProvider->loadUserByUsername('usertest');

        $client = $this->createClient(); //Normal WebTestCase client
        $client->getCookieJar()->set(new Cookie(session_name(), true));
        $session = self::$kernel->getContainer()->get('session');
        $token =  new UsernamePasswordToken($user, 'password', 'main', array($role));
        $client->getContainer()->get('security.context')->setToken($token);
        $session->set('_security_main', serialize($token));

        return $client;
    }

    public function testIndex()
    {
        self::generateSchema();

        $em = static::$kernel->getContainer()->get('doctrine.orm.entity_manager');
        $this->loadFixtures($em, 'historyController.yml');

        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'testuser',
            'PHP_AUTH_PW' => 'testpwd'
        ));

        $crawler = $client->request('GET', '/historique');

        $c = $crawler->filter('div[class=ok]');
        //$this->assertCount(4, $c);
        $this->assertTrue($client->getResponse()->isRedirect());
    }
}