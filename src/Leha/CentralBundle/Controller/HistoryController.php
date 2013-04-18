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

    public function searchAction(Request $request, Requete $requete)
    {
        $em = $this->getDoctrine()->getManager();

        $attributsRequete = $em->getRepository('LehaCentralBundle:AttributRequete')->getByRequeteType($requete, AttributRequete::ATTRIBUT_REQUETE_FORM);

        $form = $this->createForm(new HistorySearchType(), null, array('attributs_requete' => $attributsRequete));

        $echantillons = null;
        if ($request->isMethod('POST')) {
            $form->bind($request);

            /**
             * @var $repo_echantillon \Leha\CentralBundle\Repository\EchantillonRepository
             */
            $repo_echantillon = $this->getDoctrine()->getRepository('LehaCentralBundle:Echantillon');
            $data = $form->getData();
            $filters = array();
            array_walk($attributsRequete, function($attributRequete, $key) use($data, &$filters)
            {
                if (isset($data[$attributRequete->getAttribut()->getName()])) {
                    $filters[$attributRequete->getAttribut()->getScope()][] = array(
                        'value' => $data[$attributRequete->getAttribut()->getName()],
                        'attribut' => $attributRequete->getAttribut()
                    );
                }
            });

            $echantillons = $repo_echantillon->search($filters);
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

        $attributs_requete = $em->getRepository('LehaCentralBundle:AttributRequete')->getByRequeteType($requete, AttributRequete::ATTRIBUT_REQUETE_FORM);

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

        $attributs_disponibles = $em->getRepository('LehaCentralBundle:AttributRequete')->getAttributsDisponibles($requete);

        return array(
            'requete' => $requete,
            'attributs_disponibles' => $attributs_disponibles,
            'attributs_requete' => $attributs_requete
        );
    }
}