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
                       ->add('name','text', array(
                            'help' => 'Indicate the name of your product.'
                        ))
                       ->add('description', 'text')
                       ->add('price')
                       ->add('quantity')
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
                                        'required' => true,
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
                       ->add('createdAt','doctrine_orm_date_range');   
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name', null, array(
                         'route' => array(
                             'name' => 'show'
                         )
                     ))
                   ->add('description')

                   // add custom action links
                   ->add('_action', 'actions', array(
                       'actions' => array(
                           'edit' => array(),
                       )
                   ));
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id', null, array('label' => 'ID'))
            ->add('name')
            ->add('description','string')
            ->add('productHasCategories', null, array(
                'template' => 'StoreBundle:Admin:producthascategories.html.twig',
                'label' => 'Categories'
              ))
            ->add('price', 'currency', array(
                'currency' => '$'
              ))
            ->add('quantity', 'number')
            ->add('total', 'currency', array(
                'currency' => '$'
              ))
            ->add('createdAt', null, array(
                'format' => 'F j, Y',
                'label' => 'Date Created'
              ))
            ->add('updatedAt', null, array(
                'format' => 'F j, Y',
                'label' => 'Last Update'
              ))
        ;
    } 

    public function getExportFields()
    {
        return array('id','name', 'description', 'price', 'quantity', 'total', 'createdAt', 'updatedAt');
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
                ->assertRegex(array(
                    // match alphanum and spaces
                    'pattern' => "/^[\w\s]+$/",
                    'message' => "Product name must have numbers, letters and spaces only!"
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
            ->with('productHasCategories')
                ->assertCount(array(
                  'min' => 1,
                  'minMessage' => 'This product should contain one category or more.'
                ))
            ->end();
    }

}