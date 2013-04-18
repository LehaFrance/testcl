<?php
namespace Leha\CentralBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Leha\CentralBundle\Entity\AttributEchantillon;
use Leha\CentralBundle\Specifications\Filters\FilterEchantillon;
use Leha\CommonBundle\Controller\AbstractController;
use Leha\CentralBundle\Entity\Requete;
use Leha\CentralBundle\Entity;
use Leha\CentralBundle\Entity\AttributRequete;
use Leha\CentralBundle\Entity\EchantillonAttribut;
use Leha\CentralBundle\Repository\EchantillonRepository;
use Leha\CentralBundle\Form\Type\HistorySearchType;
use Leha\CentralBundle\Model\HistorySearch;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class HistoryController
 *
 * @Template
 *
 * @package Leha\CentralBundle\Controller
 */
class HistoryController extends AbstractController
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

    /**
     * Permet de lancer le moteur de recherche dans l'historique
     *
     * @param Request $request
     * @param Requete $requete
     *
     * @return DoctrineCollection
     */
    public function searchAction(Request $request, Requete $requete)
    {
        $em = $this->getDoctrine()->getManager();

        /**
         * @var $repoAttribute \Leha\CentralBundle\Repository\AttributRepository
         */
        $repoAttribute = $em->getRepository('LehaCentralBundle:AttributRequete');
        $formAttributesRequete = $repoAttribute->getFormAttributes($requete);
        $gridAttributesRequete = $repoAttribute->getGridAttributes($requete);

        $form = $this->createForm(new HistorySearchType(), null, array('form_attributes_requete' => $formAttributesRequete));

        $echantillons = null;
        if ($request->isMethod('POST')) {
            $form->bind($request);

            /**
             * @var $repoEchantillon \Leha\CentralBundle\Repository\EchantillonRepository
             */
            $repoEchantillon = $this->getDoctrine()->getRepository('LehaCentralBundle:Echantillon');
            $echantillons = $repoEchantillon->search($form->getData(), $formAttributesRequete);
        }

        return array(
            'requete' => $requete,
            'gridAttributesRequete' => $gridAttributesRequete,
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
    public function choixCriteresAction(Request $request, Requete $requete, $type)
    {
        $em = $this->getDoctrine()->getManager();

        /**
         * @var $repoAttributRequete \Leha\CentralBundle\Repository\AttributRequeteRepository
         */
        $repoAttributRequete = $em->getRepository('LehaCentralBundle:AttributRequete');

        $formAttributesRequete = $repoAttributRequete->getByRequeteType($requete, $type);
        if ($request->isMethod('POST')) {
            $attributs_id = $request->request->get('attributs_selectionnes');

            $repoAttribut = $this->getDoctrine()->getRepository('LehaCentralBundle:Attribut');

            $aAttributsId = ($attributs_id == '') ? array() : explode('|', $attributs_id);

            $attributesToKeep = array();
            foreach ($formAttributesRequete as $formAttributeRequete) {
                if (($attributeOrder = array_search($formAttributeRequete->getAttributId(), $aAttributsId)) !== false) {
                    $attributesToKeep[] = $formAttributeRequete->getAttributId();
                    $formAttributeRequete->setOrdre($attributeOrder);

                    $em->persist($formAttributeRequete);
                } else {
                    $em->remove($formAttributeRequete);
                }
            }

            $attributesToAdd = array_diff($aAttributsId, $attributesToKeep);

            foreach ($attributesToAdd as $indice => $attribut_id) {
                $attribut = $repoAttribut->find($attribut_id);

                $attributRequete = new AttributRequete();

                $attributRequete->setRequete($requete);
                $attributRequete->setAttribut($attribut);
                $attributRequete->setOrdre($indice);
                $attributRequete->setType($type);
                $em->persist($attributRequete);
            }

            $em->flush();

            return $this->redirectRoute('leha_historique_search', array('id' => $requete->getId()));
        }

        $attributsDisponibles = $repoAttributRequete->getAttributsDisponibles($requete, $type);

        return array(
            'requete' => $requete,
            'type' => $type,
            'attributs_disponibles' => $attributsDisponibles,
            'attributs_requete' => $formAttributesRequete
        );
    }
}