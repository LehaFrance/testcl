<?php

namespace Leha\HistoriqueBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class HistorySearchType extends AbstractType
{
    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'leha_historique_history_search';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        foreach ($options['attribut_requete'] as $attribut_requete) {
            $attribut = $attribut_requete->getAttribut();
            $builder->add($attribut->getFieldId(), $attribut->getType(), $attribut->getFieldOptions());
        }

    }

}