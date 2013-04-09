<?php

namespace Leha\CentralBundle\Services;

use Leha\CentralBundle\Exception\AttributException;

class AttributManager
{
    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param $echantillonId
     * @param $name
     * @return string
     */
    public function getValue($echantillonId, $name)
    {
        $attributs = $this->entityManager->getRepository('LehaCentralBundle:Attribut')
            ->findByName($name);
        if (sizeof($attributs) == 1) {
            $attribut = $attributs[0];
            $repoAttributEchantillon = $this->entityManager->getRepository('LehaEchantillonBundle:AttributEchantillon');
            $attributEchantillons = $repoAttributEchantillon->findBy(
                array(
                    'echantillon_id' => $echantillonId,
                    'attribut_id' => $attribut->getId()
                )
            );
            switch (sizeof($attributEchantillons)) {
                case 0:
                    return '';
                    break;
                case 1:
                    $attributEchantillon = $attributEchantillons[0];
                    return $attributEchantillon->getValue();
                    break;
                default:
                    throw new AttributException('Plusieurs valeurs pour cet attribut');
                    break;
            }
        } else {
            throw new AttributException('Attribut non reconnu');
        }

        return '';
    }
}