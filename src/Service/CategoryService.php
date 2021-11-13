<?php

namespace App\Service;

use App\Entity\App\Account;
use App\Entity\App\Category;
use App\Entity\App\CategoryTemplate;
use App\Entity\App\Envelope;
use App\Entity\App\Project;
use App\Service\MainService;
use App\Service\RowVirtualService;

class CategoryService extends MainService
{
    public function addCategory(array $data)
    {
        $envelope = $data['env'];
        $template = $data['tmp'];
        
        $category = new Category();
        $category->setEnvelope($envelope)
                 ->setTemplate($template)
                 ->setName($template->getName())
                 ->setColor($template->getColor())
                 ->setIcon($template->getIcon())
                 ->addRowVirtual($this->cn->get('rov_service')->addRowVirtual([
                    'cat' => $category
                ]));
        $this->em->persist($category);
        $this->em->flush();
        
        return $category;
    }
}
