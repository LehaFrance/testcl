<?php
/**
 * @author oyacoubi <oyacoubi@leha-labo.com>
 */

namespace Leha\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use FOS\UserBundle\Model\GroupManagerInterface;

class GroupAdmin extends Admin
{

    protected function configureFormFields(FormMapper $form)
    {
        $form
        ->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
        ->addIdentifier('name')
        ->addIdentifier('createAt')
        ;
    }

    public function preUpdate($group)
    {
        $this->getGroupManager()->updateGroup($group);
    }

    public function setGroupManager(GroupManagerInterface $groupManager)
    {
        //$this->$groupManager = $groupManager;
    }

    /**
     * @return GroupManagerInterface
     */
    public function getGroupManager()
    {
        return $this->groupManager;
    }
}
