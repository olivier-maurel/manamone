<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MainService
{
    
    public function __construct(
        EntityManagerInterface $em,
        ContainerInterface $cn
    )
    {
        $this->em = $em;
        $this->cn = $cn;
    }

}
