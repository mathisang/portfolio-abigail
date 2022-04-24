<?php

namespace App\Controller\Admin;

use App\Entity\Competences;
use App\Entity\Contact;
use App\Entity\Notions;
use App\Entity\Outils;
use App\Entity\Project;
use App\Entity\Themes;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(ProjectCrudController::class)->generateUrl();

        return $this->redirect($url);

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Administration');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Projets');
        yield MenuItem::linkToCrud('Liste des projets', 'fas fa-file', Project::class);
        yield MenuItem::linkToCrud('Créer un projet', 'fas fa-file-circle-plus', Project::class)->setAction(Crud::PAGE_NEW);

        yield MenuItem::section('Thèmes');
        yield MenuItem::linkToCrud('Liste des thèmes', 'fas fa-book', Themes::class);
        yield MenuItem::linkToCrud('Créer un thème', 'fas fa-book-medical', Themes::class)->setAction(Crud::PAGE_NEW);

        yield MenuItem::section('Outils');
        yield MenuItem::linkToCrud('Liste des outils', 'fas fa-toolbox', Outils::class);
        yield MenuItem::linkToCrud('Créer un outil', 'fas fa-wrench', Outils::class)->setAction(Crud::PAGE_NEW);

        yield MenuItem::section('Compétences');
        yield MenuItem::linkToCrud('Liste des compétences', 'fas fa-chalkboard', Competences::class);
        yield MenuItem::linkToCrud('Créer une compétence', 'fas fa-chalkboard-user', Competences::class)->setAction(Crud::PAGE_NEW);

        yield MenuItem::section('Notions');
        yield MenuItem::linkToCrud('Liste des notions', 'fas fa-school', Notions::class);
        yield MenuItem::linkToCrud('Créer une notion', 'fas fa-school-circle-check', Notions::class)->setAction(Crud::PAGE_NEW);

        yield MenuItem::section('Contact');
        yield MenuItem::linkToCrud('Demandes de contact', 'fas fa-envelope', Contact::class);
    }
}
