<?php

namespace Leha\ResultatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('LehaResultatBundle:Default:index.html.twig');
    }
}
