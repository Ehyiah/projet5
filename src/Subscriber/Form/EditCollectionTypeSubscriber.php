<?php

namespace App\Subscriber\Form;


use App\Subscriber\Form\Interfaces\EditCollectionTypeSubscriberInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

/**
 * Class EditCollectionTypeSubscriber
 */
class EditCollectionTypeSubscriber implements EditCollectionTypeSubscriberInterface, EventSubscriberInterface
{
    /**
     * @var FileType
     */
    private $image;


    public static function getSubscribedEvents()
    {
        return [
            FormEvents::POST_SET_DATA => 'onPostSetData',
            FormEvents::SUBMIT => 'onSubmit'
        ];
    }


    public function onPostSetData(FormEvent $event)
    {
        $this->image = $event->getForm()->getData()->image;
    }

    public function onSubmit(FormEvent $event)
    {
        if (($event->getData()->image == null) && ($this->image != null) ) {
            $event->getForm()->getData()->image = $this->image;
        }
    }
}
