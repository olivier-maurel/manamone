<?php

namespace App\Controller\App;

use App\Service\EntityService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ProjectService;

/**
 * @Route("/app/forecast")
 */
class ForecastController extends AbstractController
{

    public function __construct(
        ProjectService $ps,
        EntityService $es
    )
    {
        $this->ps = $ps;
        $this->es = $es;
    }

    /**
     * @Route(name="app_forecast_index")
     */
    public function index(): Response
    {
        $project = $this->getUser()->getCurrentProject();
        $table   = $this->ps->getEnvelopes($this->getUser());

        return $this->render('app/forecast/index.html.twig', [
            'project' => $project,
            'table'   => $table
        ]);
    }

    /**
     * @Route("/add", name="app_forecast_add", methods={"POST"})
     */
    public function add(Request $request): JsonResponse
    {
        $data = $this->es->addEntity($request);
        
        return new JsonResponse([
            'success' => true,
            'content' => $this->renderView('app/forecast/_table.html.twig', [
                'table' => $this->ps->getEnvelopes($this->getUser()),
            ])
        ]);
    }

    /**
     * @Route("/delete", name="app_forecast_delete", methods={"POST"})
     */
    public function delete(Request $request): JsonResponse
    {
        $id = $this->es->deleteEntity($request);

        return new JsonResponse([
            'success' => true,
            'content' => $id,
            'message' => 'L\'élément "'.$id.'" a bien été supprimé'
        ]);
    }

    /**
     * @Route("/edit", name="app_forecast_edit", methods={"POST"})
     */
    public function edit(Request $request): JsonResponse
    {
        $this->es->editEntity($request);

        return new JsonResponse([
            'success' => true,
            'message' => 'Edition réussie',
            'content' => $this->renderView('app/forecast/_table.html.twig', [
                'table' => $this->ps->getEnvelopes($this->getUser()),
            ])
        ]);
    }

    /**
     * @Route("/form", name="app_forecast_form", methods={"POST"})
     */
    public function form(Request $request): JsonResponse
    {
        $data = $this->es->formEntity($request);
        $form = $this->createForm('App\Form\App\\'.$data['class'].'Type', $data['entity']);

        return new JsonResponse([
            'success' => true,
            'content' => $this->renderView('app/'.$data['label'].'/edit.html.twig', [
                'form' => $form->createView(),
                $data['label'] => $data['entity'],
            ])
        ]);
    }
}
