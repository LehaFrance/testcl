<?php

namespace Leha\HistoriqueBundle\Controller;

use Leha\HistoriqueBundle\Entity\Requete;
use Leha\HistoriqueBundle\Entity;
use Leha\AnalyseBundle\Entity\Analyse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $requetes = $this->getUser()->getRequetes();

        return $this->render('LehaHistoriqueBundle:Default:index.html.twig', array(
            'requetes' => $requetes
        ));
    }

    public function addAction(Request $request)
    {
        $requete = new Requete();
        $form = $this->createFormBuilder($requete)
            ->add('libelle', 'text')
            ->getForm();

        if ($request->isMethod('POST')) {
            $form->bind($request);

            $requete->setUtilisateur($this->getUser());

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($requete);
                $em->flush();

                return $this->redirect($this->generateUrl('leha_historique'));
            }
        }

        return $this->render('LehaHistoriqueBundle:Default:add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function viewAction(Request $request, Requete $requete)
    {
        $form = $this->createFormBuilder($requete)
            ->add('libelle', 'text')
            ->getForm();

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($requete);
                $em->flush();

                return $this->redirect($this->generateUrl('leha_historique'));
            }
        }

        return $this->render('LehaHistoriqueBundle:Default:view.html.twig', array(
            'form' => $form->createView(),
            'requete' => $requete
        ));
    }

    public function removeAction(Requete $requete)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($requete);
        $em->flush();

        return $this->redirect($this->generateUrl('leha_historique'));
    }

    public function save_analysesAction(Request $request, Requete $requete)
    {
        $analyses_id = $request->request->get('analyses_selectionnees');
        if ($analyses_id != '') {
            $repo = $this->getDoctrine()->getRepository('LehaAnalyseBundle:Analyse');

            $aAnalysesId = explode('|', $analyses_id);
            foreach ($aAnalysesId as $analyse_id) {
                $analyse = $repo->find($analyse_id);
                $requete->addAnalyse($analyse);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($requete);
            $em->flush();
        }
        exit;
        return $this->redirect($this->generateUrl('leha_historique_view', array('id' => $requete->getId())));
    }
}
