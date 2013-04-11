<?php
namespace Leha\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;


class UserAdmin extends Admin
{
    protected function configureFormFields(FormMapper $form)
    {
      $form
      ->with('Compte')
      ->add('username', null, array('required' => true))
      ->add('email', null, array('required' => true))
      ->add('password', 'password', array('required' => true))
      ->add('roles')
      ->add('enabled', null, array('required' => false))
      ->end()
      ->with('Information')
        ->add('firstName')
        ->add('lastName')
      ->end()

      ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
        ->add('username')
        ->add('firstName')
        ->add('lastName')
        ->add('enabled')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
        ->addIdentifier('username')
        ->addIdentifier('firstName')
        ->add('lastName')
        ->add('email')
        ->add('enabled')
        ;
    }


}
