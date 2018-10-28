<?php namespace AppBundle\Admin;

use AppBundle\Document\Gallery;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class GalleryAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        /**
         * @var Gallery $subject
         */
        $subject = $this->getSubject();
        $image = '';
        $preview = '';

        if ($subject) {
            $container = $this->getConfigurationPool()->getContainer();
            $media = $container->get('sonata.media.twig.extension');
            $format = 'small';

            if($subject->getImage()){
                $image = sprintf('<img src="%s" class="admin-preview" />', $media->path($subject->getImage(), $format));
            }

            if($subject->getPreview()){
                $preview = sprintf('<img src="%s" class="admin-preview" />', $media->path($subject->getPreview(), $format));
            }
        }

        $formMapper
            ->add('game', 'sonata_type_model')
            ->add('image', 'sonata_media_type',
                [
                    'required' => false,
                    'context' => 'gallery.image',
                    'data_class' => 'Application\Sonata\MediaBundle\Document\Media',
                    'label' => 'Image',
                    'provider' =>'sonata.media.provider.image',
                    'help' => $image,
                ]
            )
            ->add('preview', 'sonata_media_type',
                [
                    'context' => 'gallery.preview',
                    'data_class' => 'Application\Sonata\MediaBundle\Document\Media',
                    'label' => 'Preview',
                    'provider' =>'sonata.media.provider.image',
                    'help' => $preview,
                ]
            )
            ->add('mp4', TextType::class, ['required' => false])
            ->add('youtubeUrl', TextType::class, ['required' => false])
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
            ->addIdentifier('preview')
        ;
    }
}