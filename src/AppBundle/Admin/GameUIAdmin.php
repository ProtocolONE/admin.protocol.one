<?php namespace AppBundle\Admin;

use AppBundle\Document\Game;
use AppBundle\Document\GameUI;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class GameUIAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        /**
         * @var GameUI $subject
         */
        $subject = $this->getSubject();
        $imageSmall = '';
        $imageHorizontalSmall = '';
        $imageLogoSmall = '';
        $imagePopupArt = '';
        $backgroundInApp = '';

        if ($subject) {
            $container = $this->getConfigurationPool()->getContainer();
            $media = $container->get('sonata.media.twig.extension');
            $format = 'small';

            if($subject->getImageSmall()){
                $imageSmall = sprintf('<img src="%s" class="admin-preview" />', $media->path($subject->getImageSmall(), $format));
            }
            if($subject->getImageHorizontalSmall()){
                $imageHorizontalSmall = sprintf('<img src="%s" class="admin-preview" />', $media->path($subject->getImageHorizontalSmall(), $format));
            }
            if($subject->getImageLogoSmall()){
                $imageLogoSmall = sprintf('<img src="%s" class="admin-preview" />', $media->path($subject->getImageLogoSmall(), $format));
            }
            if($subject->getImagePopupArt()){
                $imagePopupArt = sprintf('<img src="%s" class="admin-preview" />', $media->path($subject->getImagePopupArt(), $format));
            }
            if($subject->getBackgroundInApp()){
                $backgroundInApp = sprintf('<img src="%s" class="admin-preview" />', $media->path($subject->getBackgroundInApp(), $format));
            }
        }

        $formMapper
            ->with('Main settings', ['class' => 'col-md-6'])
            ->add('game', 'sonata_type_model')
            ->add('sortPriority', NumberType::class, ['required' => false])
            ->add('maintenanceProposal1', 'sonata_type_model', ['required' => false])
            ->add('maintenanceProposal2', 'sonata_type_model', ['required' => false])
            ->add('widgetList', TextareaType::class, ['required' => false])
            ->add('logoText', TextType::class)
            ->add('miniToolTip', TextType::class)
            ->add('aboutGame', TextareaType::class, ['required' => false])
            ->add('shortDescription', TextareaType::class, ['required' => false])
            ->end()
            ->with('Images', ['class' => 'col-md-6'])
            ->add('imageSmall', 'sonata_media_type',
                [
                    'required' => false,
                    'context' => 'gameUI.imageSmall',
                    'data_class' => 'Application\Sonata\MediaBundle\Document\Media',
                    'label' => 'Image small',
                    'provider' =>'sonata.media.provider.image',
                    'help' => $imageSmall,
                ]
            )
            ->add('imageHorizontalSmall', 'sonata_media_type',
                [
                    'required' => false,
                    'context' => 'gameUI.imageHorizontalSmall',
                    'data_class' => 'Application\Sonata\MediaBundle\Document\Media',
                    'label' => 'Image horizontal (small)',
                    'provider' =>'sonata.media.provider.image',
                    'help' => $imageHorizontalSmall,
                ]
            )
            ->add('imageLogoSmall', 'sonata_media_type',
                [
                    'required' => false,
                    'context' => 'gameUI.imageLogoSmall',
                    'data_class' => 'Application\Sonata\MediaBundle\Document\Media',
                    'label' => 'Image logo (small)',
                    'provider' =>'sonata.media.provider.image',
                    'help' => $imageLogoSmall,
                ]
            )
            ->add('imagePopupArt', 'sonata_media_type',
                [
                    'required' => false,
                    'context' => 'gameUI.imagePopupArt',
                    'data_class' => 'Application\Sonata\MediaBundle\Document\Media',
                    'label' => 'Image PopupArt',
                    'provider' =>'sonata.media.provider.image',
                    'help' => $imagePopupArt,
                ]
            )
            ->add('backgroundInApp', 'sonata_media_type',
                [
                    'required' => false,
                    'context' => 'gameUI.backgroundInApp',
                    'data_class' => 'Application\Sonata\MediaBundle\Document\Media',
                    'label' => 'Background in app',
                    'provider' =>'sonata.media.provider.image',
                    'help' => $backgroundInApp,
                ]
            )
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('game.name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('game.name');
    }
}