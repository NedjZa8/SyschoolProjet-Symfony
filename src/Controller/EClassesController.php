<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Form\ClasseType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EClassesController extends AbstractController
{
    #[Route('/e/classes', name: 'ecole_classes')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $classeRepo=$doctrine->getRepository(Classe::class);
        $classes=$classeRepo->findAll();
        return $this->render('e_classes/index.html.twig', [
            'mesClasses' => $classes,
        ]);
    }

    // ********************************CREATION******************

    #[Route('/e/classes/add', name: 'ecole_classes_add')]
    public function add(Request $request, ManagerRegistry $r): Response
    {
        $classe=new Classe();
        #$classe->setDataCreation(new \DateTime());

        $form=$this->createForm(ClasseType::class, $classe);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $classe=$form->getData();

            $em=$r->getManager();

            $em->persist($classe);
            $em->flush();

            $this->addFlash("success","La classe".$classe->getNom()."a ete enregistré");
            return $this->redirectToRoute("ecole_classes");
        }
        return $this->render('e_classes/add.html.twig', [
            "formulaire"=>$form->createView()
        ]);
    }
}


