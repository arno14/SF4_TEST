<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="redirect")
     */
    public function redirectAction()
    {
        return $this->redirectToRoute('default');
    }

    /**
     * @Route("/hello", name="default")
     */
    public function index()
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * Single Page application.
     *
     * @Route("/spa", name="spa_app")
     */
    public function app()
    {
        return $this->render('default/spa_app.html.twig');
    }
}
