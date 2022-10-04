<?php

namespace App\Controller;

use App\Form\ContactType;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */

    public function index(Request $request, MailerInterface $mailer): Response
    {


        $form=$this->createForm(ContactType::class);
        $contact = $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){

         
            $email = (new TemplatedEmail())
            ->from(new Address('ne-pas-repondre@andrew-marbach.fr', 'Andrew Marbach'))
            ->to(new Address($contact->get('email')->getData()))
            ->cc('amarbach5@gmail.com')
            ->subject('[Prise de Contact] Je vous re-contacte')
            ->htmlTemplate('mail/index.html.twig')
            ->context([
                'sujet' => $contact->get('sujet')->getData(),
                'mail' => $contact->get('email')->getData(),
                'message' => $contact->get('message')->getData(),   
            ]);
    
            $mailer->send($email);
            $this->addFlash('success',"Mail envoyé !");
            return $this->redirect($this->generateUrl('app_home').'#contact'); 
        }

        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'HomeController',
        ]);
    }
}
