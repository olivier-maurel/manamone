<?php

namespace App\Controller\App;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/perform", name="app_perform")
 */
class PerformController extends AbstractController
{
    /**
     * @Route("", name="_index")
     */
    public function index(): Response
    {
        return $this->render('App/Perform/index.html.twig', [
            'controller_name' => 'PerformController',
        ]);
    }
}
