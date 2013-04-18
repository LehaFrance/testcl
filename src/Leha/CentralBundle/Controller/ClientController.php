<?php

namespace Leha\CentralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('LehaCentralBundle:Default:index.html.twig', array('name' => $name));
    }
}
