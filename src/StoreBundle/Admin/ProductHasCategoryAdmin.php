<?php

// src/AppBundle/Admin/CategoryAdmin.php
namespace StoreBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ProductHasCategoryAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
          /*->add('product', 'sonata_type_model', array(
            'class' => 'StoreBundle\Entity\Product',
            'property' => 'name',
          ))*/
          ->add('category', 'entity', array(
            'class' => 'AppBundle\Entity\Classification\Category',
            'choice_label' => 'name',
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
                           'show' => array(),
                           'edit' => array()
                       )
                   ));
    }


    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('product.id', null, array('label' => 'ID'))
            ->add('product.name')
            ->add('category.name')
            ->add('createdAt', null, array('label' => 'Date Created'))
            ->add('updatedAt', null, array('label' => 'Last Update'))
        ;
    } 

    public function getExportFields()
    {
        return array('id', 'product.name', 'category.name', 'createdAt', 'updatedAt');
    }

    public function getExportFormats()
    {
        return array('json', 'xml', 'csv');
    }
}