<?php namespace AppBundle\Admin;

use AppBundle\Document\Theme;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\MediaBundle\Provider\MediaProviderInterface;
use Application\Sonata\MediaBundle\Document\Media;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ThemeAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        /**
         * @var Theme $subject
         */
        $subject = $this->getSubject();
        $image = '';
        $file = '';

        if ($subject) {
            $container = $this->getConfigurationPool()->getContainer();
            $media = $container->get('sonata.media.twig.extension');
            $format = MediaProviderInterface::FORMAT_REFERENCE;

            if($subject->getImage()){
                $image = sprintf('<img src="%s" class="admin-preview" />', $media->path($subject->getImage(), $format));
            }

            if($subject->getFile()){
                $url = $media->path($subject->getFile(), $format);
                $file = sprintf('<a href="%s">%s</a>', $url, $url);
            }
        }

        $formMapper
            ->add('name', TextType::class)
            ->add('image', 'sonata_media_type',
                [
                    'context' => 'theme.image',
                    'data_class' => Media::class,
                    'label' => 'Image',
                    'provider' =>'sonata.media.provider.image',
                    'help' => $image,
                ]
            )
            ->add('file', 'sonata_media_type',
                [
                    'context' => 'theme.file',
                    'data_class' => Media::class,
                    'label' => 'File',
                    'provider' =>'sonata.media.provider.file',
                    'help' => $file,
                ]
            )
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name');
    }

    public function preUpdate($theme)
    {
        /** @var Theme $theme */
        $theme->setUpdateDate(new \DateTime());
        $this->updateFileSize($theme);
    }

    public function prePersist($theme)
    {
        $this->updateFileSize($theme);
    }

    private function updateFileSize(Theme $theme): void
    {
        /** @var Media $file */
        $file = $theme->getFile();
        if (!$file instanceof Media) {
            return;
        }

        $theme->setSize($file->getSize());
    }
}