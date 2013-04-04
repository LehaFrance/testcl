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
        //$repo_attribut = $this->getDoctrine()->getRepository('LehaAttributBundle:Attribut');

        /*$attribut = new AttributString();
        $attribut->setLibelle('Conditionnement');
        $attribut->setDescription('Conditionnement');
        $attribut->setName('conditionnement');
        $attribut->setScope(Attribut::SCOPE_ATTRIBUT);
        $em->persist($attribut);*/

        /*$attribut = new AttributChoice();
        $attribut->setLibelle('Etat réception');
        $attribut->setDescription('Etat réception de l\'échantillon');
        $attribut->setName('etatReception');
        $attribut->setScope(Attribut::SCOPE_ECHANTILLON);
        $attribut->setOptions(array(
            'attributName' => 'etatReception',
            'options' => array(
                'En attente' => 'En attente',
                'Anomalie' => 'Anomalie',
                'Reçu' => 'Reçu',
                'Abandonne' => 'Abandonne'
            )
        ));
        $em->persist($attribut);*/

        $attribut = new AttributString();
        $attribut->setLibelle('ITM8');
        $attribut->setDescription('ITM8');
        $attribut->setName('itm8');
        $attribut->setScope(Attribut::SCOPE_ATTRIBUT);
        $attribut->setReferenceSolution('ITM8');
        $em->persist($attribut);

        $attribut = new AttributString();
        $attribut->setLibelle('Désignation');
        $attribut->setDescription('Désignation');
        $attribut->setName('designation');
        $attribut->setScope(Attribut::SCOPE_ATTRIBUT);
        $attribut->setReferenceSolution('Designation');
        $em->persist($attribut);

        /*$attribut = new AttributString();
        $attribut->setLibelle('Désignation');
        $attribut->setDescription('Désignation');
        $attribut->setScope(Attribut::SCOPE_ATTRIBUT);
        $attribut->setReferenceSolution('Ma');
        $em->persist($attribut);*/

        $attribut = new AttributString();
        $attribut->setLibelle('Marque');
        $attribut->setDescription('Marque');
        $attribut->setName('marque');
        $attribut->setScope(Attribut::SCOPE_ATTRIBUT);
        $attribut->setReferenceSolution('Marque');
        $em->persist($attribut);

        $attribut = new AttributString();
        $attribut->setLibelle('Emballeur');
        $attribut->setDescription('Emballeur');
        $attribut->setName('emballeur');
        $attribut->setScope(Attribut::SCOPE_ATTRIBUT);
        $attribut->setReferenceSolution('Emballeur');
        $em->persist($attribut);

        $attribut = new AttributString();
        $attribut->setLibelle('Fournisseur');
        $attribut->setDescription('Fournisseur');
        $attribut->setName('fournisseur');
        $attribut->setScope(Attribut::SCOPE_ATTRIBUT);
        $attribut->setReferenceSolution('Fournisseur');
        $em->persist($attribut);

        $attribut = new AttributString();
        $attribut->setLibelle('EAN13');
        $attribut->setDescription('EAN13');
        $attribut->setName('ean13');
        $attribut->setScope(Attribut::SCOPE_ATTRIBUT);
        $attribut->setReferenceSolution('EAN13');
        $em->persist($attribut);

        $em->flush();

        echo 'ok';
        exit;
    }
}
