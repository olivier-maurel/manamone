<?php

namespace App\Service;

use App\Entity\App\Project;
use App\Entity\App\Account;
use App\Entity\App\Category;
use App\Entity\App\CategoryTemplate;
use App\Entity\App\Envelope;
use App\Entity\App\RowVirtual;
use App\Entity\App\RowFactual;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProjectService extends AbstractController
{
    public function __construct(UserService $us)
    {
        $this->us = $us;
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

        $envelope = new Envelope();
        $envelope->setProject($project)
                 ->setAccount($account)
                 ->setName('Mon enveloppe !')
                 ->setDescription('Ma description...')
                 ->setColor('#747474');
        $em->persist($project);
        $em->flush();

        $categoryTemplate = $em->getRepository(CategoryTemplate::class)
            ->findAll();

        foreach ($categoryTemplate as $template) {
            $category = new Category();
            $category->setEnvelope($envelope)
                     ->setTemplate($template)
                     ->setName($template->getName())
                     ->setColor($template->getColor())
                     ->setIcon($template->getIcon());
            $em->persist($category);

            $rowVirtual = new RowVirtual();
            $rowVirtual->setCategory($category);
            $em->persist($rowVirtual);
        }

        $em->flush();
    }

    public function getAllProject(Project $project)
    {
        $em = $this->getDoctrine()->getManager();
        $results = [];

        $envelopes = $em->getRepository(Envelope::class)->findByProject($project);
        foreach ($envelopes as $envelope) {
            $key = $envelope->getId();
            $results[$key]['envelope'][] = $envelope; 
            $categories = $em->getRepository(Category::class)->findByEnvelope($envelope);
            foreach ($categories as $category) {
                $results[$key]['categories'][] = $category;
                $rowVirtuals = $em->getRepository(RowVirtual::class)->findByCategory($category);
                foreach ($rowVirtuals as $rowVirtual) {
                    $results[$key]['rowVirtuals'][] = $rowVirtual;
                    $results[$key]['rowFactuals'] = $em->getRepository(RowFactual::class)->findBy(['virtual_id' => $rowVirtual]);
                }
            }
        }

        return $results;
    }
}
