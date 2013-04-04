<?php

namespace Leha\AttributBundle\Services;

class AttributManager
{
    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getValue($echantillon_id, $name)
    {
        $repo_attribut = $this->entityManager->getRepository('LehaAttributBundle:Attribut');
        $attributs = $repo_attribut->findByName($name);
        if (sizeof($attributs) == 1) {
            $attribut = $attributs[0];
            $repo_ae = $this->entityManager->getRepository('LehaEchantillonBundle:AttributEchantillon');
            $attribut_echantillons = $repo_ae->findBy(
                array(
                    'echantillon_id' => $echantillon_id,
                    'attribut_id' => $attribut->getId()
                )
            );
            switch (sizeof($attribut_echantillons)) {
                case 0:
                    return '';
                    break;
                case 1:
                    $attribut_echantillon = $attribut_echantillons[0];
                    return $attribut_echantillon->getValue();
                    break;
                default:
                    //TODO : Lever exception
                    break;
            }
        } else {
            //TODO : Lever exception
        }

        return '';
    }
}