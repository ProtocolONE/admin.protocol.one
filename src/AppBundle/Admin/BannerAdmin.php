<?php namespace AppBundle\Admin;

use AppBundle\Document\Banner;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class BannerAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        /**
         * @var Banner $subject
         */
        $subject = $this->getSubject();
        $imageApp = '';

        if ($subject) {
            $container = $this->getConfigurationPool()->getContainer();
            $media = $container->get('sonata.media.twig.extension');
            $format = 'small';

            if($subject->getImageApp()){
                $imageApp = sprintf('<img src="%s" class="admin-preview" />', $media->path($subject->getImageApp(), $format));
            }
        }

        $formMapper
            ->add('game', 'sonata_type_model')
            ->add('imageApp', 'sonata_media_type',
                [
                    'context' => 'banner.imageApp',
                    'data_class' => 'Application\Sonata\MediaBundle\Document\Media',
                    'label' => 'ImageApp',
                    'provider' =>'sonata.media.provider.image',
                    'help' => $imageApp,
                ]
            )
            ->add('link', TextType::class, ['required' => false])
            ->add('description', TextType::class, ['required' => false])
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
            ->addIdentifier('imageApp')
        ;
    }
}