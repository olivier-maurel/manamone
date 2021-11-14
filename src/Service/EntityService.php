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

        if ($this->cn->get('usr_service')->checkUserRole($data['code']) === false)
            return [
                'success' => false,
                'message' => 'Votre nombre limite de projet a été atteind'
            ];

        $function = 'add'.$this->getInfos($data['code'])->getClass();

        $this->cn->get($data['code'].'_service')->$function(
            $this->handlerAjax($request)
        );

        return [
            'success' => true,
            'message' => null
        ];
    }

    /**
     * Supprime une entité
     * @param Request
     * @return string
     */
    public function deleteEntity(Request $request)
    {
        $data = $request->request->get('data');

        $this->em->remove($this->getEntity($data['code'], $data['id']));
        $this->em->flush();

        return $this->getInfos($data['code'])->getCode();
    }

    /**
     * Edite une entité
     * @param Request
     * @return object
     */
    public function editEntity(Request $request)
    {
        $data = $request->request->get('data');
        parse_str($request->request->get('form'), $form);

        $item = $this->getEntity($data['code'], $data['id']);
        $info = $this->getInfos($data['code']);

        foreach ($form[$info->getLabel()] as $key => $value) {
            if ($key === '_token') continue;
            
            $function = 'set'.$this->convertLabel($key);
            $class = $this->getInfos($key, 1);
            
            if ($class !== null)
                $value = $this->getEntity($class->getCode(), $value);
            
            $item->$function(($value !== '')?$value:null);
        }
        
        $this->em->flush();
        $this->em->clear();

        return $item;
    }

    /**
     * Affiche le formulaire d'édition d'une entité
     * @param Request
     * @return string
     */
    public function formEntity(Request $request)
    {
        $data = $request->request->get('data');
        $info = $this->getInfos($data['code']);

        return [
            'entity' => $this->getEntity($data['code'], $data['id']),
            'label'  => $info->getLabel(),
            'class'  => $info->getClass()
        ];
    }

    /** PRIVATE
     * Récupère les informations d'une entité
     * @param string
     * @return array
     */
    private function getInfos(string $code, bool $full = false)
    {
        if ($full === true)
            return $this->em->getRepository(Entity::class)->findByLabel($code);
        else
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

    /** PRIVATE
     * Convertie en CamelCase
     * @param string
     * @return string
     */
    private function convertLabel(string $str)
    {
        return str_replace(' ', '', ucwords(str_replace('_', ' ', $str)));
    }

}
