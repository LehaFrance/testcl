<?php

namespace Leha\AttributBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Leha\AttributBundle\Entity\Attribut;
use Leha\AttributBundle\Entity\AttributString;
use Leha\AttributBundle\Entity\AttributChoice;

class DefaultController extends Controller
{
    public function initAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repo_attribut = $this->getDoctrine()->getRepository('LehaAttributBundle:Attribut');

        $items = array(
            array(
                'libelle' => 'Conditionnement',
                'name' => 'conditionnement',
                'scope' => Attribut::SCOPE_ATTRIBUT,
                'reference_solution' => 'Conditionnement',
                'type' => 'String'
            ),
            array(
                'libelle' => 'Etat réception',
                'name' => 'etatReception',
                'description' => 'Etat réception de l\'échantillon',
                'scope' => Attribut::SCOPE_ECHANTILLON,
                'type' => 'Choice',
                'options' => array(
                    'options' => array(
                        'En attente' => 'En attente',
                        'Anomalie' => 'Anomalie',
                        'Reçu' => 'Reçu',
                        'Abandonne' => 'Abandonne'
                    )
                )
            ),
            array(
                'libelle' => 'ITM8',
                'name' => 'itm8',
                'scope' => Attribut::SCOPE_ATTRIBUT,
                'reference_solution' => 'ITM8',
                'type' => 'String'
            ),
            array(
                'libelle' => 'Désignation',
                'name' => 'designation',
                'scope' => Attribut::SCOPE_ATTRIBUT,
                'reference_solution' => 'Designation',
                'type' => 'String'
            ),
            array(
                'libelle' => 'Marque',
                'name' => 'marque',
                'scope' => Attribut::SCOPE_ATTRIBUT,
                'reference_solution' => 'Marque',
                'type' => 'String'
            ),
            array(
                'libelle' => 'Emballeur',
                'name' => 'emballeur',
                'scope' => Attribut::SCOPE_ATTRIBUT,
                'reference_solution' => 'Emballeur',
                'type' => 'String'
            ),
            array(
                'libelle' => 'EAN13',
                'name' => 'ean13',
                'scope' => Attribut::SCOPE_ATTRIBUT,
                'reference_solution' => 'EAN13',
                'type' => 'String'
            ),
            array(
                'libelle' => 'Fournisseur',
                'name' => 'fournisseur',
                'scope' => Attribut::SCOPE_ATTRIBUT,
                'reference_solution' => 'Fournisseur',
                'type' => 'String'
            )
        );

        foreach ($items as $item) {
            $attributs = $repo_attribut->findByLibelle($item['libelle']);
            if (sizeof($attributs) == 0) {
                $classattribut = 'Leha\AttributBundle\Entity\Attribut'.$item['type'];
                $attribut = new $classattribut();
            } else {
                $attribut = $attributs[0];
            }

            $attribut->setLibelle($item['libelle']);
            $attribut->setDescription((isset($item['description'])) ? $item['description'] : $item['libelle']);
            $attribut->setReferenceSolution((isset($item['reference_solution'])) ? $item['reference_solution'] : '');
            $attribut->setName($item['name']);
            $attribut->setScope($item['scope']);
            if (isset($item['options'])) {
                $attribut->setOptions($item['options']);
            }
            $em->persist($attribut);
        }

        $em->flush();

        return $this->render('LehaAttributBundle:Default:index.html.twig');
    }
}
