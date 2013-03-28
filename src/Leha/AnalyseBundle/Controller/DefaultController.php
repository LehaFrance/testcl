<?php

namespace Leha\AnalyseBundle\Controller;

use Leha\HistoriqueBundle\Entity\Requete;
use Leha\HistoriqueBundle\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('LehaAnalyseBundle:Default:index.html.twig', array('name' => $name));
    }

    public function crossselectAction(Requete $requete)
    {
        $analyses = $this->getDoctrine()->getRepository('LehaAnalyseBundle:Analyse')->findAll();

        $analyses_selectionne = $requete->getAnalyses();

        return $this->render('LehaAnalyseBundle:Default:crossselect.html.twig', array(
            'analyses_disponible' => $analyses,
            'analyses_selectionne' => $analyses_selectionne
        ));
    }
}
