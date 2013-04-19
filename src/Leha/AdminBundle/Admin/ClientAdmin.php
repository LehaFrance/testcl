<?php
/**
 * @author oyacoubi <oyacoubi@leha-labo.com>
 */

namespace Leha\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;


class ClientAdmin extends Admin
{
    public function configureFormFields(FormMapper $form)
    {
        $form
        ->add('nom');
    }

    public function configureListFields(ListMapper $listMapper)
    {
        $listMapper
        ->add(nom)
        ;
    }
}
