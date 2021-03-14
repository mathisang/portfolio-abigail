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
     * @Route("/a-propos", name="about")
     */
    public function about(): Response
    {
        return $this->render('about/index.html.twig', [
            'active_page' => 'about',
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
            $captcha = $request->get('captcha');
            $correctCaptcha = $request->get('correctCaptcha');
            if ($captcha === $correctCaptcha) {
                $this->em->persist($contact);
                $this->em->flush();
                $this->addFlash('success', 'Votre demande de contact à été envoyée avec succès');

                return $this->redirectToRoute('contact');
            }
            $this->addFlash('error', "La question de vérification est incorrect. Votre demande n'a pas abouti");
        }

        return $this->render('contact/index.html.twig', [
            'active_page' => 'contact',
            'form' => $form->createView()
        ]);
    }
}
