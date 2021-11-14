<?php

namespace App\Listener;

use App\Entity\App\Envelope;
use App\Entity\App\Account;
use Doctrine\ORM\Event\LifecycleEventArgs;

class EnvelopeListener
{

    public function prePersist(Envelope $envelope, LifecycleEventArgs $event)
    {
        if (!$envelope instanceof Envelope)
            return;

        $entityManager = $event->getObjectManager();
        $account       = $entityManager->getRepository(Account::class)->findOneBy([], ['created_at' => 'desc']);
        
        $envelope->setAccount($account);
    }
}