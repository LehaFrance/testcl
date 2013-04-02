<?php

namespace Leha\HistoriqueBundle\Controller;

use Leha\HistoriqueBundle\Entity\Requete;
use Leha\HistoriqueBundle\Entity;
use Leha\HistoriqueBundle\Entity\CritereRequete;
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
            /*
			TODO
			foreach ($requete->getCriteres() as $critere) {

            }*/

            $repo = $this->getDoctrine()->getRepository('LehaEchantillonBundle:Echantillon');
            $echantillons = $repo->findAll();
        }
		
        $form_builder = $this->createFormBuilder();
        foreach ($requete->getCriteresRequete() as $critere_requete) {
			$critere = $critere_requete->getCritere();
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
		$em = $this->getDoctrine()->getManager();
		
        if ($request->isMethod('POST')) {
            $criteres_id = $request->request->get('criteres_selectionnes');

            $repo = $this->getDoctrine()->getRepository('LehaHistoriqueBundle:Critere');

            $aCriteresId = ($criteres_id == '') ? array() : explode('|', $criteres_id);

            $criteres_requete = $requete->getCriteresRequete();
            $criteres_a_conserver = array();
            foreach ($criteres_requete as $critere_requete) {
				if (($key_critere_id = array_search($critere_requete->getCritereId(), $aCriteresId)) !== false) {
                //if (in_array($critere_requete->getCritereId(), $aCriteresId)) {
                    $criteres_a_conserver[] = $critere_requete->getCritereId();
					$critere_requete->setOrdre($key_critere_id);
					$em->persist($critere_requete);
                } else {
                    $em->remove($critere_requete);
                }
            }
			
            $criteres_to_add = array_diff($aCriteresId, $criteres_a_conserver);

            foreach ($criteres_to_add as $indice => $critere_id) {
				$critere = $repo->find($critere_id);
                $critere_requete = new CritereRequete();
				
				$critere_requete->setRequete($requete);
				$critere_requete->setCritere($critere);
				$critere_requete->setOrdre($indice);
				$em->persist($critere_requete);
            }
			
            $em->flush();

            return $this->redirect($this->generateUrl('leha_historique_search', array('id' => $requete->getId())));
        }

        
        $criteres_disponibles = $em->getRepository('LehaHistoriqueBundle:Requete')->getCriteresDisponibles($requete);


        return $this->render('LehaHistoriqueBundle:Default:choix_criteres.html.twig', array(
            'requete' => $requete,
            'criteres_disponibles' => $criteres_disponibles
        ));
    }
}
