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
        $formAttributesRequete = HelperHistory::getAttributsRequete();
        $form = $this->factory->create(new HistorySearchType(), null, array(
            'form_attributes_requete' => $formAttributesRequete
        ));

        $data = array(
            'etatReception' => 'Anomalie',
            'itm8' => '8888'
        );

        $form->bind($data);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($data, $form->getData());
    }
}