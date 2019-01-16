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
}
