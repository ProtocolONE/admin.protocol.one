<?php namespace AppBundle\Admin;

use AppBundle\Document\GridItem;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class GridItemAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        /**
         * @var GridItem $subject
         */
        $subject = $this->getSubject();
        $image = '';
        $description = <<<EOL
See recommended sizes for the tiles on the page https://telegra.ph/Placing-tiles-on-the-grid-10-05
EOL;

        if ($subject) {
            $container = $this->getConfigurationPool()->getContainer();
            $media = $container->get('sonata.media.twig.extension');
            $format = 'small';

            if($subject->getImage()){
                $image = sprintf('<img src="%s" class="admin-preview" />', $media->path($subject->getImage(), $format));
            }
        }

        $formMapper
            ->with('Main settings', ['class' => 'col-md-6'])
            ->add('game', 'sonata_type_model')
            ->add('image', 'sonata_media_type',
                [
                    'context' => 'gridItem.image',
                    'data_class' => 'Application\Sonata\MediaBundle\Document\Media',
                    'label' => 'Image',
                    'provider' =>'sonata.media.provider.image',
                    'help' => $image,
                ]
            )
            ->end()
            ->with('Position and size', ['class' => 'col-md-6', 'description' => $description])
            ->add('row', IntegerType::class)
            ->add('col', IntegerType::class)
            ->add('width', IntegerType::class)
            ->add('height', IntegerType::class)
            ->end()
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
        $listMapper->addIdentifier('name');
    }
}