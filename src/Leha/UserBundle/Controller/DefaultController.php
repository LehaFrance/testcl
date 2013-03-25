<?php

namespace Leha\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {

        $this->get('leha_user.envoi')->aa();

        $user = 'toto';
        if ($user == 'toto') {
            $user = 'tata';
        }

        if ($user == 'tata') {
            $user = 'aaaa';
        }

        if ($user == 'aaaa') {
            $user = 'bbbb';
        }

        if ($user == 'bbbb') {
            $user = 'cccc';
        }

        if ($user == 'cccc') {
            $user = 'dddd';
        }

        switch ($user) {
            case 'aaaa' :
            case 'bbbb' :
                $user = 'vvvv';
                break;
            case 'cccc' :
                $user = 'xxxx';
                break;
            case 'dddd' :
                $user = 'wwww';
                break;
            default :
                $user = 'none';
                break;
        }



        return $this->render('LehaUserBundle:Default:index.html.twig', array('name' => 'dd'));
    }
}
