<?php

namespace App\Service;

use App\Entity\Usr\Role;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MainService
{
    protected $em;
    protected $cn;
    
    public function __construct(
        EntityManagerInterface $em,
        ContainerInterface $cn
    )
    {
        $this->em = $em;
        $this->cn = $cn;
    }

}
