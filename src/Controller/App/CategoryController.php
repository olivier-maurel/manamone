<?php

namespace App\Controller\App;

use App\Entity\App\Category;
use App\Form\App\CategoryType;
use App\Repository\App\CategoryRepository;
use App\Service\CategoryService;
use App\Service\EntityService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/app/category")
 */
class CategoryController extends AbstractController
{
    public function __construct(
        CategoryService $categoryService,
        EntityService $entityService
    )
    {
        $this->cs = $categoryService;
        $this->es = $entityService;
    }

    /**
     * @Route("/new", name="app_category_new", methods={"POST"})
     */
    public function new(Request $request): JsonResponse
    {
        return new JsonResponse([
            'success' => true,
            'content' => $this->renderView('app/forecast/_category.html.twig', [
                'category' => $this->es->addEntity('category', $request),
            ])
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_category_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Category $category): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('app/category/edit.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/delete", name="app_category_delete", methods={"POST"})
     */
    public function delete(Request $request): JsonResponse
    {
        $id = $this->es->removeEntity('category', $request);

        return new JsonResponse([
            'success' => true,
            'content' => $id,
            'message' => 'La ligne "'.$id.'" a bien été supprimé'
        ]);
    }
}
