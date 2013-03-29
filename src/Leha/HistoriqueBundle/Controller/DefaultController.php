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

                return $this->redirect($this->generateUrl('leha_historique_search', array(
                    'id' => $requete->getId()
                )));
            }
        }

        return $this->render('LehaHistoriqueBundle:Default:add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function editAction(Request $request, Requete $requete)
    {
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

                return $this->redirect($this->generateUrl('leha_historique_search', array(
                    'id' => $requete->getId()
                )));
            }
        }

        return $this->render('LehaHistoriqueBundle:Default:edit.html.twig', array(
            'form' => $form->createView(),
            'requete' => $requete
        ));
    }

    public function searchAction(Request $request, Requete $requete)
    {
        $echantillons = null;
        if ($request->isMethod('POST')) {
            foreach ($requete->getCriteres() as $critere) {

            }

            $repo = $this->getDoctrine()->getRepository('LehaEchantillonBundle:Echantillon');
            $echantillons = $repo->findAll();
        }


        $form_builder = $this->createFormBuilder();

        foreach ($requete->getCriteres() as $critere) {
            $form_builder->add($critere->getId(), $critere->getType(), array('label' => $critere->getLibelle()));
        }
        $form = $form_builder->getForm();

        return $this->render('LehaHistoriqueBundle:Default:search.html.twig', array(
            'requete' => $requete,
            'form' => $form->createView(),
            'echantillons' => $echantillons
        ));
    }

    public function removeAction(Requete $requete)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($requete);
        $em->flush();

        return $this->redirect($this->generateUrl('leha_historique'));
    }

    public function choix_criteresAction(Request $request, Requete $requete)
    {
        if ($request->isMethod('POST')) {
            $criteres_id = $request->request->get('criteres_selectionnes');

            $repo = $this->getDoctrine()->getRepository('LehaHistoriqueBundle:Critere');

            $aCriteresId = ($criteres_id == '') ? array() : explode('|', $criteres_id);

            $criteres = $requete->getCriteres();
            $criteres_a_conserver = array();
            foreach ($criteres as $critere) {
                if (in_array($critere->getId(), $aCriteresId)) {
                    $criteres_a_conserver[] = $critere->getId();
                } else {
                    $requete->removeCritere($critere);
                }
            }

            $criteres_to_add = array_diff($aCriteresId, $criteres_a_conserver);

            foreach ($criteres_to_add as $critere_id) {
                $critere = $repo->find($critere_id);
                $requete->addCritere($critere);
                echo 'ok';
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($requete);
            $em->flush();

            return $this->redirect($this->generateUrl('leha_historique_search', array('id' => $requete->getId())));
        }

        $em = $this->getDoctrine()->getManager();
        $criteres_disponibles = $em->getRepository('LehaHistoriqueBundle:Requete')->getCriteresDisponibles($requete);


        return $this->render('LehaHistoriqueBundle:Default:choix_criteres.html.twig', array(
            'requete' => $requete,
            'criteres_disponibles' => $criteres_disponibles
        ));
    }
}
