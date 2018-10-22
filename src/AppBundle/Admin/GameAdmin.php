<?php namespace AppBundle\Admin;

use AppBundle\Document\Game;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class GameAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        /**
         * @var Game $subject
         */
        $subject = $this->getSubject();
        $icon48x48 = '';
        $avatar100x100 = '';
        $avatar300x200 = '';
        $avatar180x200 = '';
        $iconInApp = '';

        if ($subject) {
            $container = $this->getConfigurationPool()->getContainer();
            $media = $container->get('sonata.media.twig.extension');
            $format = 'small';

            if($subject->getIcon48x48()){
                $icon48x48 = sprintf('<img src="%s" class="admin-preview" />', $media->path($subject->getIcon48x48(), $format));
            }
            if($subject->getAvatar100x100()){
                $avatar100x100 = sprintf('<img src="%s" class="admin-preview" />', $media->path($subject->getAvatar100x100(), $format));
            }
            if($subject->getAvatar300x200()){
                $avatar300x200 = sprintf('<img src="%s" class="admin-preview" />', $media->path($subject->getAvatar300x200(), $format));
            }
            if($subject->getAvatar180x200()){
                $avatar180x200 = sprintf('<img src="%s" class="admin-preview" />', $media->path($subject->getAvatar180x200(), $format));
            }
            if($subject->getIconInApp()){
                $iconInApp = $subject->getIconInApp()->getName();
            }
        }

        $formMapper
            ->tab('Main')
            ->with('Main settings', ['class' => 'col-md-6'])
            ->add('name', TextType::class)
            ->add('alias', TextType::class)
            ->add('genre', 'sonata_type_model')
            ->add('shortcut', 'sonata_type_model')
            ->add('isPublishedInApp', CheckboxType::class, ['required' => false])
            ->add('isRunnable', CheckboxType::class, ['required' => false])
            ->add('description', TextareaType::class)
            ->add('textForCatalog', TextareaType::class, ['required' => false])
            ->add('socialGroups', 'sonata_type_model', ['required' => false, 'multiple' => true])
            ->end()
            ->with('Publisher', ['class' => 'col-md-6'])
            ->add('developer', TextType::class)
            ->add('publisher', TextType::class)
            ->add('releaseDate', DateType::class, ['required' => false])
            ->add('obtStartDate', DateType::class, ['required' => false])
            ->end()
            ->with('Links', ['class' => 'col-md-6'])
            ->add('clientDownloadUrl', TextType::class, ['required' => false])
            ->add('officialSite', TextType::class, ['required' => false])
            ->add('forumUrl', TextType::class, ['required' => false])
            ->add('wikiUrl', TextType::class, ['required' => false])
            ->add('supportUrl', TextType::class, ['required' => false])
            ->end()
            ->end()
            ->tab('Images')
            ->add('icon48x48', 'sonata_media_type',
                [
                    'required' => false,
                    'context' => 'game.icon48x48',
                    'data_class' => 'Application\Sonata\MediaBundle\Document\Media',
                    'label' => 'Icon (48x48)',
                    'provider' =>'sonata.media.provider.image',
                    'help' => $icon48x48,
                ]
            )
            ->add('avatar100x100', 'sonata_media_type',
                [
                    'required' => false,
                    'context' => 'game.avatar100x100',
                    'data_class' => 'Application\Sonata\MediaBundle\Document\Media',
                    'label' => 'Avatar (100x100)',
                    'provider' =>'sonata.media.provider.image',
                    'help' => $avatar100x100,
                ]
            )
            ->add('avatar300x200', 'sonata_media_type',
                [
                    'required' => false,
                    'context' => 'game.avatar300x200',
                    'data_class' => 'Application\Sonata\MediaBundle\Document\Media',
                    'label' => 'Avatar (300x200)',
                    'provider' =>'sonata.media.provider.image',
                    'help' => $avatar300x200,
                ]
            )
            ->add('avatar180x200', 'sonata_media_type',
                [
                    'required' => false,
                    'context' => 'game.avatar180x200',
                    'data_class' => 'Application\Sonata\MediaBundle\Document\Media',
                    'label' => 'Avatar (180x200)',
                    'provider' =>'sonata.media.provider.image',
                    'help' => $avatar180x200,
                ]
            )
            ->add('iconInApp', 'sonata_media_type',
                [
                    'required' => false,
                    'context' => 'game.iconInApp',
                    'data_class' => 'Application\Sonata\MediaBundle\Document\Media',
                    'label' => 'Icon in app',
                    'provider' =>'sonata.media.provider.file',
                    'help' => $iconInApp,
                ]
            )
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->addIdentifier('alias')
            ->addIdentifier('genre');
    }
}