<?php namespace AppBundle\Admin;

use AppBundle\Document\News;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\MediaBundle\Provider\MediaProviderInterface;
use Application\Sonata\MediaBundle\Document\Media;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class NewsAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        /**
         * @var News $subject
         */
        $subject = $this->getSubject();
        $appImage = '';

        if ($subject) {
            $container = $this->getConfigurationPool()->getContainer();
            $media = $container->get('sonata.media.twig.extension');
            $format = MediaProviderInterface::FORMAT_REFERENCE;

            if($subject->getAppImage()){
                $appImage = sprintf('<img src="%s" class="admin-preview" />', $media->path($subject->getAppImage(), $format));
            }
        }

        $formMapper
            ->add('game', 'sonata_type_model')
            ->add('title', TextType::class)
            ->add('announcement', TextareaType::class)
            ->add('isSticky', CheckboxType::class, ['required' => false])
            ->add('appImage', 'sonata_media_type',
                [
                    'required' => false,
                    'context' => 'news.appImage',
                    'data_class' => Media::class,
                    'label' => 'Image for APP',
                    'provider' =>'sonata.media.provider.image',
                    'help' => $appImage,
                ]
            )
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('game')
            ->add('title')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('game.name')
            ->addIdentifier('title')
            ->addIdentifier('createDate')
            ->addIdentifier('isSticky')
        ;
    }
}