<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */

    public function index(Request $request): Response
    {


        $form=$this->createForm(ContactType::class);

        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){

            $this->addFlash('success',"Mail envoyé !");
            return $this->redirect($this->generateUrl('app_home').'#contact'); 
        }

        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'HomeController',
        ]);
    }
}
