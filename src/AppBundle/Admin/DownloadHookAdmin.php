<?php namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class DownloadHookAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('priorityBefore', NumberType::class)
            ->add('priorityAfter', NumberType::class)
            ->add('downloadHooksRef', 'sonata_type_model')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('priorityBefore');
        $datagridMapper->add('priorityAfter');
        $datagridMapper->add('downloadHooksRef.name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('priorityBefore');
        $listMapper->addIdentifier('priorityAfter');
        $listMapper->addIdentifier('downloadHooksRef.name');
    }
}