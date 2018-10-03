<?php

namespace App\Subscriber\Form;


use App\Domain\DTO\AddElementImageDTO;
use App\Subscriber\Form\Interfaces\EditElementCollectionTypeSubscriberInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

/**
 * Class EditElementCollectionTypeSubscriberInterface
 */
class EditElementCollectionTypeSubscriber implements EditElementCollectionTypeSubscriberInterface,EventSubscriberInterface
{
    /**
     * @var array
     */
    private $image;

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::POST_SET_DATA => 'onPostSetData',
            FormEvents::SUBMIT => 'onSubmit'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function onPostSetData(FormEvent $event)
    {
        foreach ($event->getForm()->getData()->images as $image) {
            $this->image[] = $image->image;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function onSubmit(FormEvent $event)
    {
        if (\is_null($this->image)) {
            return;
        }

        // getting Back images
        foreach ($this->image as $imageCollection) {
            $newImage = new AddElementImageDTO($imageCollection);
            $newTab[] = $newImage;
        }

        // make a tab with the new submitted images
        $tab = $event->getData()->images;

        foreach ($tab as $item) {
            // count images already existing in tab
            $number = \count($newTab);

            // filling up the tab with new images
            if ((!\is_null($item->image)) && ($number < 3) ) {
                $newTab[] = new AddElementImageDTO($item->image);
            }
        }

        foreach ($event->getData()->images as $oldImage) {
            if ((\is_null($oldImage->image)) && (!\is_null($this->image))) {
                $event->getForm()->getData()->images = $newTab;
            }
        }
    }
}
