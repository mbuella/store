<?php

// src/AppBundle/Admin/CategoryAdmin.php
namespace StoreBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ProductAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', 'text')
                   ->add('description', 'text')
                   ->add('price', 'integer')
                   ->add('quantity', 'integer');         
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name')
                       ->add('price')
                       ->add('quantity');   
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name')
                   ->add('description')
                   ->add('price')
                   ->add('quantity')

                   // add custom action links
                   ->add('_action', 'actions', array(
                       'actions' => array(
                           'show' => array(),
                           'edit' => array(),
                       )
                   ));
    }
}