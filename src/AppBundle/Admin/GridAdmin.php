<?php namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class GridAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $description = <<<EOL
The grid is a virtual table consisting of 4 lines and 3 columns. 
When adding items, you can specify their location, as well as the size taken up in the grid. 
See examples on the page https://telegra.ph/Placing-tiles-on-the-grid-10-05
EOL;

        $formMapper
            ->with('Grid - is collection of tiles for the main screen of the application', ['description' => $description])
            ->add('name', TextType::class)
            ->add('isActive', CheckboxType::class, ['required' => false])
            ->add('gridItems', 'sonata_type_model', ['multiple' => true])
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
        $datagridMapper->add('isActive');
        $datagridMapper->add('createdAt');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('isActive', null, ['header_class' => 'col-md-1'])
            ->add('createdAt', null, ['header_class' => 'col-md-2'])
            ->addIdentifier('name', 'text', ['header_class' => 'col-md-9'])
        ;
    }
}