<?php

namespace App\Listener;

use App\Entity\App\Catgeory;
use App\Entity\App\Account;
use Doctrine\ORM\Event\LifecycleEventArgs;

class CategoryListener
{

    public function prePersist(Category $category, LifecycleEventArgs $event)
    {
        // if (!$category instanceof Category)
        //     return;

        // $entityManager = $event->getObjectManager();
        

        return;
    }
}