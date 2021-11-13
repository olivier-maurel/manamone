<?php

namespace App\Service;

use App\Entity\App\Account;
use App\Entity\App\Envelope;
use App\Entity\App\Project;
use App\Entity\Usr\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EnvelopeService extends AbstractController
{
    public function addEnvelope(Project $project, Account $account)
    {
        $envelope = new Envelope();
        $envelope->setProject($project)
                 ->setAccount($account)
                 ->setName('Mon enveloppe !')
                 ->setDescription('Ma description...')
                 ->setColor('#747474');

        $this->getDoctrine()->getManager()->persist($project);

        return $envelope;
    }
}
