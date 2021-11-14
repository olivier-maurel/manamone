<?php

namespace App\Service;

use App\Service\MainService;
use App\Entity\App\Envelope;
use App\Entity\App\CategoryTemplate;

class EnvelopeService extends MainService
{
    public function addEnvelope(array $data)
    {
        $project = $data['pro'];

        $envelope = new Envelope();
        $envelope->setProject($project)
                 ->setName('Mon enveloppe !')
                 ->setDescription('Ma description...')
                 ->setColor('#747474');

        $categoryTemplate = $this->em->getRepository(CategoryTemplate::class)->findAll();

        foreach ($categoryTemplate as $template) { 
            $category = $this->cn->get('cat_service')->addCategory([
                'env' => $envelope, 'tmp' => $template
            ]);
            $envelope->addCategory($category);
        }

        $this->em->persist($envelope);
        $this->em->flush();

        return $envelope;
    }
}
