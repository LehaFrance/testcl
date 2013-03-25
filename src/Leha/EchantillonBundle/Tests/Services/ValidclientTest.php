<?php

namespace Leha\EchantillonBundle\Tests\Services;

use Leha\EchantillonBundle\Services\Validclient;

class ValidclientTest extends \PHPUnit_Framework_TestCase
{
    public function testaa()
    {
        $c = new Validclient();


        $this->assertEquals(true, $c->aa());

        return true;
    }
}