<?php

namespace Leha\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('LehaDashboardBundle:Default:index.html.twig');
    }
}
