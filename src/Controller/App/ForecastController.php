<?php

namespace App\Controller\App;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/forecast", name="app_forecast")
 */
class ForecastController extends AbstractController
{
    /**
     * @Route(name="_index")
     */
    public function index(): Response
    {
        return $this->render('app/forecast/index.html.twig', [
            'controller_name' => 'ForecastController',
        ]);
    }
}
