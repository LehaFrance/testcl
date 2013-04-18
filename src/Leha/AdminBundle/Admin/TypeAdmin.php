<?php
/**
 * @author oyacoubi <oyacoubi@leha-labo.com>
 */

namespace Leha\AdminBundle\Admin;

use \Sonata\AdminBundle\Admin\Admin;
use \Sonata\AdminBundle\Datagrid\ListMapper;
use \Sonata\AdminBundle\Form\FormMapper;
use \Sonata\AdminBundle\Datagrid\DatagridMapper;

class TypeAdmin extends Admin
{
    protected function configureFormFields(FormMapper $form)
    {
        $form
        ->add("name")
        ->add("isActif")
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
        ->addIdentifier("name")
        ->addIdentifier("createAt")
        ->add("isActif")
        ;
    }

    public function preUpdate($type)
    {
        $this->getTypeManager()->updateCanonicalFields($type);
    }

    public function setTypeManager(TypeManagerInterface $typeManager)
    {
        $this->TypeManager = $typeManager;
    }

    public function getTypeManager()
    {
        return $this->TypeManager;
    }
}
