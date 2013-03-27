<?php

namespace Leha\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {

        $this->get('leha_user.envoi')->aa();


        return $this->render('LehaUserBundle:Default:index.html.twig', array('name' => 'dd'));
    }
}
