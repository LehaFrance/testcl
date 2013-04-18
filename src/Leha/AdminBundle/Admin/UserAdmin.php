<?php
namespace Leha\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
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
      ->add('roles', 'sonata_security_roles', array( 'multiple' => true))
      ->add('enabled', null, array('required' => false))
      ->add('locked', null, array('required' => false))
     // ->add('groups', 'sonata_type_model', array('multiple' => true))
      ->end()
      ->with('Information')
      ->add('lastName')
      ->add('firstName')
      ->add('type')
      ->add('dateOfBirth','birthday',array('label' => 'Date of birth','required' => true))
      ->add('country')
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
        ->add('enabled')
        ;
    }

    /**
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     */

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
        ->addIdentifier('userName')
        ->addIdentifier('firstName')
        ->add('lastName')
        ->add('email')
        ->add('lastLogin','datetime')
        ->add('dateOfBirth')
        ->add('country')
        ->add('enabled')
        // add custom action links
            ->add('_action', 'actions', array(
            'actions' => array(
                'view' => array(),
                'edit' => array(),
                'delete' => array(),
            )
        ))
        ;
    }

    protected function configureShowField(ShowMapper $showMapper )
    {
        $showMapper
        ->with('Compte')
        ->add('username')
        ->add('email')
        ->end()
        ->with('Inforamation')
        ->add('firstName')
        ->add('lastName')
        ->end()
        ->with('Historique')
        ->add('lastLogin')
        ->end()
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
