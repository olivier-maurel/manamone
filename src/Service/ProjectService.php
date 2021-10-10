<?php

namespace App\Service;

use App\Entity\App\Project;
use App\Entity\App\Account;
use App\Entity\App\Category;
use App\Entity\App\Envelope;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProjectService extends AbstractController
{

    public function addProject(Project $project, Account $account)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        $user->setCurrentProject($project);
        $project->setUser($user);

        $envelope = new Envelope();
        $envelope->setProject($project);
        $entityManager->persist($project);

        $category = new Category();

        $entityManager->flush();

    }

}
