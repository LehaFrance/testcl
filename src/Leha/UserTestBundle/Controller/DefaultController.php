<?php

namespace Leha\UserTestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('LehaUserTestBundle:Default:index.html.twig', array('name' => $name));
    }
}
