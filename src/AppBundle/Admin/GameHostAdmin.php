<?php namespace AppBundle\Admin;

use AppBundle\Document\ExecutorHook;
use AppBundle\Document\Game;
use AppBundle\Document\GameUI;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class GameHostAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Main settings', ['class' => 'col-md-6'])
            ->add('game', 'sonata_type_model')
            ->add('hasDownloadPath', CheckboxType::class, ['required' => false])
            ->add('downloadTorrentDirectUrl', TextareaType::class, ['required' => false])
            ->add('folderName', TextType::class)
            ->add('gameSize', TextType::class)
            ->add('dependencyList', TextType::class, ['required' => false])
            ->add('extractorType', TextType::class)
            ->add('executeUrl', TextType::class)
            ->add('isThettaUnbind', CheckboxType::class, ['required' => false])
            ->end()
            ->with('Hooks', ['class' => 'col-md-6'])
            ->add('downloadHooks', 'sonata_type_model', ['required' => false, 'multiple' => true])
            ->add('executorHooks', 'sonata_type_model', ['required' => false, 'multiple' => true])
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