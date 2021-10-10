<?php

namespace App\Controller\Usr;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user", name="usr_user")
 */
class UserController extends AbstractController
{
    /**
     * @Route(name="_index")
     */
    public function index(): Response
    {
        return $this->render('usr/user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
