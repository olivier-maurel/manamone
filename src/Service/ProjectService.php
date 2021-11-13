<?php

namespace App\Service;

use App\Entity\App\Project;
use App\Entity\App\Account;
use App\Entity\App\Category;
use App\Entity\App\CategoryTemplate;
use App\Entity\App\Envelope;
use App\Entity\App\RowVirtual;
use App\Entity\App\RowFactual;
use App\Entity\Usr\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProjectService extends AbstractController
{
    public function __construct(
        UserService $us,
        EnvelopeService $es,
        CategoryService $cs,
        RowVirtualService $rvs
    )
    {
        $this->us  = $us;
        $this->es  = $es;
        $this->cs  = $cs;
        $this->rvs = $rvs;
    }

    public function addProject(Project $project)
    {
        $em   = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        
        $user->setCurrentProject($project);

        $project->setUser($user);
        $em->persist($project);

        $account = $em->getRepository(Account::class)
            ->findOneBy([], ['created_at' => 'desc']);

        $envelope = $this->es->addEnvelope($project, $account);

        $categoryTemplate = $em->getRepository(CategoryTemplate::class)
            ->findAll();

        foreach ($categoryTemplate as $template) { 
            $category = $this->cs->addCategory($envelope, $template);
            $this->rvs->addRowVirtual($category);
        }

        $em->flush();
    }

    public function getAllProject(Project $project)
    {
        $em = $this->getDoctrine()->getManager();
        $results = [];
        $results['id'] = $project->getId();

        $envelopes = $em->getRepository(Envelope::class)->findByProject($project);
        foreach ($envelopes as $envelope) {
            $key = $envelope->getId();
            $results['envelope'][] = $envelope; 
            $categories = $em->getRepository(Category::class)->findByEnvelope($envelope);
            foreach ($categories as $category) {
                $results['categories'][] = $category;
                $rowVirtuals = $em->getRepository(RowVirtual::class)->findByCategory($category);
                foreach ($rowVirtuals as $rowVirtual) {
                    $results['rowVirtuals'][] = $rowVirtual;
                    $results['rowFactuals'] = $em->getRepository(RowFactual::class)->findBy(['virtual_id' => $rowVirtual]);
                }
            }
        }

        return $results;
    }

    public function setNewCurrentProject(Project $project)
    {
        $em   = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $current = $em->getRepository(Project::class)->findOtherProject(
            $project , $user
        );
        $user->setCurrentProject($current);
        return true;
    }

    public function getEnvelopes(User $user)
    {
        $project = $user->getCurrentProject();
        return $project->getEnvelopes();
    }
}
