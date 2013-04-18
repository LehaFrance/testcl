<?php

namespace Leha\CentralBundle\Tests\Form\Type;

use Leha\CentralBundle\Entity\AttributString;
use Leha\CentralBundle\Entity\AttributRequete;
use Leha\CentralBundle\Form\Type\HistorySearchType;
use Leha\CentralBundle\Model\HistorySearch;
use Leha\CentralBundle\Tests\Helper\HelperHistory;
use Symfony\Component\Form\Tests\Extension\Core\Type\TypeTestCase;

class HistorySearchTypeTest extends TypeTestCase
{
    public function testHistorySearchType()
    {
        $attributs_requete = HelperHistory::getAttributsRequete();

        $type = new HistorySearchType();
        $form = $this->factory->create($type, null, array(
            'attributs_requete' => $attributs_requete
        ));

        $data = array(
            'attributes' => array(
                'ATTR_8' => '12121'
            )
        );

        $a = array(
            'etatReception' => 'Anomalie',
            'marque' => null,
            'itm8' => null
        );

        $form->bind($data);

        $this->assertTrue($form->isSynchronized());
        //$this->assertEquals($a, $form->getData());
    }
}