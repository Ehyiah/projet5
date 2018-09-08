<?php

namespace App\Subscriber\Form\Interfaces;


use Symfony\Component\Form\FormEvent;

interface EditCollectionTypeSubscriberInterface
{
    public static function getSubscribedEvents();

    public function onPostSetData(FormEvent $event);

    public function onSubmit(FormEvent $event);
}
