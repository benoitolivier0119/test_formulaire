<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Form\ProduitsType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormulaireController extends AbstractController
{
    /**
     * @Route("/formulaire", name="formulaire")
     */
    public function index(Request $request, RouterInterface $router)
    {
        $produits = new Produits();

        $form = $this->createForm(ProduitsType::class, $produits);

        $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
       
        $produits = $form->getData();

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($produits);
        $entityManager->flush();

        return $this->redirectToRoute('formulaire');
    }

    
        return $this->render('formulaire/index.html.twig', 
        [
           'formulaire' => $form->createView(),
        ]);
    }
}
