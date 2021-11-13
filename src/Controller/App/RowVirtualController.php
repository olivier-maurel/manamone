<?php

namespace App\Controller\App;

use App\Entity\App\Category;
use App\Entity\App\RowVirtual;
use App\Form\App\RowVirtualType;
use App\Repository\App\RowVirtualRepository;
use App\Service\RowVirtualService;
use App\Service\EntityService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/app/row/virtual")
 */
class RowVirtualController extends AbstractController
{
    public function __construct(
        RowVirtualService $rowVirtualService,
        EntityService $entityService
    )
    {
        $this->rvs = $rowVirtualService;
        $this->es  = $entityService;
    }

    /**
     * @Route("/new", name="app_row_virtual_new", methods={"POST"})
     */
    public function new(Request $request): JsonResponse
    {
        return new JsonResponse([
            'success' => true,
            'content' => $this->renderView('app/forecast/_row.html.twig', [
                'row' => $this->es->addEntity('row_virtual', $request),
            ])
        ]);
    }

    /**
     * @Route("/edit-form", name="app_row_virtual_edit_form", methods={"POST"})
     */
    public function editForm(Request $request): JsonResponse
    {
        $em  = $this->getDoctrine()->getManager();
        $id  = $request->request->get('id');
        $row = $em->getRepository(RowVirtual::class)->findOneById($id);
        $form = $this->createForm(RowVirtualType::class, $row);

        return new JsonResponse([
            'success' => true,
            'content' => $this->renderView('app/row_virtual/edit.html.twig', [
                'form' => $form->createView(),
                'row_virtual' => $row,
            ])
        ]);
    }

    /**
     * @Route("/edit", name="app_row_virtual_edit", methods={"POST"})
     */
    public function edit(Request $request): JsonResponse
    {
        if(!$request->isXmlHttpRequest())
            return new JsonResponse([
                'success' => false,
                'message' => 'No ajax request'
            ]);

        $row = $this->rvs->editRowVirtual($request);
        
        return new JsonResponse([
            'success' => true,
            'message' => 'Ligne modifiée',
            'content' => $this->renderView('app/forecast/_row_virtual.html.twig', [
                'row_virtual' => $row,
            ])
        ]);
    }

    // /**
    //  * @Route("/delete", name="app_row_virtual_delete", methods={"POST"})
    //  */
    // public function delete(Request $request): JsonResponse
    // {
    //     $id = $this->es->removeEntity('row_virtual', $request);

    //     return new JsonResponse([
    //         'success' => true,
    //         'content' => $id,
    //         'message' => 'L\'élément "'.$id.'" a bien été supprimé'
    //     ]);
    // }
}
