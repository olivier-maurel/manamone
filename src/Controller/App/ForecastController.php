<?php

namespace App\Controller\App;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ProjectService;

/**
 * @Route("/forecast", name="app_forecast")
 */
class ForecastController extends AbstractController
{

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * @Route(name="_index")
     */
    public function index(): Response
    {
        $project = $this->getUser()->getCurrentProject();
        $table   = $this->projectService->getAllProject($project);

        return $this->render('app/forecast/index.html.twig', [
            'project' => $project,
            'table'   => $table
        ]);
    }
}
