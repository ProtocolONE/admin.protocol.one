<?php namespace AppBundle\Admin;

use AppBundle\Document\Announcement;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class AnnouncementAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        /**
         * @var Announcement $subject
         */
        $subject = $this->getSubject();
        $image = '';

        if ($subject) {
            $container = $this->getConfigurationPool()->getContainer();
            $media = $container->get('sonata.media.twig.extension');
            $format = 'small';

            if($subject->getImage()){
                $image = sprintf('<img src="%s" class="admin-preview" />', $media->path($subject->getImage(), $format));
            }
        }

        $formMapper
            ->add('game', 'sonata_type_model')
            ->add('startTime', DateTimeType::class)
            ->add('endTime', DateTimeType::class)
            ->add('image', 'sonata_media_type',
                [
                    'context' => 'announcement.image',
                    'data_class' => 'Application\Sonata\MediaBundle\Document\Media',
                    'label' => 'Image',
                    'provider' =>'sonata.media.provider.image',
                    'help' => $image,
                ]
            )
            ->add('url', TextType::class, ['required' => false])
            ->add('text', TextType::class, ['required' => false])
            ->add('textOnButton', TextType::class)
            ->add('size', 'choice', [
                'choices' => [
                    'Small' => 'small',
                    'Big' => 'big',
                ]
            ])
            ->add('buttonColor', 'choice', [
                'choices' => [
                    'Green' => 'green',
                    'Orange' => 'orange',
                ]
            ])
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('game');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('game.name')
            ->addIdentifier('startTime')
            ->addIdentifier('endTime')
        ;
    }
}