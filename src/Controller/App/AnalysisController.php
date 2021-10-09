<?php

namespace App\Controller\App;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/analysis", name="app_analysis")
 */
class AnalysisController extends AbstractController
{
    /**
     * @Route("", name="_index")
     */
    public function index(): Response
    {
        return $this->render('App/Analysis/index.html.twig', [
            'controller_name' => 'AnalysisController',
        ]);
    }
}
