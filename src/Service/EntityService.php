<?php

namespace App\Service;

use App\Entity\Glb\Entity;
use App\Service\MainService;
use Symfony\Component\HttpFoundation\Request;

class EntityService extends MainService
{
    
    /**
     * Ajoute une nouvelle entité
     * @param string
     * @param Request
     * @return object
     */
    public function addEntity(Request $request)
    {
        $data     = $request->request->get('data');
        $infos    = $this->getInfos($data['code']);
        $function = 'add'.$infos->getClass();

        return [
            'label' => $infos->getLabel(),
            'item' => $this->cn->get($data['code'].'_service')->$function(
                $this->handlerAjax($request)
            )
        ];
    }

    /**
     * Supprime une entité
     * @param Request
     * @return string
     */
    public function removeEntity(Request $request)
    {
        $data = $request->request->get('data');

        $this->em->remove($this->getEntity($data['code'], $data['id']));
        $this->em->flush();

        return $this->getInfos($data['code'])->getCode();
    }

    /** PRIVATE
     * Récupère les informations d'une entité
     * @param string
     * @return array
     */
    private function getInfos(string $code)
    {
        return $this->em->getRepository(Entity::class)->findByCode($code);
    }

    /** PRIVATE
     * Récupère une entité
     * @param string
     * @param string
     * @return array
     */
    private function getEntity(string $code, string $id)
    {
        return $this->em->getRepository($this->getInfos($code)->getPath())->findOneById($id);
    }

    /** PRIVATE
     * Récupère les entités d'une requête AJAX
     * @param Request
     * @return array
     */
    private function handlerAjax(Request $request)
    {
        $data = $request->request->get('data');
        $denied = ['id', 'label', 'code'];

        foreach (array_keys($data) as $key => $code)
            if (!in_array($code, $denied))
                $entity[$code] = $this->getEntity($code, $data[$code]);

        return $entity;
    }

}
