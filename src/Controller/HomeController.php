<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        return $this->render('homepage/index.html.twig', [
            'active_page' => 'homepage',
        ]);
    }

    /**
     * @Route("/realisations", name="realisations")
     */
    public function realisations(): Response
    {
        return $this->render('realisations/index.html.twig', [
            'active_page' => 'realisations',
        ]);
    }

    /**
     * @Route("/projet", name="projet")
     */
    public function projet(): Response
    {
        return $this->render('project/index.html.twig', [
            'active_page' => 'realisations',
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, EntityManagerInterface $em): Response
    {
        $this->em = $em;

        // Configurer un envoi d'email en plus de l'enregistrement en BDD

        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($contact);
            $this->em->flush();
            $this->addFlash('success', 'Demande de contact envoyée avec succès');

            return $this->redirectToRoute('homepage');
        }

        return $this->render('contact/index.html.twig', [
            'active_page' => 'contact',
            'form' => $form->createView()
        ]);
    }
}
