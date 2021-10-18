<?php

namespace App\Service;

use App\Entity\Usr\Role;
use App\Entity\App\Account;
use App\Entity\App\Project;
use App\Entity\App\Envelope;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserService extends AbstractController
{

    /**
     * 
     */
    public function checkUserRole(string $target)
    {
        $em         = $this->getDoctrine()->getManager();
        $user       = $this->getUser();
        $userRoles  = $user->getRoles();
        $role       = $em->getRepository(Role::class)->findFormUserRoles($userRoles);

        switch ($target) {
            case 'account':
                $count = $em->getRepository(Account::class)->countAll();
                $limit = $role->getAccount();
                break;
            case 'project':
                $count = $em->getRepository(Project::class)->countAll();
                $limit = $role->getProject();
                break;
            case 'envelope':
                $count = $em->getRepository(Envelope::class)->countAll();
                $limit = $role->getEnvelope();
                break;
            default:
                return false;
        }

        if ($count >= $limit)
            return false;

        return true;
    }

}
