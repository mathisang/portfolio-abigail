<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Project;
use App\Form\ContactType;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

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
     * @Route("/project/{id}", name="project")
     */
    public function project(ProjectRepository $projectRepository, $id): Response
    {
        $this->project = $projectRepository;

        $project = $this->project->findOneBy(['id' => $id]);

        return $this->render('project/index.html.twig', [
            'active_page' => 'realisations',
            'project' => $project
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
     * @Route("/affiche-jpo-2020", name="affiche_jpo_2020")
     */
    public function affiche_jpo_2020(): Response
    {
        return $this->render('project/affiche_jpo_2020.html.twig', [
            'active_page' => 'realisations',
        ]);
    }

    /**
     * @Route("/terres-du-son", name="terres_du_son")
     */
    public function terres_du_son(): Response
    {
        return $this->render('project/terre_du_son.html.twig', [
            'active_page' => 'realisations',
        ]);
    }

    /**
     * @Route("/batifive", name="batifive")
     */
    public function batifive(): Response
    {
        return $this->render('project/batifive.html.twig', [
            'active_page' => 'realisations',
        ]);
    }

    /**
     * @Route("/despecup", name="despecup")
     */
    public function projet2(): Response
    {
        return $this->render('project/despecup.html.twig', [
            'active_page' => 'realisations',
        ]);
    }

    /**
     * @Route("/boy", name="boy")
     */
    public function boy(): Response
    {
        return $this->render('project/boy.html.twig', [
            'active_page' => 'realisations',
        ]);
    }

    /**
     * @Route("/aesop", name="aesop")
     */
    public function aesop(): Response
    {
        return $this->render('project/aesop.html.twig', [
            'active_page' => 'realisations',
        ]);
    }

    /**
     * @Route("/couverture-magazine", name="couverture_magazine")
     */
    public function projet5(): Response
    {
        return $this->render('project/couverture_magazine.html.twig', [
            'active_page' => 'realisations',
        ]);
    }

    /**
     * @Route("/renault", name="renault")
     */
    public function projet6(): Response
    {
        return $this->render('project/renault.html.twig', [
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

//    /**
//     * @Route("/admin/projet/add", name="add_project")
//     */
//    public function project_add(Request $request)
//    {
//        $project = new Project();
//
//        $form = $this->createForm(ProjectType::class, $project);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $this->em->persist($project);
//            $this->em->flush();
//            $this->addFlash('success', 'Projet ajouté avec succès');
//
//            return $this->redirectToRoute('add_project');
//        }
//
//        return $this->render('admin/project/add.html.twig', [
//            'active_page' => 'add_project',
//            'form' => $form->createView()
//        ]);
//    }
//
//    /**
//     * @Route("/admin/projet/edit/{id}", name="edit_project")
//     */
//    public function project_edit(Request $request, EntityManagerInterface $em, $id, Project $project): Response
//    {
//        $form = $this->createForm(ProjectType::class, $project);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $this->em->flush();
//            $this->addFlash('success', 'Projet ajouté avec succès');
//
//            return $this->redirectToRoute('admin');
//        }
//
//        return $this->render('admin/project/edit.html.twig', [
//            'active_page' => 'edit_project',
//            'form' => $form->createView()
//        ]);
//    }
}
