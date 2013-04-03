<?php

namespace Leha\AttributBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function initAction()
    {
        $em = $this->getDoctrine()->getManager();
        //$repo_attribut = $this->getDoctrine()->getRepository('LehaAttributBundle:Attribut');

        $attribut = $em->
            $attribut = new AttributString();
        $attribut->setLibelle('Conditionnement');
        $attribut->setDescription('Conditionnement');
        $attribut->setScope(Attribut::SCOPE_ATTRIBUT);
        $em->persist($attribut);

        /*$attribut = new AttributChoice();
        $attribut->setLibelle('Etat réception');
        $attribut->setDescription('Etat réception de l\'échantillon');
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

        $em->flush();

        echo 'ok';
        exit;
    }
}
