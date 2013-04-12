<?php
namespace Leha\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use FOS\UserBundle\Model\UserManagerInterface;

class UserAdmin extends Admin
{
    /**
     * Configuration de la form de saisi des utilisateurs
     * @param \Sonata\AdminBundle\Form\FormMapper $form
     */
    protected function configureFormFields(FormMapper $form)
    {
      $form
      ->with('Compte')
      ->add('username', null, array('required' => true))
      ->add('email', null, array('required' => true))
          ->add('plainPassword', 'text')
          ->add('roles', 'sonata_security_roles', array( 'multiple' => true))
          ->add('enabled', null, array('required' => false))
      ->end()
      ->with('Information')
          ->add('lastName')
          ->add('firstName')
      ->end()
      ;
    }

    /**
     * Datagrid d'affichage des utilisateurs
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
        ->add('username')
        ->add('firstName')
        ->add('lastName')
        ->add('enabled')
        ->add('lastLogin')
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     */

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
        ->addIdentifier('username')
        ->addIdentifier('firstName')
        ->add('lastName')
        ->add('email')
        ->add('lastLogin','datetime')
        ->add('enabled')
        ;
    }

    public function preUpdate($user)
    {
        $this->getUserManager()->updateCanonicalFields($user);
        $this->getUserManager()->updatePassword($user);
    }

    public function setUserManager(UserManagerInterface $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * @return UserManagerInterface
     */
    public function getUserManager()
    {
        return $this->userManager;
    }

}
