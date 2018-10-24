<?php namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class MaintenanceAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Main settings', ['class' => 'col-md-6'])
            ->add('game', 'sonata_type_model')
            ->add('startDate', DateTimeType::class)
            ->add('endDate', DateTimeType::class)
            ->add('title', TextType::class)
            ->add('isSticky', CheckboxType::class, ['required' => false])
            ->end()
            ->with('News', ['class' => 'col-md-6'])
            ->add('newsTitle', TextType::class, ['required' => false])
            ->add('newsLink', TextType::class, ['required' => false])
            ->add('newsText', TextareaType::class, ['required' => false])
            ->end()
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('game.name')
            ->addIdentifier('startDate')
            ->addIdentifier('endDate')
            ->addIdentifier('title')
            ->addIdentifier('isSticky')
        ;
    }
}