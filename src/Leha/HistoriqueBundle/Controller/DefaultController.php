<?php

namespace Leha\HistoriqueBundle\Controller;

use Leha\HistoriqueBundle\Entity\Requete;
use Leha\HistoriqueBundle\Entity;
use Leha\HistoriqueBundle\Entity\AttributRequete;
use Leha\CentralBundle\Entity\EchantillonAttribut;
use Leha\CentralBundle\Entity\Attribut;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Leha\HistoriqueBundle\Form\Handler\RequeteHandler;

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

		$process = $this->container->get('leha_requete.handler')->process($this->get('request'), $form);
		if ($process) {
			return $this->redirect($this->generateUrl('leha_historique_search', array(
				'id' => $requete->getId()
            )));
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
        $em = $this->getDoctrine()->getManager();

        $form_builder = $this->createFormBuilder();

        $attributs_requete = $em->getRepository('LehaHistoriqueBundle:AttributRequete')->getByRequeteType($requete, AttributRequete::ATTRIBUT_REQUETE_FORM);

        foreach ($attributs_requete as $attribut_requete) {
            $attribut = $attribut_requete->getAttribut();
            $form_builder->add($attribut->getFieldId(), $attribut->getType(), $attribut->getFieldOptions());
        }

        $form = $form_builder->getForm();

        $echantillons = null;
        if ($request->isMethod('POST')) {
            $repo_echantillon = $this->getDoctrine()->getRepository('LehaCentralBundle:Echantillon');

            $post_data = $form->bind($request)->getData();

            $filter = '';
            $post_use_data = array();
			foreach ($attributs_requete as $attribut_requete) {
                $attribut = $attribut_requete->getAttribut();
                if (isset($post_data[$attribut->getFieldId()]) && $post_data[$attribut->getFieldId()] != '') {
                    if ($attribut->getScope() == Attribut::SCOPE_ECHANTILLON) {
                        $options = $attribut->getOptions();
                        $filter .= 'e.'.$attribut->getName().' = :'.$attribut->getFieldId();
                        $post_use_data[$attribut->getFieldId()] = $post_data[$attribut->getFieldId()];
                    }
                }
            }

            $queryBuilder = $repo_echantillon->getQueryBuilderFiltered($filter, $post_use_data);

            $queryBuilder->setMaxResults(1000);

            $echantillons = $queryBuilder->getQuery()->getResult();

            $echantillons_id = array();
            foreach ($echantillons as $echantillon) {
                $echantillons_id[] = $echantillon->getId();
            }

            if (sizeof($echantillons_id) > 0) {
                foreach ($attributs_requete as $attribut_requete) {
                    $attribut = $attribut_requete->getAttribut();
                    if (isset($post_data[$attribut->getFieldId()]) && $post_data[$attribut->getFieldId()] != '') {
                        if ($attribut->getScope() == Attribut::SCOPE_ATTRIBUT) {
                            $echantillons_attribut = $em->createQuery('select e from LehaCentralBundle:AttributEchantillon e where e.attribut_id = :attribut_id and e.echantillon_id in (:echantillons_id) and e.value like :valeur')
                                ->setParameter('attribut_id', $attribut->getId())
                                ->setParameter('echantillons_id', $echantillons_id)
                                ->setParameter('valeur', $post_data[$attribut->getFieldId()])
                                ->getResult();

                            $echantillons_id = array();
                            foreach ($echantillons_attribut as $echantillon_attribut) {
                                $echantillons_id[] = $echantillon_attribut->getEchantillonId();
                            }

                            if (sizeof($echantillons_id) == 0) {
                                break;
                            }
                        }
                    }
                }

                if (count($echantillons_id) > 0) {
                    foreach ($echantillons as $indice => $echantillon) {
                        if (!in_array($echantillon->getId(), $echantillons_id)) {
                            unset($echantillons[$indice]);
                        }
                    }
                } else {
                    $echantillons = null;
                }
            }
        }

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

    public function choix_attributsAction(Request $request, Requete $requete)
    {
		$em = $this->getDoctrine()->getManager();

        $attributs_requete = $em->getRepository('LehaHistoriqueBundle:AttributRequete')->getByRequeteType($requete, AttributRequete::ATTRIBUT_REQUETE_FORM);

        if ($request->isMethod('POST')) {
            $attributs_id = $request->request->get('attributs_selectionnes');

            $repo_attribut = $this->getDoctrine()->getRepository('LehaCentralBundle:Attribut');

            $aAttributsId = ($attributs_id == '') ? array() : explode('|', $attributs_id);

            $form_builder = $this->createFormBuilder();

            $attributs_a_conserver = array();
            foreach ($attributs_requete as $attribut_requete) {
				if (($key_attribut_id = array_search($attribut_requete->getAttributId(), $aAttributsId)) !== false) {
                    $attributs_a_conserver[] = $attribut_requete->getAttributId();
                    $attribut_requete->setOrdre($key_attribut_id);

					$em->persist($attribut_requete);
                } else {
                    $em->remove($attribut_requete);
                }
            }

            $attributs_to_add = array_diff($aAttributsId, $attributs_a_conserver);

            foreach ($attributs_to_add as $indice => $attribut_id) {
				$attribut = $repo_attribut->find($attribut_id);

                $attribut_requete = new AttributRequete();

                $attribut_requete->setRequete($requete);
                $attribut_requete->setAttribut($attribut);
                $attribut_requete->setOrdre($indice);
                $attribut_requete->setType(AttributRequete::ATTRIBUT_REQUETE_FORM);
				$em->persist($attribut_requete);
            }
			
            $em->flush();

            return $this->redirect($this->generateUrl('leha_historique_search', array('id' => $requete->getId())));
        }

        $attributs_disponibles = $em->getRepository('LehaHistoriqueBundle:AttributRequete')->getAttributsDisponibles($requete);

        return $this->render('LehaHistoriqueBundle:Default:choix_attributs.html.twig', array(
            'requete' => $requete,
            'attributs_disponibles' => $attributs_disponibles,
            'attributs_requete' => $attributs_requete
        ));
    }
}
