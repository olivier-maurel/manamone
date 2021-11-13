<?php

namespace App\Service;

use App\Entity\App\Account;
use App\Entity\App\Project;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountService extends AbstractController
{
    public function __construct(UserService $us)
    {
        $this->us = $us;
    }

    public function setNewCurrentAccount(Account $account)
    {
        $em   = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $current = $em->getRepository(Account::class)->findOtherAccount(
            $account, $user
        );
        $user->setCurrentProject($current);
        return true;
    }
}
