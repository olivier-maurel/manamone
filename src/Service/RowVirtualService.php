<?php

namespace App\Service;

use App\Service\MainService;
use App\Entity\App\Category;
use App\Entity\App\Frequency;
use App\Entity\App\RowVirtual;
use Symfony\Component\HttpFoundation\Request;

class RowVirtualService extends MainService
{

    public function addRowVirtual(array $data)
    {
        $category = $data['cat'];

        $rowVirtual = new RowVirtual();
        $rowVirtual->setCategory($category);
        
        $this->em->persist($rowVirtual);
        $this->em->flush();

        return $rowVirtual;
    }

    public function editRowVirtual(Request $request)
    {
        $data = $request->request->all();
        parse_str($data['form'], $form);
        $form = $form['row_virtual'];
        
        $row = $this->em->getRepository(RowVirtual::class)->findOneById($data['id']);
        $frequency = $this->em->getRepository(Frequency::class)->findOneById($form['frequency']);

        $row
            ->setName($form['name'])
            ->setValue($form['value'])
            ->setFrequency($frequency);
        
        $this->em->persist($row);
        $this->em->flush();

        return $row;
    }
}
