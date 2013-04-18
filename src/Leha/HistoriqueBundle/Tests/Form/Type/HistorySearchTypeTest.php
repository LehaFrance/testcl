<?php

namespace Leha\HistoriqueBundle\Tests\Form\Type;

use Leha\CentralBundle\Entity\AttributString;
use Leha\HistoriqueBundle\Entity\AttributRequete;
use Leha\HistoriqueBundle\Form\Type\HistorySearchType;
use Leha\HistoriqueBundle\Model\HistorySearch;
use Leha\CentralBundle\Tests\Helper\HelperHistory;
use Symfony\Component\Form\Tests\Extension\Core\Type\TypeTestCase;

class HistorySearchTypeTest extends TypeTestCase
{
    public function testHistorySearchType()
    {
        $attributs_requete = HelperHistory::getAttributsRequete();

        $type = new HistorySearchType();
        $form = $this->factory->create($type, null, array(
            'attribut_requete' => $attributs_requete
        ));

        $data = array(
            'attributes' => array(
                'ATTR_8' => '12121'
            )
        );
        $form->bind($data);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($historySearch, $form->getData());
    }
}