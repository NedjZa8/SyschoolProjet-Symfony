<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EClassesController extends AbstractController
{
    #[Route('/e/classes', name: 'ecole_classes')]
    public function index(): Response
    {
        return $this->render('e_classes/index.html.twig', [
            'controller_name' => 'EClassesController',
        ]);
    }
}
