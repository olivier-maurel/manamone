<?php

namespace App\Service;

use App\Service\MainService;
use App\Entity\Usr\Role;
use App\Entity\App\Account;
use App\Entity\App\Project;
use App\Entity\App\Envelope;

class UserService extends MainService
{

    protected function getUser()
    {
        if (null === $token = $this->cn->get('security.token_storage')->getToken())
            return null;

        if (!\is_object($user = $token->getUser()))
            return null;

        return $user;
    }

    /**
     * 
     */
    public function checkUserRole(string $target)
    {
        $user       = $this->getUser();
        $userRoles  = $user->getRoles();
        $role       = $this->em->getRepository(Role::class)->findFormUserRoles($userRoles);

        switch ($target) {
            case 'acc':
                $count = $this->em->getRepository(Account::class)->countAll($user);
                $limit = $role->getAccount();
                break;
            case 'pro':
                $count = $this->em->getRepository(Project::class)->countAll($user);
                $limit = $role->getProject();
                break;
            case 'env':
                $count = $this->em->getRepository(Envelope::class)->countAll($user->getCurrentProject());
                $limit = $role->getEnvelope();
                break;
            default:
                return true;
        }

        if ($count >= $limit)
            return false;

        return true;
    }

}
