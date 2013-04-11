<?php

namespace Leha\HistoriqueBundle\Controller;

use Leha\CentralBundle\Entity\AttributEchantillon;
use Leha\CommonBundle\Controller\AbstractController;
use Leha\HistoriqueBundle\Entity\Requete;
use Leha\HistoriqueBundle\Entity;
use Leha\HistoriqueBundle\Entity\AttributRequete;
use Leha\CentralBundle\Entity\EchantillonAttribut;
use Leha\CentralBundle\Entity\Attribut;
use Leha\CentralBundle\Specifications\Filters\AsArray;
use Leha\CentralBundle\Specifications\Filters\FilterAttributEchantillon;
use Leha\CentralBundle\Specifications\Filters\AndX;
use Leha\HistoriqueBundle\Form\Type\HistorySearchType;
use Leha\HistoriqueBundle\Model\HistorySearch;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DefaultController
 *
 * @Template
 *
 * @package Leha\HistoriqueBundle\Controller
 */
class DefaultController extends AbstractController
{
    /**
     * Liste les requêtes de l'utilisateur
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $requetes = $this->getUser()->getRequetes();

        return array(
            'requetes' => $requetes
        );
    }

    /**
     * Permet la création d'une nouvelle requête
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Requete $requete = null)
    {
        if ($requete == null) {
            $requete = new Requete();
        }

        $form = $this->createFormBuilder($requete)
            ->add('libelle', 'text')
            ->getForm();

		$process = $this->container->get('leha_requete.handler')
            ->process($request, $form);

		if ($process) {
			return $this->redirectRoute('leha_historique_search', array(
				'id' => $requete->getId()
            ));
		}

        return array(
            'form' => $form->createView(),
            'requete' => $requete
        );
    }

    public function searchAction(Request $request, Requete $requete)
    {
        $em = $this->getDoctrine()->getManager();

        $attributsRequete = $em->getRepository('LehaHistoriqueBundle:AttributRequete')->getByRequeteType($requete, AttributRequete::ATTRIBUT_REQUETE_FORM);

        $form = $this->get('form.factory')->create(new HistorySearchType(), new HistorySearch($attributsRequete), array('attribut_requete' => $attributsRequete));

        $echantillons = null;
        if ($request->isMethod('POST')) {
            $repo_echantillon = $this->getDoctrine()->getRepository('LehaCentralBundle:Echantillon');

            $attributEchantillon = new AttributEchantillon();
            $attributEchantillon->setAttribut($attributsRequete[0]->getAttribut());
            $attributEchantillon->setValue('41395');

            $specification =  new AsArray(new AndX(
                new FilterAttributEchantillon($attributEchantillon)
            ));

            $echantillons = $repo_echantillon->match($specification);
        }

        return array(
            'requete' => $requete,
            'form' => $form->createView(),
            'echantillons' => $echantillons
        );
    }

    /**
     * Supprime une requête
     *
     * @param Requete $requete
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeAction(Requete $requete)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($requete);
        $em->flush();

        return $this->redirectRoute('leha_historique');
    }

    /**
     * Permet d'associer des attributs à une requête
     *
     * @param Request $request
     * @param Requete $requete
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
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

            return $this->redirectRoute('leha_historique_search', array('id' => $requete->getId()));
        }

        $attributs_disponibles = $em->getRepository('LehaHistoriqueBundle:AttributRequete')->getAttributsDisponibles($requete);

        return array(
            'requete' => $requete,
            'attributs_disponibles' => $attributs_disponibles,
            'attributs_requete' => $attributs_requete
        );
    }
}
