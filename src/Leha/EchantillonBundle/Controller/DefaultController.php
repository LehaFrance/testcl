<?php

namespace Leha\EchantillonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $s = $this->get('leha.validclient')->aa();

        return $this->render('LehaEchantillonBundle:Default:index.html.twig');
    }
}