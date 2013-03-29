<?php

namespace Leha\EchantillonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('LehaEchantillonBundle:Default:index.html.twig', array('name' => $name));
    }
}
