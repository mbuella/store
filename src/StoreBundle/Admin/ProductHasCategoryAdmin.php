<?php

// src/AppBundle/Admin/CategoryAdmin.php
namespace StoreBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ProductHasCategoryAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
          ->add('product', 'sonata_type_model', array(
            'class' => 'StoreBundle\Entity\Product',
            'property' => 'name',
          ))
          ->add('category', 'sonata_type_model', array(
            'class' => 'AppBundle\Entity\Classification\Category',
            'property' => 'name',
          ));         
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('product', null, array(), 'entity', array(
                    'class'    => 'StoreBundle\Entity\Product',
                    'choice_label' => 'name',
            ))
            ->add('category', null, array(), 'entity', array(
                    'class'    => 'AppBundle\Entity\Classification\Category',
                    'choice_label' => 'name',
            ));
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('product.name')
                      ->add('category.name')

                   // add custom action links
                   ->add('_action', 'actions', array(
                       'actions' => array(
                           'edit' => array(),
                       )
                   ));
    }
}