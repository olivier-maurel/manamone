<?php

namespace App\Listener;

use App\Entity\App\RowVirtual;
use App\Entity\App\Frequency;
use Doctrine\ORM\Event\LifecycleEventArgs;

class RowVirtualListener
{

    public function prePersist(RowVirtual $rowVirtual, LifecycleEventArgs $event)
    {
        if (!$rowVirtual instanceof RowVirtual)
            return;

        $entityManager = $event->getObjectManager();
        $frequency     = $entityManager->getRepository(Frequency::class)->findOneBy(['code' => 'M']);
        
        $rowVirtual->setFrequency($frequency);
    }
}