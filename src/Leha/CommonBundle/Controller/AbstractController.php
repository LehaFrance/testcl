<?php
namespace Leha\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Controlleur commun
 *
 * @package Leha\CommonBundle\Controller
 */
abstract class AbstractController extends Controller
{
    /**
     * Redirect intégrant la fonction generateUrl
     *
     * @param string $routeName
     * @param array $attributes
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function redirectRoute($routeName, $attributes = array())
    {
        return $this->redirect($this->generateUrl($routeName, $attributes));
    }
}