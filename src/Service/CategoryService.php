<?php

namespace App\Service;

use App\Entity\App\Account;
use App\Entity\App\Category;
use App\Entity\App\CategoryTemplate;
use App\Entity\App\Envelope;
use App\Entity\App\Project;
use App\Service\RowVirtualService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryService extends AbstractController
{
    public function __construct(
        RowVirtualService $rvs
    )
    {
        $this->rvs = $rvs;
    }

    public function addCategory(array $data)
    {
        $envelope = $data['env'];
        $template = $data['tmp'];

        $em = $this->getDoctrine()->getManager();

        $category = new Category();

        $category->setEnvelope($envelope)
                 ->setTemplate($template)
                 ->setName($template->getName())
                 ->setColor($template->getColor())
                 ->setIcon($template->getIcon());
        $em->persist($category);
        
        $this->rvs->addRowVirtual([
            'cat' => $category
        ]);

        $em->flush();

        
        
        return $category;
    }
}
