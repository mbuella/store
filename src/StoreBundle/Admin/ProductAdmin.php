<?php

// src/AppBundle/Admin/CategoryAdmin.php
namespace StoreBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Validator\ErrorElement;



class ProductAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->tab('Product')
                       ->add('name','text')
                       ->add('description', 'text')
                       ->add('price', 'integer')
                       ->add('quantity', 'integer')
                       ->end()
                   ->end()         
                    // add new tab for category
                   ->tab('Categories')
                       ->add('productHasCategories', 'sonata_type_collection', array(
                            'by_reference' => false,
                            'type_options' => array(
                                // Prevents the "Delete" option from being displayed
                                'delete' => false,
                                'delete_options' => array(
                                    // You may otherwise choose to put the field but hide it
                                    'type'         => 'hidden',
                                    // In that case, you need to fill in the options as well
                                    'type_options' => array(
                                        'mapped'   => true,
                                        'required' => false,
                                    )
                                )
                            )
                        ), array(
                            'edit' => 'inline',
                            'inline' => 'table',
                            'sortable' => 'position',
                            'admin_code' => 'admin.product_has_category'
                        ))
                       
                       ->end()
                   ->end();         
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
                   // ->add('price')
                   // ->add('quantity')

                   // add custom action links
                   ->add('_action', 'actions', array(
                       'actions' => array(
                           'show' => array(),
                           'edit' => array(),
                       )
                   ));
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id', null, array('label' => 'ID'))
            ->add('name')
            ->add('description')
            ->add('productHasCategories', null, array('label' => 'Categories'))
            ->add('price')
            ->add('quantity')
            ->add('createdAt', null, array('label' => 'Date Created'))
            ->add('updatedAt', null, array('label' => 'Last Update'))
        ;
    } 

    public function getExportFields()
    {
        return array('id','name', 'description', 'price', 'quantity', 'createdAt', 'updatedAt');
    }

    public function getExportFormats()
    {
        return array('json', 'xml', 'csv');
    }

    public function validate(ErrorElement $errorElement, $object)
    {
        $errorElement
            ->with('name')
                ->assertRequired()
                ->assertLength(array(
                    'min' => 5,
                    'max' => 100
                ))
            ->end()
            ->with('description')
                ->assertRequired()
                ->assertLength(array(
                    'min' => 5,
                    'max' => 500
                ))
            ->end()
            ->with('price')
                ->assertRequired()
                ->assertType(['type'=>"numeric"])
            ->end()
            ->with('quantity')
                ->assertRequired()
                ->assertType(['type'=>"numeric"])
                ->assertGreaterThan(['value'=>0])
            ->end()
        ;
    }

}